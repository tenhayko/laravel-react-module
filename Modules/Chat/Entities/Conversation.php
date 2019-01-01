<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [];
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function member()
    {
        return $this->hasMany(MBOConversation::class);
    }
}
