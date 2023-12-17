<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
use App\Models\User;
use Auth;

class CertificateController extends Controller
{
    // update or create certificate
    public function certificateUpdate(Request $request)
    {

        $this->validate($request, [
            'course_id' => 'required|string',
            'certificate_style' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
            'signature' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [
            'course_id' => 'Select a course to set certificate',
            'logo' => 'Max file size is 5 MB!',
            'signature' => 'Max file size is 5 MB!'
        ]);

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

            return redirect('instructor/profile/account-settings?tab=certificate')->with('success', 'Your certificate has been Updated successfully');


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

            return redirect('instructor/profile/account-settings?tab=certificate')->with('success', 'Your certificate has been SET successfully!');
        }

    }

    // custom certificate generate
    public function customCertificate(Request $request)
    {
       $courseId = $request->input('c_course_id');

        if (!$courseId) {
            return redirect('instructor/profile/account-settings?tab=certificate')->with('error', 'Failedd to Generate Certificate');
        }else{
            $course = Course::where('id', $courseId)->first();
        }

        $this->validate($request, [
            'c_first_name' => 'required|string',
            'c_last_name' => 'required|string',
            'c_course_id' => 'required',
            'c_completion_date' => 'required',
            'c_issue_date' => 'required',
            'c_logo' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
            'c_signature' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [
            'c_first_name' => 'First Name is required',
            'c_last_name' => 'Last Name is required',
            'c_course_id' => 'Select a course to set certificate',
            'c_completion_date' => 'Completion date is required',
            'c_issue_date' => 'Issue date is required',
            'c_logo' => 'Max file size is 5 MB!',
            'c_signature' => 'Max file size is 5 MB!'
        ]);

        if ($request->input('c_certificate_style')) {

            // style
            $certStyle =  $request->input('c_certificate_style');

            if ($certStyle == 3) {
                $certificate_path = 'certificates/generate/certificate1';
            }elseif ($certStyle == 2) {
                $certificate_path = 'certificates/generate/certificate2';

            }elseif ($certStyle == 1) {
                $certificate_path = 'certificates/generate/certificate3';
            }else{
                return redirect('instructor/profile/account-settings?tab=certificate')->with('error', 'Failedd to Generate Certificate');
            }

            // logo
            $logoPath = '';
            if ($request->hasFile('c_logo')) {

                $oldFile = public_path('uploads/certificate/temp/temp-logo.png');
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }

                $file = $request->file('c_logo');
                $image = Image::make($file);
                $uniqueFileName = 'temp-logo.png';
                $image->save(public_path('uploads/certificate/temp/') . $uniqueFileName);
                $image_path = 'uploads/certificate/temp/' . $uniqueFileName;

                $logoPath = $image_path;

           }else{
                $logoPath = 'latest/assets/images/certificate/one/logo.png';
            }

            // signature
            $signaturePath = '';
            if ($request->hasFile('c_signature')) {

                    $oldFile = public_path('uploads/certificate/temp/temp-signature.png');
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }

                    $file2 = $request->file('c_signature');
                    $image2 = Image::make($file2);
                    $uniqueFileName2 = 'temp-signature.png';
                    $image2->save(public_path('uploads/certificate/temp/') . $uniqueFileName2);
                    $image_path2 = 'uploads/certificate/temp/' . $uniqueFileName2;
                   $signaturePath = $image_path2;

               } else{
                $signaturePath = 'latest/assets/images/certificate/one/signature.png';
            }

            // completion date
            $courseCompletionDate = '';
            if ($request->input('c_completion_date')) {
                $courseCompletionDate = $request->input('c_completion_date');
            }

            // issue date
            $courseIssueDate = '';
            if ($request->input('c_issue_date')) {
                $courseIssueDate = $request->input('c_issue_date');
            }

            // name
            $fullName = $request->input('c_first_name') .' '. $request->input('c_last_name');

            // certificate color
            $certColor =  '';
            if ($request->input('c_certificate_clr')) {
                $certColor = $request->input('c_certificate_clr');
            }

            // accent color
            $accentColor =  '';
            if ($request->input('c_accent_clr')) {
                $accentColor = $request->input('c_accent_clr');
            }

            $pdf = PDF::loadView($certificate_path, ['course' => $course, 'courseCompletionDate' => $courseCompletionDate,'courseIssueDate' => $courseIssueDate, 'signature' => $signaturePath, 'logo' => $logoPath, 'fullName' => $fullName, 'certColor' => $certColor, 'accentColor' => $accentColor]);

            return $pdf->download('Learncosy-custom-certificate.pdf');
            return redirect('instructor/profile/account-settings?tab=certificate')->with('success', 'Certificate Generated Succesfully');


        }else{
            return redirect('instructor/profile/account-settings?tab=certificate')->with('error', 'Failedd to Generate Certificate');
        }
    }

    // delete certficate
    public function certificateDelete($subdomain,$id){

        $certificate = Certificate::findOrFail($id);

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
