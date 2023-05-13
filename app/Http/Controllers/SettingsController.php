<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
     // account settings
     public function instructor_setting()
     {  
         return view('settings/instructor/index'); 
     }
}
