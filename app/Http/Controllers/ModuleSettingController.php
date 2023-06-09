<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            ['value' => json_encode($request->except('_token', 'image', 'logo'))]
        );

        // Check if image or logo has been uploaded
        if ($request->hasFile('image') || $request->hasFile('logo') || $request->hasFile('lp_bg_image')) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/images/setting');
                $image->move($destinationPath, $image_name);
                $module_settings->image = $image_name;
            }

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logo_name = rand() . '.' . $logo->getClientOriginalExtension();
                $destinationPath = public_path('/assets/images/setting');
                $logo->move($destinationPath, $logo_name);
                $module_settings->logo = $logo_name;
            }

            if ($request->hasFile('lp_bg_image')) {
                $lp_bg_image = $request->file('lp_bg_image');
                $lp_bg_image_name = rand() . '.' . $lp_bg_image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/images/setting');
                $lp_bg_image->move($destinationPath, $lp_bg_image_name);
                $module_settings->lp_bg_image = $lp_bg_image_name;
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
    public function destroy($id)
    {
        //
    }
}
