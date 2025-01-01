<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model{
    protected $fillable = ['name', 'phone', 'message', 'type', 'email'];
}
