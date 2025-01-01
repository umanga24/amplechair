<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sustain extends Model
{
    use HasFactory;
    protected $fillable = ['image1','description','short_description'];

}
