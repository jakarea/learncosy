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


        $originalUrl = $request->domain;

        $cleanedDomain = preg_replace('#^https?://|/$#', '', $originalUrl);

        $request->session()->put('getDomain', $cleanedDomain);

        return view('theme-settings/verify-dns-settings', compact('module_settings'))->with('tab', 'dns');
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
                'verify_token' => substr(md5(time()), 0, 20),
            ]);
        }

        return redirect()->route('dns.setting.connect.dns', config('app.subdomain') )->with('success', 'Txt or file added successfully!');

    }

    public function connectDNS(){

        $module_settings = InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
        if ($module_settings) {
            $module_settings->value = json_decode($module_settings->value);
        }

        $domain = request()->session()->get('getDomain');
        $existingDomain = DNSSetting::where([ 'instructor_id' => auth()->user()->id, 'domain' => $domain])->first();

        return view('theme-settings/connect-dns-setting', compact('module_settings','existingDomain'))->with('tab', 'dns');
    }

    public function connectDNSStore(){

        // $dns_records = dns_get_record('parisworldbd.com', DNS_TXT);
        // dd($dns_records);

        $domain = request()->session()->get('getDomain');
        $existingDomain = DNSSetting::where([ 'instructor_id' => auth()->user()->id, 'domain' => $domain])->first();
        if ($existingDomain->domain !== $domain ){
            return back()->with('error', 'Your domain missmatch');
        }

        $domain = $existingDomain->domain;
        $verificationCode = $existingDomain->verify_token;

        // $ip = gethostbyname('app.learncosy.com');
        // dd($ip);

        $verify = new VerifyDomain();
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

        // // Verify by File Content
        // $byFile = $verify->verifyByFile($domain, 'verification.txt', $verificationCode);

        // // Verify by Meta Tag
        // $byMeta = $verify->verifyByMeta($domain, 'verification', $verificationCode);

        // // Determine if verification is successful
        // $verificationStatus = $byDNS || $byFile || $byMeta;

        request()->session()->forget('getDomain');


    }
}
