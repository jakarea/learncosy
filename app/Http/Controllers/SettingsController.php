<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
     // stripe settings
     public function stripeIndex()
     {  
         return view('settings/instructor/stripe'); 
     }

     // vimeo settings
     public function vimeoIndex()
     {  
         return view('settings/instructor/vimeo'); 
     }
}
