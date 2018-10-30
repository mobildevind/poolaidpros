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


class AdminController extends Controller
{
public static function index(Request $request){

    if ($request->session()->has('SESS_userid') && $request->session()->has('user_type') == '1') {
         return redirect('/admin/home');
    } else {

        $title = 'Login page';
    return view('login', compact('title'));
    }
}

public static function check_login(Request $request){
 
    if ($request->session()->has('SESS_userid') && $request->session()->has('user_type') == '1') {
        return redirect('/admin');
    }

    $username = $request->input('username');
    $password = $request->input('password');
 
    $checkandget = DB::table('users')->where('user_name',$username)->where('role_id','1')->get()->first();
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
        $message = 'User name not match';            
        $request->session()->put('login_message', $message);
    }
    return redirect('/');
}

 public function home(Request $request) {

    $title = 'Home Page';
    $get_data = DB::table('users as u')
    ->join('company as c', 'c.u_id', '=', 'u.id')
    ->where('u.role_id','2')->where('u.is_delted','0')->where('u.is_active','Y');
    $company = $get_data->count(); 
    $tech_get_data = DB::table('users as u')
    ->join('technician as t', 't.u_id', '=', 'u.id')
    ->leftJoin('users as u1', 'u1.id', '=', 't.c_id')
    ->where('u.role_id','3')->where('u.is_delted','0')
    ->where('u1.is_delted','=','0')
    ->where('u.is_active','Y');
    $technitian = $tech_get_data->count(); 
    $user_get_data = DB::table('users as u')
    ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
    ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
    ->where('u.role_id','4')->where('u.is_delted','0')
     ->where('u1.is_delted','=','0')
    ->where('u.is_active','Y');
    $users = $user_get_data->count(); 
     $employe_get_data = DB::table('users as u')
    ->join('company_employe as cu', 'cu.u_id', '=', 'u.id')
    ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
    ->where('u.role_id','5')->where('u.is_delted','0')
     ->where('u1.is_delted','=','0')
    ->where('u.is_active','Y');
    $employe = $employe_get_data->count(); 

     $tutorail = DB::table('tutorials')
    ->where('is_delted','0');
    
    $tutorials = $tutorail->count(); 


   /* $user_get_data = DB::table('users')->where('role_id','3')->where('is_delted','0')->where('new_request','Y');
    $users = $user_get_data->count();
    $evnet = DB::table('event')
    ->select('u.user_name','u.id as userid','event.*')
    ->join('users as u','u.id','=','event.user_id')->where('u.is_delted','0')
    ->where('start_datetime', '>=', date('Y-m-d H:i:s'));
    $event_upcomig = $evnet->count();  
    $evnetc = DB::table('event')
    ->select('u.user_name','u.id as userid','event.*')
    ->join('users as u','u.id','=','event.user_id')->where('u.is_delted','0')
    ->where('start_datetime', '<=', date('Y-m-d H:i:s'));
    $complete_event = $evnetc->count();  */
    return view('index', compact('title','company','employe','technitian','users','tutorials'));

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
          echo "gfg"; exit;
            $message->subject('PoolAid Pros Admin: Password!');
            //$message->from('felixthomas727@gmail.com', 'Website Name');                
            $message->to($getresults->email);
             $message->setBody($text, 'text/html');
        });    

      
    }
    echo $total;
   }
    }


    public static function AddCompany(Request $request){
      $title = 'Register a New Company';
      return view('add-new-company', compact('title'));

    }
    public static function InsertCompany(Request $request){
     
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
        }else{
        $image = '';
        }

        $postdata=array(
        'role_id' => '2',
        'first_name'=>$fname,
        'last_name'=>$lname,
        'country_code'=>$pccode,
        'mobile'=>$pphone,
        'email'=>$pemail,
        'image'=>$image,
        'user_name'=>$uname,
        'password'=>bcrypt($pass),
        'org_password'=>$pass,
        'register_date' => date("Y-m-d 00:00:00"),
        'created' => now(),
        );
    $id = DB::table('users')->insertGetId($postdata);

    $postdata_company=array(
        'u_id'=>$id,
        'name'=>$name,
        'country_code'=>$ccode,
        'phone'=>$phone,
        'email'=>$email,
        'address'=>$address,
        'created' => now(),
        );
    $lid = DB::table('company')->insertGetId($postdata_company);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/admin/get_company_list'); 
    }
    public static function GetCompanyList(Request $request){

        $title = 'Company List';
        return view('company_list', compact('title'));
     
    }
    public static function GetCompanyListView(Request $request){
   /* echo "<pre>";
     print_r(DB::table('users')->get()->all()); exit;*/
    

      $usercompany = $results = DB::table('users as u')
      ->select('u.id as userid','c.id','c.name','c.email','c.phone','u.is_active','u.is_delted','u.image')
      ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')->where('role_id','=','2')
      ->get()->all();

        $page = datatables()->of($usercompany)
     ->addColumn('name', function ($page) {
       return '<a href="' . URL::to('/company/index/') . '/' . $page->userid . '" style="color:#4dacc4">'.$page->name.'</a>';

     })
      ->addColumn('action', function ($page) {

              return '<a href="' . URL::to('/admin/view_company/') . '/' . $page->userid . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
              <a href="' . URL::to('/admin/edit_company/') . '/' . $page->userid . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <a href="' . URL::to('/admin/company_delete') . '/' . $page->userid . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';

        })
        ->addColumn('numberoftechnician', function ($page) {

          $tech_get_data = DB::table('users as u')
    ->join('technician as t', 't.u_id', '=', 'u.id')
    ->leftJoin('users as u1', 'u1.id', '=', 't.c_id')
    ->where('u.role_id','3')->where('u.is_delted','0')->where('c_id','=',$page->userid)
    ->where('u1.is_delted','=','0')
    ->where('u.is_active','Y');
    $technitian = $tech_get_data->count(); 
          
           return $technitian;
        })
        ->addColumn('numberofcustomer', function ($page) {
                $user_get_data = DB::table('users as u')
                ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
                ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
                ->where('u.role_id','4')->where('u.is_delted','0')->where('c_id','=',$page->userid)
                ->where('u1.is_delted','=','0')
                ->where('u.is_active','Y');
                $users = $user_get_data->count(); 
           return $users;
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
      ->addColumn('status', function ($page) {
         return '
            <input type="checkbox" name="status[]" data-id="'.$page->userid.'" data-toggle="toggle" data-on="<b>Active</b>" data-off="<b>Inactive</b>" data-size="normal" data-onstyle="success" data-offstyle="danger" '.(($page->is_active == 'Y') ? "checked" : "").' class="status_toggle_class">
            ';
             
        })
      ->rawColumns(['action','status','name','image'])
      ->addIndexColumn()
      ->toJson();  
       return $page;

    }
    public static function GetTechniciansList(Request $request){

        $title = 'Technicians List';
      $company_list = $results = DB::table('users as u')
      ->select('u.id','c.name')
      ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
      ->where('role_id','=','2')
      ->get()->all();
     
        return view('technician_list', compact('title','company_list'));
     
    }
    public static function GetTechniciansListView(Request $request){
   /* echo "<pre>";
     print_r(DB::table('users')->get()->all()); exit;*/
     $usercompany = $results = DB::table('users as u')
                        ->select('u.id as userid','t.c_id','u.first_name','u.last_name','u.user_name','u.email','u.mobile','u.is_active','u.is_delted','u1.is_delted as deleted','u.image')
                        ->join('technician as t', 't.u_id', '=', 'u.id')
                        ->leftJoin('users as u1', 'u1.id', '=', 't.c_id')
                        ->where('u.is_delted','=','0')
                        ->where('u1.is_delted','=','0')
                        ->where('u.role_id','=','3');

      if ($request->input('search_company')) {
      $c_id =$request->input('search_company');
      $usercompany = $usercompany->where("t.c_id", $c_id)->get()->all();
      } else {
      $usercompany = $usercompany->get()->all();
      }        
        $page = datatables()->of($usercompany)
     ->addColumn('name', function ($page) {
       return '<a href="' . URL::to('/company/index/') . '/' . $page->userid . '" style="color:#4dacc4">'.$page->first_name.'</a>';

     })
     ->addColumn('Company', function ($page) {
            $company_list = $results = DB::table('company')->where('u_id','=',$page->c_id)->get()->first();

              return $company_list->name;;

        })
      ->addColumn('action', function ($page) {

              return '
              <a href="' . URL::to('/admin/edit_tecnician/') . '/' . $page->userid . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <a href="' . URL::to('/admin/technicians_delete') . '/' . $page->userid . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';

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
      ->addColumn('status', function ($page) {
         return '
            <input type="checkbox" name="status[]" data-id="'.$page->userid.'" data-toggle="toggle" data-on="<b>Active</b>" data-off="<b>Inactive</b>" data-size="normal" data-onstyle="success" data-offstyle="danger" '.(($page->is_active == 'Y') ? "checked" : "").' class="status_toggle_class">
            ';
             
        })
      ->rawColumns(['action','status','name','image'])
      ->addIndexColumn()
      ->toJson(); 

       return $page;

    }
    
    public static function GetUserList(Request $request){

        $title = 'Customer List';
          $company_list = $results = DB::table('users as u')
    ->select('u.id','c.name')
    ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
    ->where('role_id','=','2')
    ->get()->all();

        return view('user_list', compact('title','company_list'));
     
    }
    public static function GetUserListView(Request $request){
   /* echo "<pre>";
     print_r(DB::table('users')->get()->all()); exit;*/

     $usercompany = $results = DB::table('users as u')
                        ->select('u.id as userid','u.id','u.first_name','u.last_name','u.user_name','u.email','u.mobile','u.is_active','u.is_delted','u1.is_delted','u.image','cu.c_id')
                        ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
                        ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
                        ->where('u.is_delted','=','0')
                        ->where('u1.is_delted','=','0');
           
      if ($request->input('search_company')) {
      $c_id =$request->input('search_company');
      $usercompany = $usercompany->where("cu.c_id", $c_id)->get()->all();
      } else {
      $usercompany = $usercompany->get()->all();
      }      
        $page = datatables()->of($usercompany)
     ->addColumn('name', function ($page) {
       return '<a href="' . URL::to('/company/index/') . '/' . $page->userid . '" style="color:#4dacc4">'.$page->first_name.'</a>';

     })->addColumn('company', function ($page) {
            $company_list = $results = DB::table('company')->where('u_id','=',$page->c_id)->get()->first();
            
              return $company_list->name;

        })
      ->addColumn('action', function ($page) {

              return '
              <a href="' . URL::to('/admin/edit_user') . '/' . $page->userid . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <a href="' . URL::to('/admin/user_delete') . '/' . $page->userid . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';

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
      ->addColumn('status', function ($page) {
         return '
            <input type="checkbox" name="status[]" data-id="'.$page->userid.'" data-toggle="toggle" data-on="<b>Active</b>" data-off="<b>Inactive</b>" data-size="normal" data-onstyle="success" data-offstyle="danger" '.(($page->is_active == 'Y') ? "checked" : "").' class="status_toggle_class">
            ';
             
        })
      ->rawColumns(['action','status','name','image'])
      ->addIndexColumn()
      ->toJson();  
       return $page;

    }
    public static function EditCompany(Request $request,$id){
      
          $data = array();
          $user_detail = $results = DB::table('users as u')
          ->select('u.id as userid','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','c.id','c.name','c.email as personemail','c.country_code as pcode','c.phone','u.is_active','c.address','u.image')
          ->join('company as c', 'c.u_id', '=', 'u.id')
          ->where('u.id',$id)
          ->get()->first();
          $data['user_detail']=$user_detail;
          $title = 'Edit Company';
          $user_detail=$data;
          return view('edit-company',compact('title','user_detail'));

    }
    public static function ViewCompany(Request $request,$id){
      
          $data = array();
          $user_detail  = DB::table('users as u')
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
          
          $title = 'Edit Company';
          $user_detail=$data;
          return view('view_company',compact('title','user_detail','member_detail'));

    }
    public static function useredit(Request $request){
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
      );
      DB::table('users')->where('id', $request->input('userid'))->update($postdata);  

      $postdata_company=array(
      'name'=>$name,
      'country_code'=>$ccode,
      'phone'=>$phone,
      'email'=>$email,
      'address'=>$address,
      );
      DB::table('company')->where('u_id', $request->input('userid'))->update($postdata_company); 
      $request->session()->flash('message', 'Record update successfully!');
      return redirect('/admin/get_company_list'); 

    }
    public static function CompanyDelete(Request $Request,$id){
        if($id){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('users')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/get_company_list');
        }
    }
    public static function UpdateStatus(Request $request){
        $id = $request->input('id'); 
        $status = $request->input('status');
        DB::table('users')->where('id',$id)->update(['is_active'=>$status]);
        echo $status;   
    }

    
    public static function EditTecnician(Request $request,$id){
      
          $data = array();
          $user_detail = $results = DB::table('users as u')
          ->select('u.id as userid','u.first_name','u.last_name','u.dob','u.user_name','u.email','u.country_code','u.mobile','c.id','u.is_active','c.address','c.about','u.image','c.position','c.exprience','c.interests','c.fevouriteshows','c.fevoritebook','c.facebooklink','c.instagramlink','c.linkedin')
          ->join('technician as c', 'c.u_id', '=', 'u.id')
          ->where('u.id',$id)
          ->get()->first();
          $data['user_detail']=$user_detail;
          $title = 'Edit Company';
          $user_detail=$data;
          return view('edit-technician',compact('title','user_detail','id'));

    }
     public static function UpdateTecnician(Request $request){

      $userid = $request->input('userid');
     $name = $request->input('name');
      $lname = $request->input('lname');
      $ccode = $request->input('ccode');
      $phone = $request->input('phone');
      $sccode = $request->input('sccode');
      $sphone = $request->input('sphone');
      $email = $request->input('email');
      $address = $request->input('address');
      $salary = $request->input('salary');
      $salary_recurrency = $request->input('salary_recurrency');
      $username = $request->input('username');
      $password = $request->input('pass');
      $about = $request->input('about');
      $position = $request->input('position');
      $exp = $request->input('exp');
      $dob = date("Y-m-d", strtotime($request->input('dob')));
      $interests = $request->input('interests');
      $fevoriteshows = $request->input('fevoriteshows');
      $fevoritebook = $request->input('fevoritebook');
      $facebook = $request->input('facebook');
      $instagram = $request->input('instagram');
      $linkedin = $request->input('linkedin');
     

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
      if($password){
      $postdata = array(
      'password'=>bcrypt($password),
      'org_password'=>$password,
      );
      DB::table('users')->where('id', $userid)->update($postdata);  
      }
      $postdata =array(
      'role_id' => '3',
      'first_name'=>$name,
      'last_name'=>$lname,
      'country_code'=>$ccode,
      'mobile'=>$phone,
      'dob'=>$dob,
      'email'=>$email,
      'user_name'=>$username,
      );


      DB::table('users')->where('id', $userid)->update($postdata);  

      $postdata_technician=array(
        'address'=>$address,
        'position'=>$position,
        'exprience'=>$exp,
        'interests'=>$interests,
        'fevouriteshows'=>$fevoriteshows,
        'fevoritebook'=>$fevoritebook,
        'facebooklink'=>$facebook,
        'instagramlink'=>$instagram,
        'linkedin'=>$linkedin,
        'about'=>$about,
      );

      
      DB::table('technician')->where('u_id', $userid)->update($postdata_technician); 
      $request->session()->flash('message', 'Record update successfully!');
      return redirect('/admin/get_technicians_list'); 
     }

     public static function techniciansDelete(Request $Request,$id){
      
        if($id){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('users')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/get_technicians_list');
        }
    }
     public static function UserDelete(Request $Request,$id){
      
        if($id){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('users')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/get_user_list');
        }
    }

    public static function EditUser(Request $request,$id){

    $data = array();
    $user_detail = $results = DB::table('users as u')
    ->select('u.id as userid','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','cu.scountry_code','cu.sphone','cu.id','cu.address','cu.about','u.image')
    ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
    ->where('u.id',$id)
    ->get()->first();
    $data['user_detail']=$user_detail;
    $title = 'Edit Customer';
    $user_detail=$data;

    return view('edit-user',compact('title','user_detail','id'));

    }

    public static function UpdateUser(Request $request){
    $userid = $request->input('userid');
    $name = $request->input('name');
    $lname = $request->input('lname');
    $ccode = $request->input('ccode');
    $phone = $request->input('phone');
    $sccode = $request->input('sccode');

    $sphone = $request->input('sphone');
    $email = $request->input('email');
    $address = $request->input('address');
    $username = $request->input('username');
    $password = $request->input('pass');
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
      $image_up = array(
      'image'=>$image,
      );
      DB::table('users')->where('id', $request->input('userid'))->update($image_up);  
      }
    if($password){
    $postdata = array(
    'password'=>bcrypt($password),
    'org_password'=>$password,
    );
    DB::table('users')->where('id', $userid)->update($postdata);  
    }
    $postdata =array(
    'first_name'=>$name,
    'last_name'=>$lname,
    'country_code'=>$ccode,
    'mobile'=>$phone,
    'email'=>$email,
    'user_name'=>$username,
    
    );
    DB::table('users')->where('id', $userid)->update($postdata);  

    $postdata_user=array(
    'scountry_code'=>$sccode,
    'sphone'=>$sphone,
    'address'=>$address,
    'about'=>$about,
   
    );

    DB::table('company_user')->where('u_id', $userid)->update($postdata_user); 
    $request->session()->flash('message', 'Record update successfully!');
    return redirect('/admin/get_user_list'); 
    }

     public static function AddCTechnician(Request $request){
       $id = '';
  
      $company_list = $results = DB::table('users as u')
       ->select('u.id','c.name')
       ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
      ->where('role_id','=','2')
      ->get()->all();
      $title = 'Register a New Technician';
      return view('add-new-technician', compact('title','id','company_list'));

    } 

    public static function InsertCTechnician(Request $request){
      $userid = $request->input('company');
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

  /*    $sccode = $request->input('sccode');
      $sphone = $request->input('sphone'); 
      
      $salary = $request->input('salary');
      $salary_recurrency = $request->input('salary_recurrency');*/
      
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
    return redirect('/admin/get_technicians_list'); 
    
    }

     public static function AddCuser(Request $request){
      $id = '';
       $company_list = DB::table('users as u')
      ->select('u.id','c.name')
      ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
      ->where('role_id','=','2')
      ->get()->all();
     
      $title = 'Register a New Customer';
      return view('add-new-user', compact('title','id','company_list'));

    } 

     public static function InsertCuser(Request $request){
      $userid = $request->input('company');
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
    return redirect('/admin/get_user_list'); 
    
    } 

    public static function TutorialCatagory(Request $request){
    $title = 'Tutorial catagory List';
    return view('tutorial_catagory_list', compact('title'));
}
public static function GettutorialListView(Request $request){

     $companycat = $results = DB::table('tutorial_catagory')
     ->where('is_delted','=','0')->get()->all();
    
        $page = datatables()->of($companycat)
      ->addColumn('action', function ($page) {
            
            return '<a href="' . URL::to('/admin/edit-tutorial/'). '/' . $page->id . '"  class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
            <a href="' . URL::to('/admin/delete-tutorial/'). '/' . $page->id . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';
        })
      ->rawColumns(['action','id'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}
public static function AddTutorial(Request $request){
    $title = 'Add new catagory';
    return view('add-new-tutorial-catagory', compact('title','id'));
}

public static function InsertTutorial(Request $request){
    $title = 'Add new catagory';
    $name = $request->input('name');
    $postdata=array(
    'name' => $name,
    'created' => now(),
    );
    $id = DB::table('tutorial_catagory')->insertGetId($postdata);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/admin/tutorial_catagory/'); 
    
}
public static function Edittutorial(Request $request,$id){
    $title = 'Edit catagory';
    $data = array();
    $companycat = $results = DB::table('tutorial_catagory')->where('id','=',$id)->where('is_delted','=','0')->get()->first();
    $data['companycat']=$companycat;
    $companycat=$data;
   
    return view('edit_tutorial_catagory', compact('title','companycat'));
}
public static function Updatetutorial(Request $request){
    $name = $request->input('name');
    $catid = $request->input('catid');

    $update_cat = array(
      'name'=>$name,
      );
      DB::table('tutorial_catagory')->where('id', $catid)->update($update_cat); 
       $request->session()->flash('message', 'Record update successfully!');
      return redirect('/admin/tutorial_catagory/'); 
      }
public static function DeleteTutorial(Request $request,$userid){
   if($userid){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('tutorial_catagory')->where('id', $userid)->update($postdata_company); 
           return redirect('/admin/tutorial_catagory/'); 
        }
      }
 
public static function AddtUtutorial(Request $request){
    $title = 'Add New Tutorial';
    $catagory = DB::table('tutorial_catagory')->where('is_delted', '0')->get()->all(); 
    $company_list = $results = DB::table('users as u')
    ->select('u.id','c.name')
    ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
    ->where('role_id','=','2')
    ->get()->all();
    return view('add_tutorial', compact('title','catagory','company_list'));

  }

public static function InserttUtutorial(Request $request){
    $title = 'Add new Tutorial';
    $catagory = $request->input('catagory');
    $title = $request->input('title');
    $company = $request->input('company');
    $keyword = $request->input('keyword');
    $description = $request->input('description');
    $company = $request->input('company');
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
    Storage::disk('uploads')->put('video_url/'.$image, $content);
    $disk->put('storage/video_url/'.$image, $content);
    }else{
    $image = '';
    }
    $postdata=array(
    'c_id' => $company,
    'video_url'=>$image,
    'title'=>$title,
    'description'=>$description,
    'cat_id'=>$catagory,
    'keyword'=>$keyword,
    'created' => now(),
    );
    $id = DB::table('tutorials')->insertGetId($postdata);
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/admin/tutorial/'); 
    
}

public static function EditUtutorial(Request $request,$id){

        $data = array();
         $user_detail = $results = DB::table('tutorials')
        ->where('is_delted','=','0')->where('id','=',$id)->get()->first();

        $cat_name = $results = DB::table('users as u')
        ->select('c.name')
        ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.id','=',$user_detail->c_id)->get()->first();
        $catgoryname = $results = DB::table('tutorial_catagory')
        ->where('is_delted','=','0')->where('id','=',$user_detail->cat_id)->get()->first();
       
        $data['user_detail']=$user_detail;
        $title = 'Edit Tutorial Detail';
        $user_detail=$data;
        $catagory = DB::table('tutorial_catagory')->where('is_delted', '0')->get()->all();
       
        return view('edit_tutorial',compact('title','user_detail','id','catagory'));

        
}

public static function UpdateUtutorial(Request $request){
    $cat_id = $request->input('userid');
    $catagory = $request->input('catagory');
    $title = $request->input('title');
    $keyword = $request->input('keyword');
    $description = $request->input('description');
    $company = $request->input('company');
    
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
    Storage::disk('uploads')->put('video_url/'.$image, $content);
    $disk->put('storage/video_url/'.$image, $content);
     $update_cat = array(
      'video_url'=>$image,
      );
    DB::table('tutorials')->where('id', $cat_id)->update($update_cat); 
    }
    $update_cat = array(
      'cat_id'=>$catagory,
      'title'=>$title,
      'keyword'=>$keyword,
      'description'=>$description,
      'c_id'=>$company,
      );
      DB::table('tutorials')->where('id', $cat_id)->update($update_cat); 
       $request->session()->flash('message', 'Record update successfully!');
      return redirect('/admin/tutorial/'); 
      }
  public static function DeleteUtutorial(Request $request,$userid){
   if($userid){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('tutorials')->where('id', $userid)->update($postdata_company); 
           return redirect('/admin/tutorial/'); 
        }
      }
public static function tutorial(Request $request){
    $title = 'Tutorial List';
    $company_list = $results = DB::table('users as u')
    ->select('u.id','c.name')
    ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
    ->where('role_id','=','2')
    ->get()->all();
    return view('tutorial_list', compact('title','company_list'));
}
public static function TutorialListView(Request $request){

     $companycat = $results = DB::table('tutorials')
     ->where('is_delted','=','0');

        if ($request->input('search_company')) {
        $c_id =$request->input('search_company');
        $companycat = $companycat->where("c_id", $c_id)->get()->all();
        } else {
        $companycat = $companycat->get()->all();
        }    

        $page = datatables()->of($companycat)

       /*->editColumn('c_id', function ($page) {
          $companycat2 = $results = DB::table('users as u')
          ->select('c.name')
          ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.id','=',$page->c_id)->get()->first();
          return $companycat2->name;
        })*/
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
                style="cursor:pointer;"><video  src ="'.$page->video_url.'" style="width: 250px;" accept="video/*"></video></div>
                </div>';
            }
        
            //return '<video width="100" height="100" controls><source src="'.$page->video_url.'" type="video/mp4"></video>';
           
        })
      ->addColumn('action', function ($page) {
            return '<a href="' . URL::to('/admin/tutorial_view/'). '/' . $page->id . '"  class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>  <a href="' . URL::to('/admin/edit-ututorial/'). '/' . $page->id . '"  class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>  <a href="' . URL::to('/admin/delete-ututorial') . '/' . $page->id . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';
        })
      ->rawColumns(['action','id','cat_id','video_url'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}

public static function TutorialView(Request $request,$id){


          $data = array();
           $user_detail = $results = DB::table('tutorials')
     ->where('is_delted','=','0')->where('id','=',$id)->get()->first();
        
       /* $cat_name = $results = DB::table('users as u')
        ->select('c.name')
        ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.id','=',$user_detail->c_id)->get()->first();*/
     
        $catgoryname = $results = DB::table('tutorial_catagory')
        ->where('is_delted','=','0')->where('id','=',$user_detail->cat_id)->get()->first();
         $companyname = $catgoryname->name;
       /*  $catname = $cat_name->name;*/
          $data['user_detail']=$user_detail;
          $title = 'View Tutorial Detail';
          $user_detail=$data;
 
          return view('view_tutorial',compact('title','user_detail','id','catname','companyname'));

    }

    public static function Report(Request $request){
    $title = 'Report';
    return view('add-report', compact('title'));
}
 public static function CompanyReportListView(Request $request){

     $companycat = $results = DB::table('users as u')
     ->select('u.*','c.name','c.email as cemail')
     ->join('company as c', 'c.u_id', '=', 'u.id')
     ->where('is_delted','=','0')->where('role_id','=','2');

 if ($request->input('minDate') || $request->input('maxDate')) {
            $minDate = Model::date_custom_format_utc_from_timezone($request->input('minDate') . ' ' . date('H:i:s'), 'AST');
            $maxDate = Model::date_custom_format_utc_from_timezone($request->input('maxDate') . ' ' . date('H:i:s'), 'AST');
            $companycat = $companycat->whereBetween("u.register_date", [$minDate, $maxDate])->get()->all();
        } else {
            $companycat = $companycat->get()->all();
        }
        $page = datatables()->of($companycat)
        ->editColumn('numberoftechnician', function ($page) {

          $tech_get_data = DB::table('users as u')
    ->join('technician as t', 't.u_id', '=', 'u.id')
    ->leftJoin('users as u1', 'u1.id', '=', 't.c_id')
    ->where('u.role_id','3')->where('u.is_delted','0')->where('c_id','=',$page->id)
    ->where('u1.is_delted','=','0')
    ->where('u.is_active','Y');
    $technitian = $tech_get_data->count(); 
          
           return $technitian;
        })
        ->addColumn('name', function ($page) {
        return '<a href="' . URL::to('/company/index/') . '/' . $page->id . '" style="color:#4dacc4">'.$page->name.'</a>';

        })
        ->editColumn('numberofcustomer', function ($page) {
                $user_get_data = DB::table('users as u')
                ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
                ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
                ->where('u.role_id','4')->where('u.is_delted','0')->where('c_id','=',$page->id)
                ->where('u1.is_delted','=','0')
                ->where('u.is_active','Y');
                $users = $user_get_data->count(); 
           return $users;
        })
      ->addColumn('action', function ($page) {
            return '<a href="' . URL::to('/admin/tutorial_view/'). '/' . $page->id . '"  class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
        })
      ->rawColumns(['action','name'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}

  public static function CustomerReport(Request $request){
    $title = 'Customer Report';
     $company_list = $results = DB::table('users as u')
      ->select('u.id','c.name')
      ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
      ->where('role_id','=','2')
      ->get()->all();
    return view('customer-report_list', compact('title','company_list'));
}
 public static function CustomerReportListView(Request $request){

     $companycat = $results = DB::table('users as u')
     ->select('u.*','co.name as companyname')
     ->join('company_user as c', 'c.u_id', '=', 'u.id')
     ->leftjoin('company as co', 'co.u_id', '=', 'c.c_id')
     ->where('is_delted','=','0')->where('role_id','=','4');

    if ($request->input('search_company') || $request->input('maxDate') || $request->input('minDate')) {
              
                if($request->input('maxDate') || $request->input('minDate')){
                $minDate = Model::date_custom_format_utc_from_timezone($request->input('minDate') . ' ' . date('H:i:s'), 'AST');
                $maxDate = Model::date_custom_format_utc_from_timezone($request->input('maxDate') . ' ' . date('H:i:s'), 'AST');
                $companycat = $companycat->whereBetween("u.register_date", [$minDate, $maxDate]);
               }
                if($request->input('search_company')){
                $search_company = $request->input('search_company');
                $companycat = $companycat->where("c.c_id", $search_company);
               }
                 $companycat = $companycat->get()->all();
     
          } else {
              $companycat = $companycat->get()->all();
          }



        $page = datatables()->of($companycat)
        ->editColumn('numberoftechnician', function ($page) {

          $tech_get_data = DB::table('users as u')
    ->join('technician as t', 't.u_id', '=', 'u.id')
    ->leftJoin('users as u1', 'u1.id', '=', 't.c_id')
    ->where('u.role_id','3')->where('u.is_delted','0')->where('c_id','=',$page->id)
    ->where('u1.is_delted','=','0')
    ->where('u.is_active','Y');
    $technitian = $tech_get_data->count(); 
          
           return $technitian;
        })
        ->editColumn('numberofcustomer', function ($page) {
                $user_get_data = DB::table('users as u')
                ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
                ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
                ->where('u.role_id','4')->where('u.is_delted','0')->where('c_id','=',$page->id)
                ->where('u1.is_delted','=','0')
                ->where('u.is_active','Y');
                $users = $user_get_data->count(); 
           return $users;
        })
      ->addColumn('action', function ($page) {
            return '<a href="' . URL::to('/admin/tutorial_view/'). '/' . $page->id . '"  class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
        })
      ->rawColumns(['action'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}
 public static function techniciansReport(Request $request){
    $title = 'Technicians Report';
     $company_list = $results = DB::table('users as u')
      ->select('u.id','c.name')
      ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
      ->where('role_id','=','2')
      ->get()->all();
    return view('technicians_report_list', compact('title','company_list'));
}
 public static function techniciansReportListView(Request $request){

     $companycat = $results = DB::table('users as u')
     ->select('u.*','co.name as companyname')
     ->join('technician as t', 't.u_id', '=', 'u.id')
     ->leftjoin('company as co', 'co.u_id', '=', 't.c_id')
     ->where('is_delted','=','0')->where('role_id','=','3');

    if ($request->input('search_company') || $request->input('maxDate') || $request->input('minDate')) {
              
                if($request->input('maxDate') || $request->input('minDate')){
                $minDate = Model::date_custom_format_utc_from_timezone($request->input('minDate') . ' ' . date('H:i:s'), 'AST');
                $maxDate = Model::date_custom_format_utc_from_timezone($request->input('maxDate') . ' ' . date('H:i:s'), 'AST');
                $companycat = $companycat->whereBetween("u.register_date", [$minDate, $maxDate]);
               }
                if($request->input('search_company')){
                $search_company = $request->input('search_company');
                $companycat = $companycat->where("t.c_id", $search_company);
               }
                 $companycat = $companycat->get()->all();
     
          } else {
              $companycat = $companycat->get()->all();
          }



        $page = datatables()->of($companycat)
        ->editColumn('numberoftechnician', function ($page) {

          $tech_get_data = DB::table('users as u')
    ->join('technician as t', 't.u_id', '=', 'u.id')
    ->leftJoin('users as u1', 'u1.id', '=', 't.c_id')
    ->where('u.role_id','3')->where('u.is_delted','0')->where('c_id','=',$page->id)
    ->where('u1.is_delted','=','0')
    ->where('u.is_active','Y');
    $technitian = $tech_get_data->count(); 
          
           return $technitian;
        })
        ->editColumn('numberofcustomer', function ($page) {
                $user_get_data = DB::table('users as u')
                ->join('company_user as cu', 'cu.u_id', '=', 'u.id')
                ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
                ->where('u.role_id','4')->where('u.is_delted','0')->where('c_id','=',$page->id)
                ->where('u1.is_delted','=','0')
                ->where('u.is_active','Y');
                $users = $user_get_data->count(); 
           return $users;
        })
      ->addColumn('action', function ($page) {
            return '<a href="' . URL::to('/admin/tutorial_view/'). '/' . $page->id . '"  class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
        })
      ->rawColumns(['action'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}

public static function requestReport(Request $request){
    $title = 'Extra service requests report';
     $company_list = $results = DB::table('users as u')
      ->select('u.id','c.name')
      ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
      ->where('role_id','=','2')
      ->get()->all();
    return view('service_requests_report', compact('title','company_list'));
}
 public static function requestReportListView(Request $request){

    /* $companycat = $results = DB::table('users as u')
     ->select('u.*','co.name as companyname')
     ->join('service as s', 's.u_id', '=', 'u.id')
     ->leftjoin('company as co', 'co.u_id', '=', 's.c_id')
     ->where('is_delted','=','0')->where('role_id','=','3');
*/

      $companycat = $results = DB::table('extra_service_request as s')
      ->select('s.*','c.name as companyname','u.first_name as username')
      ->join('company as c', 'c.u_id', '=', 's.c_id')
      ->leftjoin('users as u', 'u.id', '=', 's.cus_id')->where('s.status','=','pending');
      

    if ($request->input('search_company') || $request->input('maxDate') || $request->input('minDate')) {
              
                if($request->input('maxDate') || $request->input('minDate')){
                $minDate = Model::date_custom_format_utc_from_timezone($request->input('minDate') . ' ' . date('H:i:s'), 'AST');
                $maxDate = Model::date_custom_format_utc_from_timezone($request->input('maxDate') . ' ' . date('H:i:s'), 'AST');
                $companycat = $companycat->whereBetween("s.date", [$minDate, $maxDate]);
               }
                if($request->input('search_company')){
                $search_company = $request->input('search_company');
                $companycat = $companycat->where("s.c_id", $search_company);
               }
                 $companycat = $companycat->get()->all();
     
          } else {
              $companycat = $companycat->get()->all();
          }


        $page = datatables()->of($companycat)
        
      ->addColumn('action', function ($page) {
            return 
            '<a href="' . URL::to('/admin/reject_request') . '/' . $page->id . '" class="btn btn-xs btn-primary reject" class="glyphicon glyphicon-remove"><i class="fa fa-ban"></i></a>  <a href="' . URL::to('/admin/accept_request') . '/' . $page->id . '" class="btn btn-xs btn-primary accept" class="glyphicon glyphicon-remove"><i class="fa fa-check"></i></a>';
        })
      ->rawColumns(['action'])
      ->addIndexColumn()
      ->toJson();  

       return $page;
}
public static function Rejectrequest(Request $Request,$id){
        if($id){
            $postdata_company=array(
            'status'=>'cancel',
            );
            DB::table('extra_service_request')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/request_report');
        }
    }
    public static function acceptrequest(Request $Request,$id){
        if($id){
            $postdata_company=array(
            'status'=>'complete',
            );
            DB::table('extra_service_request')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/request_report');
        }
    }

    

     public static function check_mobile(Request $request) {
       $phone = $request->input('phone');
       $type = $request->input('type');
       $id = $request->input('id');
   
    if($id){
      
    $services2 = DB::table('users')
                        ->where('id', '!=', $id)
                        ->where('mobile', '=', $phone)
                        ->where('role_id', '=', $type)
                        ->get()->all();
   if(count($services2) > 0 ){
        echo 'false';
    }else{
        echo 'true';
    }
    }else{

      $services2 = DB::table('users')
                        ->where('mobile', '=', $phone)
                         ->where('role_id', '=', $type)
                        ->get()->all();
   if(count($services2) > 0 ){
        echo 'false';
    }else{
        echo 'true';
    } 

    }

    
    }

     public static function check_email() {
    $id = $_GET['id']; 
    $email = $_GET['email']; 
    $type = $_GET['type']; 
    
    if($id){
      
    $services2 = DB::table('users')
                        ->where('id', '!=', $id)
                        ->where('email', '=', $email)
                        ->where('role_id', '=', $type)
                        ->get()->all();
   if(count($services2) > 0 ){
        echo 'false';
    }else{
        echo 'true';
    }
    }else{

      $services2 = DB::table('users')
                        ->where('email', '=', $email)
                         ->where('role_id', '=', $type)
                        ->get()->all();
   if(count($services2) > 0 ){
        echo 'false';
    }else{
        echo 'true';
    } 

    }

    
    }

    public static function SubscriptionPlanList(Request $request){
        $title = 'Subscription Plan List';
        return view('subscription_list', compact('title'));
    }
    public static function GetSubscriptionPlanList(Request $request){

      $usercompany = $results = DB::table('subscription_plan')->where('is_deleted','=','0')->get()->all();

      $page = datatables()->of($usercompany)
      ->addColumn('action', function ($page) {

      return '<a href="' . URL::to('/admin/edit_subscription/') . '/' . $page->id . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
       <a href="' . URL::to('/admin/delete-subscription') . '/' . $page->id . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';

      })->rawColumns(['action'])
      ->addIndexColumn()
      ->toJson();  
      return $page;
    }

    public static function AddSubscription(Request $request){

       $title = 'Add New Subscription Plan';
    return view('add_subscription', compact('title'));

    }
    public static function Inserttsubscription(Request $request){
       $title = $request->input('title');
      $price = $request->input('price');
      $day = $request->input('day');
      
        $postdata=array(
        'plantitle'=>$title,
        'price'=>$price,
        'days'=>$day,
        'created' => now(),
        );
    $id = DB::table('subscription_plan')->insertGetId($postdata);

  
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/admin/subscription_plan_list'); 
    }


     public static function Editsubscription(Request $request,$id){
      
          $data = array();
          $user_detail = $results = DB::table('subscription_plan')
          ->where('id',$id)
          ->get()->first();
          $data['subscription_detail']=$user_detail;
          $title = 'Edit Subscription Plan';
          $subscription_detail=$data;
          return view('edit_subscription',compact('title','subscription_detail'));

    }
    

 public static function Updatesubscription(Request $request){
        $userid = $request->input('userid');
        $title = $request->input('title');
        $price = $request->input('price');
        $day = $request->input('day');
      
      $postdata =array(
      'plantitle'=>$title,
      'price'=>$price,
      'days'=>$day,
      );


      DB::table('subscription_plan')->where('id', $userid)->update($postdata);  

      $request->session()->flash('message', 'Record update successfully!');
      return redirect('/admin/subscription_plan_list');
    }
    
    public static function Deletesubscription(Request $Request,$id){
        if($id){
            $postdata_company=array(
            'is_deleted'=>'1',
            );
            DB::table('subscription_plan')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/subscription_plan_list');
        }
    }
    public static function EquipmentPlanList(Request $request){
         $title = 'Equipment List';
        return view('equipment_list', compact('title'));    
    }
    public static function Getequipmentlist(Request $request){

      $usercompany = $results = DB::table('equipment')->where('is_deleted','=','0')->get()->all();

      $page = datatables()->of($usercompany)
       ->editColumn('photo', function ($page) {
            $disk = Storage::disk('public');
            if($page->photo == '' || !$disk->exists('users_images/'.$page->photo)) {
                $page->photo = asset('storage/' . 'users_images/default.jpg');;
            } else {
                $page->photo = asset('storage/' . 'users_images/' . $page->photo);
            }
            return '<img src="'.$page->photo.'" alt="" height="50" width="50" />';
        })
      ->addColumn('action', function ($page) {

      return '<a href="' . URL::to('/admin/view_equipment/') . '/' . $page->id . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
      <a href="' . URL::to('/admin/edit_equipment/') . '/' . $page->id . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
      <a href="' . URL::to('/admin/delete-equipment') . '/' . $page->id . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';

      })->rawColumns(['action','photo'])
      ->addIndexColumn()
      ->toJson();  
      return $page;
    }

    public static function Addequipment(Request $request){

       $title = 'Add New Equipment';
    return view('add_equipment', compact('title'));

    }

    public static function Inserttequipment(Request $request){
       $name = $request->input('name');
      $image = $request->file('file');
      $description = $request->input('description');

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
        'name'=>$name,
        'description'=>$description,
        'photo'=>$image,
        'created' => now(),
        );
    $id = DB::table('equipment')->insertGetId($postdata);

  
    $request->session()->flash('message', 'Record added successfully!');
    return redirect('/admin/equipment_list'); 
    }


     public static function Editequipment(Request $request,$id){
      
          $data = array();
          $user_detail = $results = DB::table('equipment')
          ->where('id',$id)
          ->get()->first();
          $data['equipment_detail']=$user_detail;
          $title = 'Edit equipment';
          $equipment_detail=$data;
          return view('edit_equipment',compact('title','equipment_detail'));

    }
     public static function Viewequipment(Request $request,$id){
      
          $data = array();
          $user_detail = $results = DB::table('equipment')
          ->where('id',$id)
          ->get()->first();
          $data['equipment_detail']=$user_detail;
          $title = 'View equipment';
          $equipment_detail=$data;
          return view('view_equipment',compact('title','equipment_detail'));

    }
     public static function Updateequipment(Request $request){
        $name = $request->input('name');
        $image = $request->file('file');
        $description = $request->input('description');
        $userid = $request->input('userid');
      

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
      'photo'=>$image,
      );
      DB::table('equipment')->where('id', $request->input('userid'))->update($image_up);  
      }

      $postdata =array(
      'name'=>$name,
      'description'=>$description,
      );

      DB::table('equipment')->where('id', $request->input('userid'))->update($postdata);  
   
      $request->session()->flash('message', 'Record update successfully!');
      return redirect('/admin/equipment_list');
    }
    
    public static function Deleteequipment(Request $Request,$id){
        if($id){
            $postdata_company=array(
            'is_deleted'=>'1',
            );
            DB::table('equipment')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/equipment_list');
        }
    }

     public static function GetemployeList(Request $request){

        $title = 'Member List';
          $company_list = $results = DB::table('users as u')
    ->select('u.id','c.name')
    ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
    ->where('role_id','=','2')
    ->get()->all();

        return view('employe_list', compact('title','company_list'));
     
    }
    public static function GetemployeListView(Request $request){
   /* echo "<pre>";
     print_r(DB::table('users')->get()->all()); exit;*/

     $usercompany = $results = DB::table('users as u')
                        ->select('u.id as userid','u.id','u.first_name','u.last_name','u.user_name','u.email','u.mobile','u.is_active','u.is_delted','u1.is_delted','u.image','cu.c_id','cu.position')
                        ->join('company_employe as cu', 'cu.u_id', '=', 'u.id')
                        ->leftJoin('users as u1', 'u1.id', '=', 'cu.c_id')
                        ->where('u.is_delted','=','0')
                        ->where('u1.is_delted','=','0');
                       
      if ($request->input('search_company')) {
      $c_id =$request->input('search_company');
      $usercompany = $usercompany->where("cu.c_id", $c_id)->get()->all();
      } else {
      $usercompany = $usercompany->get()->all();
      } 

        $page = datatables()->of($usercompany)
     ->addColumn('name', function ($page) {
       return '<a href="' . URL::to('/company/index/') . '/' . $page->userid . '" style="color:#4dacc4">'.$page->first_name.'</a>';

     })->addColumn('company', function ($page) {
            $company_list = $results = DB::table('company')->where('u_id','=',$page->c_id)->get()->first();
            
              return $company_list->name;

        })
      ->addColumn('action', function ($page) {

              return '
              <a href="' . URL::to('/admin/view_employe') . '/' . $page->userid . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> <a href="' . URL::to('/admin/edit_employe') . '/' . $page->userid . '" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <a href="' . URL::to('/admin/employe_delete') . '/' . $page->userid . '" class="btn btn-xs btn-primary delete" class="glyphicon glyphicon-remove"><i class="fa fa-trash-o"></i></a>';

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
      ->addColumn('status', function ($page) {
         return '
            <input type="checkbox" name="status[]" data-id="'.$page->userid.'" data-toggle="toggle" data-on="<b>Active</b>" data-off="<b>Inactive</b>" data-size="normal" data-onstyle="success" data-offstyle="danger" '.(($page->is_active == 'Y') ? "checked" : "").' class="status_toggle_class">
            ';
             
        })
      ->rawColumns(['action','status','name','image'])
      ->addIndexColumn()
      ->toJson();  
       return $page;

    }
public static function Viewemploye(Request $request,$id){
          
          $data = array();
          $user_detail = $results = DB::table('users as u')
          ->select('u.id as userid','u.image','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','us.id','us.position','us.c_id','us.u_id','us.scountry_code','us.sphone','us.address','us.about','co.name as companyname')
          ->join('company_employe as us', 'us.u_id', '=', 'u.id')
          ->join('company as co', 'co.u_id', '=', 'us.c_id')
          ->where('u.id',$id)
          ->get()->first();
          $data['user_detail']=$user_detail;
          $title = 'View Member Detail';
          $user_detail=$data;
          return view('view_cemplyee',compact('title','user_detail'));

    }
     public static function Addemploye(Request $request){
      $id = '';
       $company_list = DB::table('users as u')
      ->select('u.id','c.name')
      ->join('company as c', 'c.u_id', '=', 'u.id')->where('u.is_delted','=','0')
      ->where('role_id','=','2')
      ->get()->all();
    
      $title = 'Register a New Member';
      return view('add-new-employe', compact('title','id','company_list'));

    } 

     public static function Insertemploye(Request $request){

      $userid = $request->input('company');
      $position = $request->input('position');
      $name = $request->input('name');
      $lname = $request->input('lname');
      $ccode = $request->input('ccode');
      $phone = $request->input('phone');
      $email = $request->input('email');
      $user_name = $request->input('username');
      $pass= $request->input('pass');

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
    return redirect('/admin/get_employe_list'); 
    
    } 


     public static function Editemploye(Request $request,$id){

    $data = array();
    $user_detail = $results = DB::table('users as u')
    ->select('u.id as userid','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','cu.scountry_code','cu.sphone','cu.id','cu.address','cu.about','cu.position','u.image')
    ->join('company_employe as cu', 'cu.u_id', '=', 'u.id')
    ->where('u.id',$id)
    ->get()->first();
    $data['user_detail']=$user_detail;
    $title = 'Edit Member';
    $user_detail=$data;

    return view('edit-employe',compact('title','user_detail','id'));

    }

    public static function Updateemploye(Request $request){
    $userid = $request->input('userid');
    $name = $request->input('name');
    $lname = $request->input('lname');
    $position = $request->input('position');
    $ccode = $request->input('ccode');
    $phone = $request->input('phone');
    $sccode = $request->input('sccode');

    $sphone = $request->input('sphone');
    $email = $request->input('email');
    $address = $request->input('address');
    $username = $request->input('username');
    $password = $request->input('pass');
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
      $image_up = array(
      'image'=>$image,
      );
      DB::table('users')->where('id', $request->input('userid'))->update($image_up);  
      }
    if($password){
    $postdata = array(
    'password'=>bcrypt($password),
    'org_password'=>$password,
    );
    DB::table('users')->where('id', $userid)->update($postdata);  
    }
    $postdata =array(
    'first_name'=>$name,
    'last_name'=>$lname,
    'country_code'=>$ccode,
    'mobile'=>$phone,
    'email'=>$email,
    'user_name'=>$username,
    
    );
    DB::table('users')->where('id', $userid)->update($postdata);  

    $postdata_user=array(
    'scountry_code'=>$sccode,
    'sphone'=>$sphone,
    'address'=>$address,
    'about'=>$about,
    'position'=>$position,
   
    );

    DB::table('company_employe')->where('u_id', $userid)->update($postdata_user); 
    $request->session()->flash('message', 'Record update successfully!');
    return redirect('/admin/get_employe_list'); 
    }
     public static function EmployeDelete(Request $Request,$id){
      
        if($id){
            $postdata_company=array(
            'is_delted'=>'1',
            );
            DB::table('users')->where('id', $id)->update($postdata_company); 
            return redirect('/admin/get_employe_list');
        }
    }
    public function changepassword(Request $request) {
      $checkandget = DB::table('users')->where('role_id','1')->get()->first();
         
          $title ='Change Password page';
          return view('changepassword', compact('title','checkandget'));
      }
       public function updatepassword(Request $request){
       
         
         $username = $request->input('username');
         $old_password = $request->input('old_password');
          $password = $request->input('new_password');
          $checkandget = DB::table('users')->where('org_password',$old_password)->where('id','1')->where('role_id','1')->get()->first();
           if(!empty($checkandget)){

               if(Hash::check($old_password, $checkandget->password)){
                  DB::table('users')->where('id','1')->update(['org_password'=>$password,'password'=>bcrypt($password),'user_name'=>$username]);
                  $message = 'Profile update successfully';
                  $request->session()->put('message', $message);
               }else{
                  $message = 'Old password not Match';
                  $request->session()->put('message', $message);
               }
          }else{
                $message = 'Password not match';            
              $request->session()->put('message', $message);
          }
          return redirect('/admin/changepassword/');
      }
    public static function logout(Request $request){
      
        $request->session()->flush();
        $request->session()->regenerate();     
        return redirect('/');   
        // return redirect()->route('login');
    }

}
