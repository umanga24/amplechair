<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model{
    protected $fillable = ['email', 'full_name'];
}
