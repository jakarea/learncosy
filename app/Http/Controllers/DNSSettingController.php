<?php

namespace App\Http\Controllers;

use App\Models\DNSSetting;
use Illuminate\Http\Request;

class DNSSettingController extends Controller
{
    public function storeDNS(Request $request)
    {
        $dns_settings = DNSSetting::updateOrCreate(
            ['instructor_id' => auth()->user()->id],
            ['domain' => $request->domain]
        );
        return back()->with('success', 'DNS added successfully!');
    }

    public function verifyDNS(Request $request){
        $dns_settings = DNSSetting::where('instructor_id', auth()->user()->id)->firstOrFail();

        $dns_settings->update([
            'verify_by' => $request->verify_by,
            'verify_token' => substr(md5(time()), 0, 7),
        ]);
        return back()->with('success', 'Txt or file added successfully!');
    }
}
