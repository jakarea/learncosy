<?php

namespace App\Http\Controllers;

use App\Models\DNSSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Hazaveh\VerifyDomain\VerifyDomain;
use App\Models\InstructorModuleSetting;

class DNSSettingController extends Controller
{

    public function verifyDNS(Request $request){

        $module_settings = InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
        if ($module_settings) {
            $module_settings->value = json_decode($module_settings->value);
        }

        $request->session()->put('getDomain', $request->domain);

        return view('theme-settings/verify-dns-settings', compact('module_settings'));
    }


    public function verifyDNSStore(Request $request){

        $domain = $request->session()->get('getDomain');

        $existingDomain = DNSSetting::where([ 'instructor_id' => auth()->user()->id, 'domain' => $domain])->first();

        if ($existingDomain) {
            $existingDomain->update([
                'instructor_id' => auth()->user()->id,
                'domain' => $domain,
                'verify_by' => $request->verify_by,
                'verify_token' => $existingDomain->verify_token,
            ]);
        } else {
            $dns_settings = DNSSetting::create([
                'instructor_id' => auth()->user()->id,
                'domain' => $domain,
                'verify_by' => $request->verify_by,
                'verify_token' => substr(md5(time()), 0, 7),
            ]);
        }

        return redirect()->route('dns.setting.connect.dns', config('app.subdomain') )->with('success', 'Txt or file added successfully!');

    }

    public function connectDNS(){

        $module_settings = InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
        if ($module_settings) {
            $module_settings->value = json_decode($module_settings->value);
        }

        return view('theme-settings/connect-dns-setting', compact('module_settings'));
    }

    public function connectDNSStore(){

        $domain = request()->session()->get('getDomain');

        $existingDomain = DNSSetting::where([ 'instructor_id' => auth()->user()->id, 'domain' => $domain])->first();

        if ($existingDomain->domain !== $domain ){
            return back()->with('error', 'Your domain missmatch');
        }

        $domain = $existingDomain->domain;
        $verificationCode = $existingDomain->verify_token;


        // return dd( $verificationCode );

        // $ip = gethostbyname('www.cr7.ltd');
        // $dns_records = dns_get_record('cr7.ltd', DNS_TXT);


        $verify = new VerifyDomain();

        // Verify by DNS
        $byDNS = $verify->verifyByDNS($domain, $verificationCode);
        if( $byDNS ){
            $module_settings = InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
            if ($module_settings) {
                $module_settings->value = json_decode($module_settings->value);
            }
            return view('theme-settings/dns-setting-complete', compact('module_settings'));
        }else{
            return back()->with('error', 'Your domain missmatch');
        }

        // dd( $byDNS );

        // // Verify by File Content
        // $byFile = $verify->verifyByFile($domain, 'verification.txt', $verificationCode);

        // // Verify by Meta Tag
        // $byMeta = $verify->verifyByMeta($domain, 'verification', $verificationCode);

        // // Determine if verification is successful
        // $verificationStatus = $byDNS || $byFile || $byMeta;

        // request()->session()->forget('getDomain');


    }
}
