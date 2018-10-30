<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class email extends Mailable
{
    use Queueable, SerializesModels;
    public $user_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_arr)
    {        
        $this->data = $mail_arr;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {    
        $user_name = $this->data->user_name;
        $email = $this->data->email;
        $support_email = (isset($this->data->support_email) && $this->data->support_email != '')?$this->data->support_email:'';
        $support_mobile = (isset($this->data->support_mobile) && $this->data->support_mobile != '')?$this->data->support_mobile:'';
         $email = (isset($this->data->email) && $this->data->email != '')?$this->data->email:'';
        $password = (isset($this->data->password) && $this->data->password != '')?$this->data->password:'';
        if(isset($this->data->support_mobile) && $this->data->support_mobile != ''){
        $support_query = trans($language_file.'.any_query1').' <strong>'.$support_email.'</strong> '.trans($language_file.'.any_query2').' <strong>'.$support_mobile.'</strong>.';
        } else {
        $support_query = '';
        }
        $view_name = $this->data->view_name;
         $subject = $this->data->subject;
        return $this->view($view_name)
         ->subject($subject)
         ->with([
                    'user_name' => $user_name,
                    'email' =>$email,
                    'support_query' =>$support_query,
                ]);

    }
}
