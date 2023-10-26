<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\User;
use Auth;

class CertificateController extends Controller
{
    // update or create certificate
    public function certificateUpdate(Request $request)
    {

        $userId = Auth::user()->id;
        $courseId = $request->course_id;

        $certificate = Certificate::where('instructor_id', $userId)->where('course_id',$courseId)->first();

        if ($certificate) {

            if ($request->input('certificate_clr')) {
                $certificate->certificate_clr = $request->input('certificate_clr');
            }

            if ($request->input('accent_clr')) {
                $certificate->accent_clr = $request->input('accent_clr');
            }

            if ($request->input('certificate_style')) {
                $certificate->style = $request->input('certificate_style');
            } 

            $insSlug = Str::slug(Auth::user()->name);

            if ($request->hasFile('logo')) {
                if ($certificate->logo) {
                   $oldFile = public_path($certificate->logo);
                   if (file_exists($oldFile)) {
                       unlink($oldFile);
                   }
               }
                $file = $request->file('logo');
                $image = Image::make($file);
                $uniqueFileName = $insSlug . '-' . uniqid() . '.png';
                $image->save(public_path('uploads/certificate/') . $uniqueFileName);
                $image_path = 'uploads/certificate/' . $uniqueFileName;
               $certificate->logo = $image_path;
           } 

            if ($request->hasFile('signature')) {
                if ($certificate->signature) {
                   $oldFile2 = public_path($certificate->signature);
                   if (file_exists($oldFile2)) {
                       unlink($oldFile2);
                   }
               }
                $file2 = $request->file('signature');
                $image2 = Image::make($file2);
                $uniqueFileName2 = $insSlug . '-' . uniqid() . '.png';
                $image2->save(public_path('uploads/certificate/') . $uniqueFileName2);
                $image_path2 = 'uploads/certificate/' . $uniqueFileName2;
               $certificate->signature = $image_path2;
           } 

            $certificate->save();

            return redirect()->back()->with('success', 'Your certificate has been Updated successfully!');

        } else {

            $insSlug = Str::slug(Auth::user()->name);

            $newCertificate = new Certificate();
            $newCertificate->instructor_id = $userId;
            $newCertificate->course_id = $request->input('course_id');
            $newCertificate->certificate_clr = $request->input('certificate_clr');
            $newCertificate->accent_clr = $request->input('accent_clr');
            $newCertificate->style = $request->input('certificate_style');

            if ($request->hasFile('logo')) { 
                $file3 = $request->file('logo');
                $image3 = Image::make($file3);
                $uniqueFileName3 = $insSlug . '-' . uniqid() . '.png';
                $image3->save(public_path('uploads/certificate/') . $uniqueFileName3);
                $newLogoPath = 'uploads/certificate/' . $uniqueFileName3;
               $newCertificate->logo = $newLogoPath;
           } 

            if ($request->hasFile('signature')) { 
                $file4 = $request->file('signature');
                $image4 = Image::make($file4);
                $uniqueFileName4 = $insSlug . '-' . uniqid() . '.png';
                $image4->save(public_path('uploads/certificate/') . $uniqueFileName4);
                $newSigPath = 'uploads/certificate/' . $uniqueFileName4;
               $newCertificate->signature = $newSigPath;
           }  
            
            $newCertificate->save();

            return redirect()->back()->with('success', 'Your certificate has been SET successfully!');
        }

        
    }

    // custom certificate generate

    public function customCertificate(Request $request)
    {
        return $request->all();
    }

    // delete certficate 
    public function certificateDelete($id){

       $certificate = Certificate::find($id); 
       
         $certificateOldLogo = public_path($certificate->logo);
         if (file_exists($certificateOldLogo)) {
             @unlink($certificateOldLogo);
         }

         $certificateOldSignature = public_path($certificate->signature);
         if (file_exists($certificateOldSignature)) {
             @unlink($certificateOldSignature);
         }

         $certificate->delete();
    
        return redirect()->back()->with('success', 'Certificate has been Deleted successfully!');
    }
}
