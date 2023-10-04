<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Auth;
use App\Models\InstructorModuleSetting;

class ModuleSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $module_settings = InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
        if ( $module_settings ) {
        $module_settings->value = json_decode($module_settings->value);
        }
        return view('theme-settings/settings', compact('module_settings'));
    }
    public function dnsTheme()
    {
        //
        $module_settings = InstructorModuleSetting::where('instructor_id', auth()->user()->id)->first();
        if ( $module_settings ) {
        $module_settings->value = json_decode($module_settings->value);
        }
        return view('theme-settings/theme-dns-settings', compact('module_settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // Store the InstructorModuleSetting in the database and check if image or logo has been uploaded
        $module_settings = InstructorModuleSetting::updateOrCreate(
            ['instructor_id' => auth()->user()->id],
            ['value' => json_encode($request->except('_token', 'image', 'logo', 'app_logo','lp_bg_image', 'favicon', 'apple_icon'))]
        );

        // return $request->all();

        // Check if image or logo has been uploaded
        if ($request->hasFile('image') || $request->hasFile('logo') || $request->hasFile('app_logo') || $request->hasFile('lp_bg_image') || $request->hasFile('favicon') || $request->hasFile('apple_icon')) {

            $userNameSlug = Str::slug(Auth::user()->name);

            // main logo
            if ($request->hasFile('logo')) { 
                if ($module_settings->logo) {
                    $oldLogo = public_path($module_settings->logo);
                    if (file_exists($oldLogo)) {
                        unlink($oldLogo);
                    }
                }
                $logo = $request->file('logo');
                $logoImage = Image::make($logo);
                $uniqueLogoName = $userNameSlug . '-' . uniqid() . '.webp';
                $logoImage->save(public_path('uploads/themes/') . $uniqueLogoName);
                $logo_path = 'uploads/themes/' . $uniqueLogoName;
                $module_settings->logo = $logo_path;
            }

            // app logo
            if ($request->hasFile('app_logo')) { 
                if ($module_settings->app_logo) {
                    $oldAppLogo = public_path($module_settings->app_logo);
                    if (file_exists($oldAppLogo)) {
                        unlink($oldAppLogo);
                    }
                }
                $appLogo = $request->file('app_logo');
                $appLogoImage = Image::make($appLogo);
                $uniqueAppLogoName = $userNameSlug . '-' . uniqid() . '.webp';
                $appLogoImage->save(public_path('uploads/themes/') . $uniqueAppLogoName);
                $app_logo_path = 'uploads/themes/' . $uniqueAppLogoName;
                $module_settings->app_logo = $app_logo_path;
            }

            // favicon
            if ($request->hasFile('favicon')) { 
                if ($module_settings->favicon) {
                    $oldFavicon = public_path($module_settings->favicon);
                    if (file_exists($oldFavicon)) {
                        unlink($oldFavicon);
                    }
                }
                $favicon = $request->file('favicon');
                $faviconImage = Image::make($favicon);
                $uniqueFaviconName = $userNameSlug . '-' . uniqid() . '.webp';
                $faviconImage->save(public_path('uploads/themes/') . $uniqueFaviconName);
                $favicon_path = 'uploads/themes/' . $uniqueFaviconName;
                $module_settings->favicon = $favicon_path;
            }


            // apple_icon
            if ($request->hasFile('apple_icon')) { 
                if ($module_settings->apple_icon) {
                    $oldAppleIcon = public_path($module_settings->apple_icon);
                    if (file_exists($oldAppleIcon)) {
                        unlink($oldAppleIcon);
                    }
                }
                $appleIcon = $request->file('apple_icon');
                $appleIconImage = Image::make($appleIcon);
                $uniqueAppleIconName = $userNameSlug . '-' . uniqid() . '.webp';
                $appleIconImage->save(public_path('uploads/themes/') . $uniqueAppleIconName);
                $appleIcon_path = 'uploads/themes/' . $uniqueAppleIconName;
                $module_settings->apple_icon = $appleIcon_path;
            }

            // login bg image
            if ($request->hasFile('lp_bg_image')) { 
                    if ($module_settings->lp_bg_image) {
                    $oldLoginBg = public_path($module_settings->lp_bg_image);
                    if (file_exists($oldLoginBg)) {
                        unlink($oldLoginBg);
                    }
                }
                $LoginBg = $request->file('lp_bg_image');
                $LoginBgimage = Image::make($LoginBg);
                $uniqueFileName = $userNameSlug . '-' . uniqid() . '.webp';
                $LoginBgimage->save(public_path('uploads/themes/') . $uniqueFileName);
                $LoginBgimage_path = 'uploads/themes/' . $uniqueFileName;
                $module_settings->lp_bg_image = $LoginBgimage_path;
            }


        } else {
            // If no image or logo is uploaded, retain the existing values
            $value = json_decode($module_settings->value, true);
            $module_settings->value = json_encode($value);
        }

        $module_settings->save();

        return back()->with('success', 'Module settings updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset($id)
    { 

        $item = InstructorModuleSetting::findOrFail($id);

        if ($item) {
            // login bg image delete
            $oldMainLogo = public_path($item->logo);
            if (file_exists($oldMainLogo)) {
                @unlink($oldMainLogo);
            }
            // login bg image delete
            $oldAppLogo = public_path($item->app_logo);
            if (file_exists($oldAppLogo)) {
                @unlink($oldAppLogo);
            }
            // login bg image delete
            $oldFavicon = public_path($item->favicon);
            if (file_exists($oldFavicon)) {
                @unlink($oldFavicon);
            }
            // login bg image delete
            $oldAppleIcon = public_path($item->apple_icon);
            if (file_exists($oldAppleIcon)) {
                @unlink($oldAppleIcon);
            }
            // login bg image delete
            $oldLoginBg = public_path($item->lp_bg_image);
            if (file_exists($oldLoginBg)) {
                @unlink($oldLoginBg);
            }
        }

        $value = ["primary_color" => "#f4f8fc","secondary_color"=>"#294cff","lp_layout"=>"","meta_title"=>"","meta_desc"=>""];
        $item->value = json_encode($value);
        $item->logo = null;
        $item->lp_bg_image = null;
        $item->apple_icon = null;
        $item->app_logo = null;
        $item->favicon = null;
 
        $item->save();
        
        return response()->json(['message' => 'Theme Reset']);
    }
}
