<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
     // message
     public function index()
     {    
         return view('e-learning/course/instructor/message-list'); 
     }
 
     // instructor message list
     public function send()
     {    
         return view('e-learning/course/instructor/message'); 
     } 
}
