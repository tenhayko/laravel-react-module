<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userInfor extends Model
{
    protected $fillable = ['name', 'phone', 'mail', 'thunhap', 'hinhthucvay', 'sotienvay', 'status', 'created_at', 'updated_at', 'id', 'note'];
}
