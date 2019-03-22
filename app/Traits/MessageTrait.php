<?php
namespace App\Traits;
use App\User;

trait MessageTrait
{
    public function echoMessage()
    {
        echo '<pre>';
        print_r(User::all());
    }
}