<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    public function updateDarkModePreference(Request $request)
    {
        $preferenceMode = $request->input('preferenceMode');  

        if ($preferenceMode == 'dark-mode') {
            session()->put([
                'darkModePreference' => $preferenceMode
            ]);
        }else{
            session()->put([
                'darkModePreference' => ''
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
