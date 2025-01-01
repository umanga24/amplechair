<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Team;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function __construct() {

       $customers=Client::all();


        View::share([

           'customers'=>$customers


        ]);
}}

