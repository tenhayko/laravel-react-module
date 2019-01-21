<?php

namespace App;

use Modules\Chat\Entities\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Modules\Chat\Entities\UserConversation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }
    public function conversationUser()
    {
        $user_id = Auth::guard('web')->user()->id;
        if($this->hasOne(UserConversation::class, 'user_one', 'id')->where('user_two', $user_id)->exists()){
            return $this->hasOne(UserConversation::class, 'user_one', 'id')->where('user_two', $user_id);
        }
        return $this->hasOne(UserConversation::class, 'user_two', 'id')->where('user_one', $user_id);
    }
}
