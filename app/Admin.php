<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password','profile_image','phone'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token){
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function response()
    {
        return $this->hasMany('App\Response');
    }

    public function createnotifyadmin($encode){
        $notifyadmin = new AdminNotification();
        $notifyadmin->type= 'App\Notifications\AdminNotification';
        $notifyadmin->notifiable_type= 'App\User';
        $notifyadmin->notifiable_id= $this->id;
        $notifyadmin->data = $encode;
        $notifyadmin->save();
    }

    public function notifications()
    {
        return $this->morphMany('App\AdminNotification', 'notifiable')->orderBy('created_at', 'desc');
    }

}
