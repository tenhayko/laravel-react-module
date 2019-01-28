<?php

namespace Modules\Chat\Entities;

use App\User;
use App\UserInfo;
use Illuminate\Database\Eloquent\Model;

class MBOConversation extends Model
{
    protected $fillable = ['user_id','conversation_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
