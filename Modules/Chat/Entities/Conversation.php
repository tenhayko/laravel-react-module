<?php

namespace Modules\Chat\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('id','DESC');
    }

    public function member()
    {
        return $this->hasMany(MBOConversation::class);
    }
    
    public function user()
    {
        return $this->hasOne(UserConversation::class);
    }
}
