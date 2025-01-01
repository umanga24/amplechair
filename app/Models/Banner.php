<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    // use HasFactory;
    protected $fillable=['sustain_image','client_banner','contact_banner','media_banner','certificate_banner','team_banner','proces_banner','career_banner','blog_banner'];
    
}
