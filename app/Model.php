<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Edujugon\PushNotification\PushNotification;
use Twilio\Rest\Client;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Support\Facades\File;
use Storage;
use Session;

class Model extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

 public static function date_custom_format_utc_from_timezone($date, $timezone) {
        //convert as per timezone from utc

        $dateInLocal = new \DateTime($date, new \DateTimeZone('UTC'));
        $dateInLocal->setTimezone(new \DateTimeZone($timezone));
        $date_format = $dateInLocal->format('Y-m-d');
        return $date_format;
    }
   
}
