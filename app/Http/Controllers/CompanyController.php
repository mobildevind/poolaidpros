<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\Model;
use Storage;
use Hash;
use Mail;
use App\Mail\email;
use App\Http\Controllers\PushNotification;
  
class CompanyController extends Controller
{
    public static function index(Request $request,$id){
  		if ($request->session()->has('SESS_userid') && $request->session()->has('user_type') == '1') {
           $title = 'Company Dashboard';

            $get_data = DB::table('users as u')
            ->join('technician as t', 't.u_id', '=', 'u.id')
            ->where('u.role_id','=','3')->where
            ('u.is_delted','=','0')->where('t.c_id',$id);
            $technician = $get_data->count(); 
           
            $get_data_user = DB::table('users as u')
            ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
            ->where('u.role_id','=','4')
            ->where('u.is_delted','=','0')
            ->where('cu.c_id',$id);
            $users = $get_data_user->count(); 

             $get_data_employe = DB::table('users as u')
            ->join('company_employe as cu', 'cu.u_id', '=', 'u.id')
            ->where('u.role_id','=','5')
            ->where('u.is_delted','=','0')
            ->where('cu.c_id',$id);
            $employe = $get_data_employe->count(); 
            
             $get_data_service = DB::table('service')
            ->where('c_id',$id)->where('is_delted','=','0');
            $service = $get_data_service->count(); 

            $get_data_tutorials = DB::table('tutorials')
            ->where('c_id',$id)->where('is_delted','=','0');
            $tutorials = $get_data_tutorials->count(); 

           return view('company_index', compact('title','id','employe','technician','users','service','tutorials'));
             return redirect('/company/home');
        } else {

            $title = 'Login page';
    		return view('login', compact('title'));
        }
    }

    public static function check_login(Request $request){
     
        if ($request->session()->has('SESS_userid') && $request->session()->has('user_type') == '1') {
            return redirect('/admin');
        }

        $email = $request->input('email');
        $password = $request->input('password');
     
        $checkandget = DB::table('users')->where('email',$email)->where('role_id','1')->get()->first();
      // print_r($checkandget); exit;
        if(!empty($checkandget)){
            
            if(Hash::check($password, $checkandget->password)){
                
                if(empty($checkandget->image)){
                    $checkandget->image = 'default.jpg';
                }
                $image_path = asset('storage/' . 'users_images/' . $checkandget->image);    
                $checkandget->image = $image_path;
                $message = "login successful";
                $request->session()->put('login_message', $message);
                $request->session()->put('login_detail', $checkandget);
                $request->session()->put('SESS_userid', $checkandget->id);
                $request->session()->put('user_type', $checkandget->role_id);
                $value = session('login_detail');
                return redirect('/admin/home');
            }else{
                //echo "here"; exit;
                $message = 'password not match';
                $request->session()->put('login_message', $message);
            }
        }else{
            $message = 'Email not match';            
            $request->session()->put('login_message', $message);
        }
        return redirect('/');
    }

    

      public static function forgetpassworda(Request $request){

         $email = $request->input('email');
        $get_data = DB::table('users')->where('role_id','1')->where('email',$email);
      
         $total = $get_data->count();  
      
       if($total == '0'){
         echo $total; 
       }else{
         $getresults = DB::table('users')->where('role_id','1')->where('email',$email)->get()->first();
        if(!empty($getresults)){
            // DB::table('users')->where('email',$email)->update(['password'=>bcrypt($new_password)]);
            $text = 'Hello '.$getresults->user_name.',';
            $text .= '<br><br> Your login password is : '.$getresults->org_password;
            Mail::send([],[], function($message) use ($getresults,$text)
            {
                $message->subject('Find Me Preacher: Password!');
                //$message->from('felixthomas727@gmail.com', 'Website Name');                
                $message->to($getresults->email);
                 $message->setBody($text, 'text/html');
            });    

          
        }
        echo $total;
       }
        }

  public static function AddTechnician(Request $request,$id){

      $title = 'Register a New Technician';
      return view('add-new-technician', compact('title','id'));

    } 
    public static function InsertTechnician(Request $request){
      $userid = $request->input('userid');
      $name = $request->input('name');
      $lname = $request->input('lname');
      $position = $request->input('position');
      $exp = $request->input('exp');
      $ccode = $request->input('ccode');
      $phone = $request->input('phone');
      $dob = date("Y-m-d", strtotime($request->input('dob')));
      $email = $request->input('email');
      $address = $request->input('address');
      $about = $request->input('about');
      $interests = $request->input('interests');
      $fevoriteshows = $request->input('fevoriteshows');
      $fevoritebook = $request->input('fevoritebook');
      $facebook = $request->input('facebook');
      $instagram = $request->input('instagram');
      $linkedin = $request->input('linkedin');
      $user_name = $request->input('username');
      $pass= $request->input('password');

      $image = $request->file('file');

        if(!empty($image)){

        ini_set('upload_max_filesize', '64M');
        ini_set('post_max_size', '64M');
        ini_set('max_execution_time', 300);

        $disk = Storage::disk('public');

        $name1 = $image->getClientOriginalName();
        $content = File::get($image);
        $image = time() . "_user_" . $name1;
        //Move Image to /app/storage/app/public/ Folder
        Storage::disk('uploads')->put('users_images/'.$image, $content);
        $disk->put('storage/users_images/'.$image, $content);
        }else{
        $image = '';
        }

      $postdata=array(
        'role_id' => '3',
        'first_name' => $name,
        'last_name'=>$lname,
        'user_name'=>$user_name,
        'email'=>$email,
        'country_code'=>$ccode,
        'mobile'=>$phone,
        'dob'=>$dob,
        'image'=>$image,
        'password'=>bcrypt($pass),
        'org_password'=>$pass,
        'register_date' => date("Y-m-d 00:00:00"),
        'created' => now(),
        );
      $id = DB::table('users')->insertGetId($postdata);

        
         $postdata=array(
        'c_id' => $userid,
        'u_id' => $id,
        'address'=>$address,
        'position'=>$position,
        'exprience'=>$exp,
        'interests'=>$interests,
        'fevouriteshows'=>$fevoriteshows,
        'fevoritebook'=>$fevoritebook,
        'facebooklink'=>$facebook,
        'instagramlink'=>$instagram,
        'linkedin'=>$linkedin,
        'about'=> $about,
        'created' => now(),
        );
    $id = DB::table('technician')->insertGetId($postdata);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/company/index/'.$userid.''); 
    
    }      
    public static function AddUser(Request $request,$id){

      $title = 'Register a New Customer';
      return view('add-new-user', compact('title','id'));

    } 

     public static function InsertUser(Request $request){
      $userid = $request->input('userid');
      $name = $request->input('name');
      $lname = $request->input('lname');
      $ccode = $request->input('ccode');
      $phone = $request->input('phone');
      $email = $request->input('email');
      $user_name = $request->input('email');
      $pass= $request->input('email');

      $sccode = $request->input('sccode');
      $sphone = $request->input('sphone'); 
      $address = $request->input('address');
      $about = $request->input('about');
      $image = $request->file('file');

        if(!empty($image)){

        ini_set('upload_max_filesize', '64M');
        ini_set('post_max_size', '64M');
        ini_set('max_execution_time', 300);

        $disk = Storage::disk('public');

        $name1 = $image->getClientOriginalName();
        $content = File::get($image);
        $image = time() . "_user_" . $name1;
        //Move Image to /app/storage/app/public/ Folder
        Storage::disk('uploads')->put('users_images/'.$image, $content);
        $disk->put('storage/users_images/'.$image, $content);
        }else{
        $image = '';
        }
      $postdata=array(
        'role_id' => '4',
        'first_name' => $name,
        'last_name'=>$lname,
        'user_name'=>$user_name,
        'email'=>$email,
        'country_code'=>$ccode,
        'mobile'=>$phone,
        'image'=>$image,
        'password'=>bcrypt($pass),
        'org_password'=>$pass,
        'register_date' => date("Y-m-d 00:00:00"),
        'created' => now(),
        );
      $id = DB::table('users')->insertGetId($postdata);

        $postdata=array(
        'c_id' => $userid,
        'u_id' => $id,
        'scountry_code'=>$sccode,
        'sphone'=>$sphone,
        'address'=>$address,
        'about'=> $about,
        'created' => now(),
        );
    $id = DB::table('company_user')->insertGetId($postdata);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/company/index/'.$userid.''); 
    
    } 
    
 public static function GetCompanyTechniciansList(Request $request,$id){
        $title = 'Technicians List';
        return view('company_technician_list', compact('title','id'));
     
    }

    public static function GetCompanyTechniciansListView(Request $request,$id){
   /* echo "<pre>";
     print_r(DB::table('users')->get()->all()); exit;*/
 
           
     $usercompany = $results = DB::table('users as u')
                        ->select('u.id as userid','u.id','u.first_name','u.last_name','u.user_name','u.email','u.mobile','u.is_active','u.is_delted','u.image','t.c_id')
                        ->join('technician as t', 't.u_id', '=', 'u.id')->where('u.is_delted','=','0')->where('t.c_id','=',$id)->where('u.role_id','=','3')
                        ->get()->all();

        $page = datatables()->of($usercompany)
     ->addColumn('name', function ($page) {
       return '<a href="' . URL::to('/company/index/') . '/' . $page->userid . '" style="color:#4dacc4">'.$page->first_name.'</a>';

     })
     ->editColumn('image', function ($page) {
            $disk = Storage::disk('public');
            if($page->image == '' || !$disk->exists('users_images/'.$page->image)) {
                $page->image = asset('storage/' . 'users_images/default.jpg');;
            } else {
                $page->image = asset('storage/' . 'users_images/' . $page->image);
            }
            return '<img src="'.$page->image.'" alt="" height="50" width="50" />';
        })
      ->addColumn('action', function ($page) {

              return '<a href="' . URL::to('/company/view_technician/') . '/' . $page->userid . '&'. $page->c_id .'" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
             

        })
      
      ->rawColumns(['action','name','id','image'])
      ->addIndexColumn()
      ->toJson();  

       return $page;

    }

public static function GetCompanyUserList(Request $request,$id){
        $title = 'Customer List';
        return view('company_user_list', compact('title','id'));
     
    }
    public static function GetCompanyUserListView(Request $request,$id){
   /* echo "<pre>";
     print_r(DB::table('users')->get()->all()); exit;*/
     $usercompany = $results = DB::table('users as u')
                        ->select('u.id as userid','u.id','u.first_name','u.last_name','u.user_name','u.email','u.mobile','u.is_active','u.is_delted','u.image','cu.c_id')
                        ->join('company_user as cu', 'cu.u_id', '=', 'u.id')->where('u.is_delted','=','0')->where('cu.c_id','=',$id)->where('u.role_id','=','4')
                        ->get()->all();
        $page = datatables()->of($usercompany)
     ->addColumn('name', function ($page) {
       return '<a href="' . URL::to('/company/index/') . '/' . $page->userid . '" style="color:#4dacc4">'.$page->first_name.'</a>';

     })
     ->editColumn('image', function ($page) {
            $disk = Storage::disk('public');
            if($page->image == '' || !$disk->exists('users_images/'.$page->image)) {
                $page->image = asset('storage/' . 'users_images/default.jpg');;
            } else {
                $page->image = asset('storage/' . 'users_images/' . $page->image);
            }
            return '<img src="'.$page->image.'" alt="" height="50" width="50" />';
        })
      ->addColumn('action', function ($page) {

              return '<a href="' . URL::to('/company/view_user/') . '/' . $page->userid . '&'. $page->c_id .'" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
            

        })
      
      ->rawColumns(['action','name','image'])
      ->addIndexColumn()
      ->toJson();  
       return $page;

    }

public static function ViewTechnician(Request $request,$userid,$id){

          $data = array();
          $user_detail = $results = DB::table('users as u')
          ->select('u.id as userid','u.first_name','u.last_name','u.dob','u.user_name','u.email','u.country_code','u.mobile','t.id','t.c_id','t.u_id','t.address','t.about','co.name as companyname','t.position','t.exprience','t.interests','t.fevouriteshows','t.fevoritebook','t.facebooklink','t.instagramlink','t.linkedin')
          ->join('technician as t', 't.u_id', '=', 'u.id')
          ->join('company as co', 'co.u_id', '=', 't.c_id')
          ->where('u.id',$userid)
          ->get()->first();
          $data['user_detail']=$user_detail;
          $title = 'View Technician Detail';
          $user_detail=$data;
        




          return view('view_technician',compact('title','user_detail','id'));

    }

    public static function ViewUser(Request $request,$userid,$id){
          
          $data = array();
          $user_detail = $results = DB::table('users as u')
          ->select('u.id as userid','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','us.id','us.c_id','us.u_id','us.scountry_code','us.sphone','us.address','us.about','co.name as companyname')
          ->join('company_user as us', 'us.u_id', '=', 'u.id')
          ->join('company as co', 'co.u_id', '=', 'us.c_id')
          ->where('u.id',$userid)
          ->get()->first();
          $data['user_detail']=$user_detail;
          $title = 'View Technician Detail';
          $user_detail=$data;
          return view('view_user',compact('title','user_detail','id'));

    }

    public static function EditPerticularCompany(Request $request,$id){
      
          $data = array();
          $user_detail = $results = DB::table('users as u')
          ->select('u.id as userid','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','c.id','c.name','c.email as personemail','c.country_code as pcode','c.phone','u.is_active','c.address','u.image')
          ->join('company as c', 'c.u_id', '=', 'u.id')
          ->where('u.id',$id)
          ->get()->first();
          $data['user_detail']=$user_detail;

          $member_detail  = DB::table('users as u')
          ->select('u.id as userid','u.first_name','u.last_name','u.email','u.country_code','u.mobile','c.position','u.image')
          ->join('company_employe as c', 'c.u_id', '=', 'u.id')
          ->where('c.c_id',$id)
          ->get()->all();
          $title = 'Company Detail page';
          $user_detail=$data;
          return view('edit-company',compact('title','user_detail','id','member_detail'));

    }

    public static function CompanyUseredit(Request $request){

      $name = $request->input('name');
      $ccode = $request->input('ccode');
      $phone = $request->input('phone');
      $email = $request->input('email');
      $address = $request->input('address');

      $fname = $request->input('fname');
      $lname = $request->input('lname');
      $pccode = $request->input('pccode');
      $pphone = $request->input('pphone');
      $pemail = $request->input('pemail');

      $uname = $request->input('uname');
      $pass = $request->input('pass');
      $image = $request->file('file');

      if(!empty($image)){

      ini_set('upload_max_filesize', '64M');
      ini_set('post_max_size', '64M');
      ini_set('max_execution_time', 300);

      $disk = Storage::disk('public');

      $name1 = $image->getClientOriginalName();
      $content = File::get($image);
      $image = time() . "_user_" . $name1;
      //Move Image to /app/storage/app/public/ Folder
      Storage::disk('uploads')->put('users_images/'.$image, $content);
      $disk->put('storage/users_images/'.$image, $content);
      $image_up = array(
      'image'=>$image,
      );
      DB::table('users')->where('id', $request->input('userid'))->update($image_up);  
      }
      if($pass){
      $postdata = array(
      'password'=>bcrypt($pass),
      'org_password'=>$pass,
      );
      DB::table('users')->where('id', $request->input('userid'))->update($postdata);  
      }
      $postdata =array(
      'role_id' => '2',
      'first_name'=>$fname,
      'last_name'=>$lname,
      'country_code'=>$pccode,
      'mobile'=>$pphone,
      'email'=>$pemail,
      'user_name'=>$uname,
      'created' => now(),
      );
      DB::table('users')->where('id', $request->input('userid'))->update($postdata);  

      $postdata_company=array(
      'name'=>$name,
      'country_code'=>$ccode,
      'phone'=>$phone,
      'email'=>$email,
      'address'=>$address,
      'created' => now(),
      );
      DB::table('company')->where('u_id', $request->input('userid'))->update($postdata_company); 
      $request->session()->flash('message', 'Record update successfully!');
      return redirect('/company/edit_perticular_company/'.$request->input('userid').''); 
      //return redirect('/admin/get_company_list'); 

    }
public static function ServiceCatagory(Request $request,$id){
    $title = 'Service catagory List';
    return view('service_catagory_list', compact('title','id'));
}
public static function GetCatagoryListView(Request $request,$id){
  
     $companycat = $results = DB::table('service_request_type')->where('c_id','=',$id)->where('is_delted','=','0')->get()->all();
        $page = datatables()->of($companycat)
      ->addColumn('action', function ($page) {
            
            return '<a href="' . URL::to('/company/edit-caragory/'). '/' . $page->c_id . '&'. $page->id .'"  class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
            <a href="' . URL::to('/company/delete-catagroy/'). '/' . $page->c_id . '&'. $page->id .'" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';
        })
      ->rawColumns(['action','id'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}

public static function AddCaragory(Request $request,$id){
    $title = 'Add new catagory';
    return view('add-new-catagory', compact('title','id'));
}
public static function InsertCatagroy(Request $request){
    $title = 'Add new catagory';
    $userid = $request->input('name');
    $description = $request->input('description');
    $cid = $request->input('userid');
    $postdata=array(
    'c_id' => $cid,
    'name' => $userid,
    'description'=>$description,
    'created' => now(),
    );
    $id = DB::table('service_request_type')->insertGetId($postdata);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/company/service_catagory/'.$cid.''); 
    
}

public static function EditCaragory(Request $request,$id,$userid){
    $title = 'Edit catagory';
    $data = array();
    $companycat = $results = DB::table('service_request_type')->where('c_id','=',$id)->where('id','=',$userid)->where('is_delted','=','0')->get()->first();
    $data['companycat']=$companycat;
    $companycat=$data;
   
    return view('edit_catagory', compact('title','id','companycat'));
}
public static function UpdateCatagroy(Request $request){
    $name = $request->input('name');
    $description = $request->input('description');
    $cid = $request->input('userid');
    $catid = $request->input('catid');

    $update_cat = array(
      'description'=>$description,
      'name'=>$name,
      );
      DB::table('service_request_type')->where('id', $catid)->where('c_id', $cid)->update($update_cat); 
       $request->session()->flash('message', 'Record update successfully!');
      return redirect('/company/service_catagory/'.$cid.''); 
      }
public static function DeleteCatagroy(Request $request,$id,$userid){
   if($userid){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('service_request_type')->where('id', $userid)->update($postdata_company); 
           return redirect('/company/service_catagory/'.$id.''); 
        }
      }
  
public static function Service(Request $request,$id){

    $title = 'Service List';
    return view('service_list', compact('title','id'));
}

public static function GetServiceListView(Request $request,$id){
     $companycat = $results = DB::table('service')

    /* ->select('s.*','iv.image_url','iv.video_url')
    ->join('service_image_video as iv', 'iv.s_id','=','s.id' )*/
     ->where('c_id','=',$id)->where('is_delted','=','0')->get()->all();

        $page = datatables()->of($companycat)

        ->addColumn('tec_id', function ($page) {

              $technician = $results = DB::table('technician as t')
              ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
              ->join('users as u', 'u.id','=','t.u_id' )
              ->where('u.id','=',$page->tec_id)->where('u.is_delted','=','0')->get()->first();
           
            return $technician->user_name;
        })
        ->addColumn('cus_id', function ($page) {
              $customers = $results = DB::table('company_user as cu')
     ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
     ->join('users as u', 'u.id','=','cu.u_id' )
     ->where('u.id','=',$page->cus_id)->where('u.is_delted','=','0')->get()->first();
          
            return $customers->user_name;
        })
      ->addColumn('action', function ($page) {
            
            $action = '<a href="' . URL::to('/company/edit-service/'). '/' . $page->c_id . '&'. $page->id .'"  class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';  
            return $action;
        })
      ->addColumn('report', function ($page) {
            $technician = $results = DB::table('technician as t')
            ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
            ->join('users as u', 'u.id','=','t.u_id' )
            ->where('u.id','=',$page->tec_id)->where('u.is_delted','=','0')->get()->first();

            $customers = $results = DB::table('company_user as cu')
            ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
            ->join('users as u', 'u.id','=','cu.u_id' )
            ->where('u.id','=',$page->cus_id)->where('u.is_delted','=','0')->get()->first();
            
            $Company = $results = DB::table('company as cu')
            ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'),'cu.report_type')
            ->join('users as u', 'u.id','=','cu.u_id' )
            ->where('u.id','=',$page->c_id)->where('u.is_delted','=','0')->get()->first();
         
              if($page->status == 'complete' AND $Company->report_type == 'standard'){
            $action = '  <button type="button" class="btn btn-xs btn-primary dataview" data-action="dataview" data-id= "'.$page->c_id.','.$technician->id.','.$customers->id.'" style="padding: 4px 6px;">View Technician Report</button>';
            } else if($page->status == 'complete' AND $Company->report_type == 'customization'){
               $action = '  <button type="button" class="btn btn-xs btn-primary dataview" data-action="dataview_custom" data-id= "'.$page->c_id.','.$technician->id.','.$customers->id.'" style="padding: 4px 6px;">View Technician Report</button>';
            } else{
              $action = '';
            }
            return $action;
        })
    
      ->rawColumns(['action','id','cus_id','report'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}
public static function AddService(Request $request,$id){
    $title = 'Add new service';
     $companycat = $results = DB::table('service_request_type')->where('c_id','=',$id)->where('is_delted','=','0')->get()->all();
     $technician = $results = DB::table('technician as t')
     ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
     ->join('users as u', 'u.id','=','t.u_id' )
     ->where('t.c_id','=',$id)->where('u.is_delted','=','0')->get()->all();

      $customers = $results = DB::table('company_user as cu')
     ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
     ->join('users as u', 'u.id','=','cu.u_id' )
     ->where('cu.c_id','=',$id)->where('u.is_delted','=','0')->get()->all();
    
    return view('add-new-service', compact('title','id','companycat','technician','customers'));
}

public static function InsertService(Request $request){

    $title = 'Add new catagory';
    $catagory = $request->input('catagory');
    $name = $request->input('name');
    $cprice = $request->input('cprice');
    $bprice = $request->input('bprice');
    $duration = $request->input('duration');
    $description = $request->input('description');
    $cid = $request->input('userid');
    $postdata=array(
    'service_cat_id' => $catagory,
    'c_id' => $cid,
    'name'=>$name,
    'cost_price'=>$cprice,
    'base_price'=>$bprice,
    'duration'=>$duration,
    'description'=>$description,
    'created' => now(),
    );
    $id = DB::table('service')->insertGetId($postdata);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/company/service/'.$cid.''); 
    
}
public static function EditService(Request $request,$id,$userid){

    $title = 'Edit Service';
    $data = array();
     $companycat = $results = DB::table('service as s')
  /*  ->select('s.*','iv.image_url','iv.video_url')
    ->join('service_image_video as iv', 'iv.s_id','=','s.id' )*/
     ->where('s.c_id','=',$id)->where('s.id','=',$userid)->where('s.is_delted','=','0')->get()->first();
    /* echo "<pre>";
    print_r($companycat); exit;*/
    $service_image = $results = DB::table('service_image_video')->where('s_id','=',$companycat->id)->get()->all();

     $companycat_list = $results = DB::table('service_request_type')->where('c_id','=',$id)->where('is_delted','=','0')->get()->all();

       $technician = $results = DB::table('technician as t')
     ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
     ->join('users as u', 'u.id','=','t.u_id' )
     ->where('t.c_id','=',$id)->where('u.is_delted','=','0')->get()->all();

      $customers = $results = DB::table('company_user as cu')
     ->select('u.id',DB::raw('CONCAT(first_name," ",last_name) as user_name'))
     ->join('users as u', 'u.id','=','cu.u_id' )
     ->where('cu.c_id','=',$id)->where('u.is_delted','=','0')->get()->all();

    $data['companycat']=$companycat;
    $companycat=$data;
   
    return view('edit_service', compact('title','id','companycat','companycat_list','technician','customers','service_image'));
}

public static function UpdateService(Request $request){
   
    $catagory = $request->input('catagory');
    $name = $request->input('name');
    $cprice = $request->input('cprice');
    $bprice = $request->input('bprice');
    $duration = $request->input('duration');
    $description = $request->input('description');
    $cid = $request->input('userid');
    $catid = $request->input('catid');
    $postdata=array(
    'service_cat_id' => $catagory,
    'c_id' => $cid,
    'name'=>$name,
    'cost_price'=>$cprice,
    'base_price'=>$bprice,
    'duration'=>$duration,
    'description'=>$description,
    'created' => now(),
    );
      DB::table('service')->where('id', $catid)->where('c_id', $cid)->update($postdata); 
       $request->session()->flash('message', 'Record update successfully!');
      return redirect('/company/service/'.$cid.''); 
      }
public static function DeleteService(Request $request,$id,$userid){
   if($userid){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('service')->where('id', $userid)->update($postdata_company); 
           return redirect('/company/service/'.$id.''); 
        }
      }

      public static function CompanyTutorial(Request $request,$id){
    $title = 'Tutorial List';
    return view('company_tutorial_list', compact('title','id'));
}
public static function CompanyTutorialListView(Request $request,$id){

     $companycat = $results = DB::table('tutorials')
     ->where('is_delted','=','0')->where('c_id','=',$id)->get()->all();

        $page = datatables()->of($companycat)

       ->editColumn('c_id', function ($page) {
          $companycat2 = $results = DB::table('users as u')
          ->select('c.name')
          ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.id','=',$page->c_id)->get()->first();
          return $companycat2->name;
        })
      ->editColumn('cat_id', function ($page) {
          $companycat1 = $results = DB::table('tutorial_catagory')
     ->where('is_delted','=','0')->where('id','=',$page->cat_id)->get()->first();
          return $companycat1->name;
        })
      ->editColumn('video_url', function ($page) {
            $disk = Storage::disk('public');

              if($page->video_url == '' || !$disk->exists('video_url/'.$page->video_url)) {
                $page->video_url = asset('storage/' . 'users_images/hqdefault.jpg');
                return '<img src="'.$page->video_url.'" alt=""  style="width: 250px;" />';
            } else {
                $page->video_url = asset('storage/' . 'video_url/' . $page->video_url);

                return '<div style="">
                <div class="media" data-src="'.$page->video_url.'" data-width="640" data-height="360"
                style="cursor:pointer;"><video src ="'.$page->video_url.'" style="width: 250px;"></video></div>
                </div>';
            }
            
          /*  if($page->video_url == '' || !$disk->exists('video_url/'.$page->video_url)) {
                $page->video_url = asset('storage/' . 'video_url/default.jpg');;
            } else {
                $page->video_url = asset('storage/' . 'video_url/' . $page->video_url);
            }
            return '<video width="100" height="100" controls><source src="'.$page->video_url.'" type="video/mp4"></video>';
           */
        })
      ->addColumn('action', function ($page) {
            return '<a href="' . URL::to('/company/company_tutorial_view/'). '/' . $page->c_id . '&'. $page->id .'"  class="btn btn-xs btn-primary"><i class="fa fa-eye"></i>';

           /* return '<a href="' . URL::to('/company/company_tutorial_view/'). '/' . $page->id . '"  class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';*/
        })
      ->rawColumns(['action','id','cat_id','video_url'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}
public static function CompanyTutorialView(Request $request,$id,$userid){

       $data = array();
           $user_detail = $results = DB::table('tutorials')
     ->where('is_delted','=','0')->where('id','=',$userid)->get()->first();
        
        $cat_name = $results = DB::table('users as u')
        ->select('c.name')
        ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.id','=',$user_detail->c_id)->get()->first();
        $catgoryname = $results = DB::table('tutorial_catagory')
        ->where('is_delted','=','0')->where('id','=',$user_detail->cat_id)->get()->first();
         $companyname = $catgoryname->name;
         $catname = $cat_name->name;
          $data['user_detail']=$user_detail;
          $title = 'View Tutorial Detail';
          $user_detail=$data;
 
          return view('view_company_tutorial',compact('title','user_detail','id','catname','companyname'));

    }

public static function ReportDetailCustom(Request $request){
  $id = $request->input('id');
  list($company, $technician,$customer) = explode(',', $id);
  $service = $results = DB::table('service')
  ->where('c_id','=',$company)->where('tec_id','=',$technician)->where('cus_id','=',$customer)->get()->first(); 
  $technician_report = $results = DB::table('technician_service_report_complete')
  ->where('c_id','=',$company)->where('tec_id','=',$technician)->where('cus_id','=',$customer)->get()->all(); 
  $title = array();
   $title_list = array();
   $bookings = array();
    $i = 1;
  foreach ($technician_report as $key => $value) {
     $type_report = $results = DB::table('service_report_type')
          ->where('id','=',$value->service_report_type_id)->get()->first();
      $subtype_report = $results = DB::table('service_report_subtype')
      ->where('id','=',$value->service_report_subtype_id)->where('r_id','=',$value->service_report_type_id)->get()->first();
         $data = '<li style="text-transform: capitalize;"><span><b>'.$subtype_report->name.'</b></span> :  <span id="fname">'.$value->service_report_value.'</span></li>';

         ?>
         <script type="text/javascript">
           $('#<?php echo strtok($type_report->name,  ' '); ?>').append('<?php echo $data; ?>');
           
         </script>
         <?php
          if (!in_array($type_report->name, $bookings)){
             $bookings[] = $type_report->name;
             echo '<div class="col-md-4" style="
            height: 181px;;">';
           echo  '<h4 style="text-decoration: underline;text-transform: uppercase;">'.$type_report->name.'</h4>
           ';
           echo '<ul id="'.strtok($type_report->name,  ' ').'"></ul></div>';

           }

           
         
  }
       echo '<div class="col-md-12" style="
            height: 181px;;">
           <h4 style="text-transform: uppercase;">Technician Note</h4>
            <p>'.$service->note_technician.'</p></div>';
?>

<?php 




}
public static function ReportDetail(Request $request){
   $id = $request->input('id');
   list($company, $technician,$customer) = explode(',', $id);
  $service = $results = DB::table('service')
  ->where('c_id','=',$company)->where('tec_id','=',$technician)->where('cus_id','=',$customer)->get()->first(); 
     $technician_report = $results = DB::table('technician_service_report_complete')
     ->where('c_id','=',$company)->where('tec_id','=',$technician)->where('cus_id','=',$customer)->get()->all();

      $Chemistry = array();
       $Chemicals = array();
        $Cleaning = array();
        $circulation = array();
        $Chemistrymothly = array();
        $Cleaner = array();
      foreach ($technician_report as $key => $value) {
        
          $type_report = $results = DB::table('service_report_type')
          ->where('id','=',$value->service_report_type_id)->get()->first();

       $subtype_report = $results = DB::table('service_report_subtype')
          ->where('id','=',$value->service_report_subtype_id)->where('r_id','=',$value->service_report_type_id)->get()->first();
          
          if($type_report->name == 'Chemistry'){
           
            $Chemistry[] = '<li style="text-transform: capitalize;"><span><b>'.$subtype_report->name.'</b></span> :  <span id="fname">'.$value->service_report_value.'</span></li>
           ';
          }else if($type_report->name == 'Chemicals'){
           
            $Chemicals[] = '<li style="text-transform: capitalize;"><span><b>'.$subtype_report->name.'</b></span> :  <span id="fname" >'.$value->service_report_value.'</span></li>
           ';
          }else if($type_report->name == 'Cleaning'){
            
            $Cleaning[] = '<li style="text-transform: capitalize;"><span><b>'.$subtype_report->name.'</b></span> :  <span id="fname" >'.$value->service_report_value.'</span></li>
           ';
           } else if($type_report->name == 'circulation'){
            
            $circulation[] = '<li style="text-transform: capitalize;"><span><b>'.$subtype_report->name.'</b></span> :  <span id="fname" >'.$value->service_report_value.'</span></li> 
           ';
           } else if($type_report->name == 'Chemistry Report (Monthly)'){
           
            $Chemistrymothly[] = '<li style="text-transform: capitalize;"><span><b>'.$subtype_report->name.'</b></span> :  <span id="fname" >'.$value->service_report_value.'</span> </li>
           ';
           } else if($type_report->name == 'Cleaner'){
             
            $Cleaner[] =  '<li style="text-transform: capitalize;"><span><b>'.$subtype_report->name.'</b></span> :  <span id="fname">'.$value->service_report_value.'</span></li> 
           ';
           }
         
      }
    $note =  '<h4 style="text-transform: uppercase;">Technician Note</h4>
    <p>'.$service->note_technician.'</p>';
        $arr= array();
        $arr['Chemistry'] = $Chemistry;
        $arr['Chemicals'] = $Chemicals;
        $arr['Cleaning'] = $Cleaning;
        $arr['circulation'] = $circulation;
        $arr['Chemistrymothly'] = $Chemistrymothly;
        $arr['Cleaner'] = $Cleaner;
        $arr['note'] = $note;
        echo json_encode($arr);
   
    


}

public static function GetcEmployeUserList(Request $request,$id){
        $title = 'Member List';
        return view('company_employe_list', compact('title','id'));
     
    }
    public static function GetCemployeListView(Request $request,$id){
   /* echo "<pre>";
     print_r(DB::table('users')->get()->all()); exit;*/
     $usercompany = $results = DB::table('users as u')
                        ->select('u.id as userid','u.id','u.first_name','u.last_name','u.user_name','u.email','u.mobile','u.is_active','u.is_delted','u.image','cu.c_id','cu.position')
                        ->join('company_employe as cu', 'cu.u_id', '=', 'u.id')->where('u.is_delted','=','0')->where('cu.c_id','=',$id)->where('u.role_id','=','5')
                        ->get()->all();

        $page = datatables()->of($usercompany)
     ->addColumn('name', function ($page) {
       return '<a href="' . URL::to('/company/index/') . '/' . $page->userid . '" style="color:#4dacc4">'.$page->first_name.'</a>';

     })
     ->editColumn('image', function ($page) {
            $disk = Storage::disk('public');
            if($page->image == '' || !$disk->exists('users_images/'.$page->image)) {
                $page->image = asset('storage/' . 'users_images/default.jpg');;
            } else {
                $page->image = asset('storage/' . 'users_images/' . $page->image);
            }
            return '<img src="'.$page->image.'" alt="" height="50" width="50" />';
        })
      ->addColumn('action', function ($page) {

              return '<a href="' . URL::to('/company/view_employe/') . '/' . $page->userid . '&'. $page->c_id .'" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
            

        })
      
      ->rawColumns(['action','name','image'])
      ->addIndexColumn()
      ->toJson();  
       return $page;

    }

     public static function Addemploye(Request $request,$id){

      $title = 'Register a New Member';
      return view('add-new-cemploye', compact('title','id'));

    } 

     public static function InsertEmploye(Request $request){
      $userid = $request->input('userid');
      $name = $request->input('name');
      $lname = $request->input('lname');
      $position = $request->input('position');
      $ccode = $request->input('ccode');
      $phone = $request->input('phone');
      $email = $request->input('email');
      $user_name = $request->input('email');
      $pass= $request->input('email');

      $sccode = $request->input('sccode');
      $sphone = $request->input('sphone'); 
      $address = $request->input('address');
      $about = $request->input('about');
      $image = $request->file('file');

        if(!empty($image)){

        ini_set('upload_max_filesize', '64M');
        ini_set('post_max_size', '64M');
        ini_set('max_execution_time', 300);

        $disk = Storage::disk('public');

        $name1 = $image->getClientOriginalName();
        $content = File::get($image);
        $image = time() . "_user_" . $name1;
        //Move Image to /app/storage/app/public/ Folder
        Storage::disk('uploads')->put('users_images/'.$image, $content);
        $disk->put('storage/users_images/'.$image, $content);
        }else{
        $image = '';
        }
      $postdata=array(
        'role_id' => '5',
        'first_name' => $name,
        'last_name'=>$lname,
        'user_name'=>$user_name,
        'email'=>$email,
        'country_code'=>$ccode,
        'mobile'=>$phone,
        'image'=>$image,
        'password'=>bcrypt($pass),
        'org_password'=>$pass,
        'register_date' => date("Y-m-d 00:00:00"),
        'created' => now(),
        );
      $id = DB::table('users')->insertGetId($postdata);

        $postdata=array(
        'c_id' => $userid,
        'u_id' => $id,
        'scountry_code'=>$sccode,
        'sphone'=>$sphone,
        'address'=>$address,
        'about'=> $about,
        'position'=> $position,
        'created' => now(),
        );
    $id = DB::table('company_employe')->insertGetId($postdata);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/company/index/'.$userid.''); 
    
    } 
  
  public static function Viewemploye(Request $request,$userid,$id){
          
          $data = array();
          $user_detail = $results = DB::table('users as u')
          ->select('u.id as userid','u.image','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','us.id','us.position','us.c_id','us.u_id','us.scountry_code','us.sphone','us.address','us.about','co.name as companyname')
          ->join('company_employe as us', 'us.u_id', '=', 'u.id')
          ->join('company as co', 'co.u_id', '=', 'us.c_id')
          ->where('u.id',$userid)
          ->get()->first();
          $data['user_detail']=$user_detail;
          $title = 'View Member Detail';
          $user_detail=$data;
          return view('view_employe',compact('title','user_detail','id'));

    }  

public static function logout(Request $request){
      
        $request->session()->flush();
        $request->session()->regenerate();     
        return redirect('/');   
        // return redirect()->route('login');
    }

}
