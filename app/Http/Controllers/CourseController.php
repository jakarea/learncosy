<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use File;
use DataTables;
use ZipArchive;
use App\Models\Cart;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Checkout;
use App\Models\CourseLog;
use App\Models\Certificate;
use App\Models\course_like;
use Illuminate\Support\Str;
use App\Models\BundleCourse;
use App\Models\BundleSelect;
use App\Models\CourseReview;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\CourseActivity;

class CourseController extends Controller
{
    // course list
    public function index()
    {

        $queryParams = request()->except('page');

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $courses = Course::where('user_id', Auth::user()->id);

        if ($title) {
            $courses->where(function ($query) use ($title) {
                $categories = explode(',', trim($title));
                foreach ($categories as $category) {
                    $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                }
            });
        }

        if ($status) {
            if ($status == 'oldest') {
                $courses->orderBy('id', 'asc');
            }

            if ($status == 'best_rated') {
                $courses = Course::leftJoin('course_reviews', 'courses.id', '=', 'course_reviews.course_id')
                    ->select('courses.*', \DB::raw('COALESCE(AVG(course_reviews.star), 0) as avg_star'))
                    ->groupBy('courses.id')
                    ->where('courses.user_id', Auth::user()->id)
                    ->orderBy('avg_star', 'desc');
            }

            if ($status == 'most_purchased') {
                $courses = Course::with(['user', 'reviews'])
                    ->withCount('checkouts as sale_count')
                    ->where('user_id', auth()->id())
                    ->orderByDesc('sale_count', 'desc');
            }

            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        } else {
            $courses->orderBy('id', 'desc');
        }

        $courses = $courses->paginate(12)->appends($queryParams);

        return view('e-learning/course/instructor/list', compact('courses'));
    }

    // course show
    public function show($domain, $id)
    {
        $course = Course::where('id', $id)->with('modules.lessons', 'user')->first();

        //start group file
        $lesson_files = Lesson::where('course_id', $course->id)->select('lesson_file as file')->get();
        $group_files = [];

        foreach ($lesson_files as $lesson_file) {
            if (!empty($lesson_file->file)) {
                $file_name = $lesson_file->file;
                $file_arr = explode('.', $lesson_file->file);
                $extention = $file_arr[1];
                if (!in_array($extention, $group_files)) {
                    $group_files[] = $extention;
                }
            }
        }


        $relatedCourses = [];

        if ($course->categories) {
            $categoryArray = explode(',', $course->categories);

            $relatedCourses = Course::where('instructor_id', $course->instructor_id)
                ->where('status', 'published')
                ->where('id', '!=', $course->id)
                ->where(function ($query) use ($categoryArray) {
                    foreach ($categoryArray as $category) {
                        $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                    }
                })
                ->take(3)
                ->get();
        }


        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();

        $totalModules = $course->modules->where('status', 'published')->count();

        // $totalLessons = $course->modules->sum(function ($module) {
        //     return $module->lessons->filter(function ($lesson) {
        //         return $lesson->status == 'published';
        //     })->count();
        // });

        $totalLessons = $course->modules->filter(function ($module) {
            return $module->status === 'published';
        })->map(function ($module) {
            return $module->lessons()->where('status', 'published')->count();
        })->sum();


        // last playing video
        $courseLog = CourseLog::where('course_id', $course->id)->where('user_id', auth()->user()->id)->first();
        $currentLessonVideo = NULL;
        $currentLesson = NULL;

        if ($courseLog) {
            $lesson = Lesson::find($courseLog->lesson_id);
            if ($lesson) {
                $currentLesson = $lesson;
                $currentLessonVideo = str_replace("/videos/", "", $lesson->video_link);
            }
        }

        if ($course) {
            return view('e-learning/course/instructor/show', compact('course', 'course_reviews', 'relatedCourses', 'totalModules', 'totalLessons', 'group_files', 'currentLessonVideo', 'currentLesson'));
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        }
    }


    // course overview
    public function overview($model, $slug)
    {

        $title = 'Course Overview';
        $course = Course::where('slug', $slug)->with('modules.lessons', 'user')->firstOrFail();
        $promo_video_link = '';
        if ($course->promo_video != '') {
            $ytarray = explode("/", $course->promo_video);
            $ytendstring = end($ytarray);
            $ytendarray = explode("?v=", $ytendstring);
            $ytendstring = end($ytendarray);
            $ytendarray = explode("&", $ytendstring);
            $ytcode = $ytendarray[0];
            $promo_video_link = $ytcode;
        }

        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();
        $courseEnrolledNumber = Checkout::where('course_id', $course->id)->count();

        $related_course = [];
        if ($course) {

            if ($course->categories) {
                $categoryArray = explode(',', $course->categories);

                $related_course = Course::where('instructor_id', $course->instructor_id)
                    ->where('status', 'published')
                    ->where('id', '!=', $course->id)
                    ->where(function ($query) use ($categoryArray) {
                        foreach ($categoryArray as $category) {
                            $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                        }
                    })
                    ->take(4)
                    ->get();
            }

            return view('e-learning/course/instructor/overview', compact('title', 'course', 'promo_video_link', 'course_reviews', 'related_course', 'courseEnrolledNumber'));
        } else {
            return redirect('instructor/dashboard')->with('error', 'Course not found!');
        }
    }

    public function storeCourseLog(Request $request)
    {

        $courseId = (int)$request->input('courseId');
        $lessonId = (int)$request->input('lessonId');
        $moduleId = (int)$request->input('moduleId');
        $userId = auth()->user()->id;

        $existingCourse = Course::find($courseId);
        $courseLog = CourseLog::where('course_id', $courseId)->where('user_id', $userId)->first();

        if (!$courseLog) {
            $courseLogInfo = new CourseLog([
                'course_id' => $courseId,
                'instructor_id' => $userId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
            $courseLogInfo->save();
            return response()->json([
                'message' => 'course log save successfully',
                'course_id' => $courseId,
                'instructor_id' => $userId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
        } else {
            $courseLog->course_id = $courseId;
            $courseLog->instructor_id = $userId;
            $courseLog->module_id = $moduleId;
            $courseLog->lesson_id = $lessonId;
            $courseLog->user_id = $userId;

            $courseLog->update();
            return response()->json([
                'message' => 'course log updated',
                'course_id' => $courseId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
        }
    }


    // course overview
    public function preview($model, $slug)
    {
        $title = 'Course Preview';
        $course = Course::where('slug', $slug)->with('modules.lessons', 'user')->firstOrFail();
        $promo_video_link = '';
        if ($course->promo_video != '') {
            $ytarray = explode("/", $course->promo_video);
            $ytendstring = end($ytarray);
            $ytendarray = explode("?v=", $ytendstring);
            $ytendstring = end($ytendarray);
            $ytendarray = explode("&", $ytendstring);
            $ytcode = $ytendarray[0];
            $promo_video_link = $ytcode;
        }

        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();
        $courseEnrolledNumber = Checkout::where('course_id', $course->id)->count();

        $related_course = [];
        if ($course) {
            if ($course->categories) {
                $categoryArray = explode(',', $course->categories);
                $query = Course::query();

                foreach ($categoryArray as $category) {
                    $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                }
                $related_course = $query->take(4)->get();
            }


            return view('e-learning/course/instructor/overview', compact('title', 'course', 'promo_video_link', 'course_reviews', 'related_course', 'courseEnrolledNumber'));
        } else {
            return redirect('instructor/dashboard')->with('error', 'Course not found!');
        }
    }


    // public function fileDownload($subdomain, $course_id, $file_extension)
    // {

    //     $lesson_files = Lesson::where('course_id', $course_id)->select('lesson_file as file')->get();
    //     foreach ($lesson_files as $lesson_file) {
    //         if (!empty($lesson_file->file)) {
    //             $file_name = $lesson_file->file;
    //             $file_arr = explode('.', $file_name);
    //             $extension = $file_arr['1'];
    //             if ($file_extension == $extension) {
    //                 $files[] = public_path($file_name);
    //             }
    //         }
    //     }

    //     $zip = new ZipArchive;
    //     $zipFileName = $file_extension . '_' . time() . '.zip';
    //     $is_have_file = '';
    //     if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
    //         foreach ($files as $file) {
    //             if (file_exists($file)) {
    //                 $zip->addFile($file, basename($file));
    //             } else {
    //                 $is_have_file = 'There are no files in your storage!!!!';
    //                 break;
    //             }
    //         }
    //         if (!empty($is_have_file)) {
    //             return redirect('admin/courses')->with('error', $is_have_file);
    //         }
    //         $zip->close();

    //         // Set appropriate headers for the download
    //         header('Content-Type: application/zip');
    //         header("Content-Disposition: attachment; filename=" . $zipFileName);
    //         header('Content-Length: ' . filesize($zipFileName));
    //         header("Pragma: no-cache");
    //         header("Expires: 0");
    //         readfile($zipFileName);

    //         // Delete the zip file after download
    //         unlink($zipFileName);
    //         exit;
    //     } else {
    //         // Handle the case when the zip file could not be created
    //         echo 'Failed to create the zip file.';
    //     }
    // }



    public function fileDownloads(Request $request, $subdomain)
    {
        if ($request->ajax()) {
            $lessonId = $request->input('lessonId');
            $lesson = Lesson::where('id', $lessonId)->first();
            if ($lesson && !empty($lesson->lesson_file)) {
                $file_path = public_path($lesson->lesson_file);

                if (File::exists($file_path)) {
                    $zipFileName = public_path('/uploads/lessons/files/lesson_' . $lessonId . '_file.zip');

                    $zip = new ZipArchive;

                    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
                        $zip->addFile($file_path, basename($file_path));
                        $zip->close();


                        $headers = [
                            'Content-Type' => 'application/zip',
                            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
                            'Content-Length' => filesize($zipFileName),
                            'Pragma' => 'no-cache',
                            'Expires' => '0',
                        ];

                        return response()->download($zipFileName);
                        // ->deleteFileAfterSend(true);
                    } else {
                        return 'Failed to create the ZIP file. Error: ' . $zip->getStatusString();
                    }
                }
            }
        }


    }

    public function showLessonExtension(Request $request, $subdomain)
    {
        if ($request->ajax()) {
            $lessonId = $request->input('lessonId');
            $lesson = Lesson::where('id', $lessonId)->first();
            if( $lesson ){
                $lessonFilePath = $lesson->lesson_file;
                $extension = pathinfo($lessonFilePath, PATHINFO_EXTENSION);
                return response()->json(['extension' => strtoupper($extension)]);
            }
        }

    }





    public function destroy($subdomain, $id)
    {


        // forot session
        if (session()->has('course_id')) {
            session()->forget('course_id');
        }

        // update bundle course for this course
        $selectedCourseValue = intval($id);
        $instructorId = Auth::user()->id;
        $bundleSelected = BundleCourse::where('instructor_id', $instructorId)
            ->where(function ($query) use ($selectedCourseValue) {
                $query->where('selected_course', 'LIKE', $selectedCourseValue . ',%')
                    ->orWhere('selected_course', 'LIKE', '%,' . $selectedCourseValue . ',%')
                    ->orWhere('selected_course', 'LIKE', '%,' . $selectedCourseValue);
            })
            ->get();
        foreach ($bundleSelected as $record) {
            $updatedSelectedCourse = str_replace($selectedCourseValue . ',', '', $record->selected_course);
            $updatedSelectedCourse = str_replace(',' . $selectedCourseValue, '', $updatedSelectedCourse);
            $updatedSelectedCourse = str_replace($selectedCourseValue, '', $updatedSelectedCourse);
            $record->selected_course = $updatedSelectedCourse;
            $record->save();
        }

        // delete bundleselected for this course
        $bundleSelection = BundleSelect::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($bundleSelection) {
            foreach ($bundleSelection as $bundleSelected) {
                $bundleSelected->delete();
            }
        }

        // update cart
        $cartSelects = Cart::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($cartSelects) {
            foreach ($cartSelects as $cartSelect) {
                $cartSelect->delete();
            }
        }

        // certificate delete
        $certificate = Certificate::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->first();
        if ($certificate) {
            $certificateOldLogo = public_path($certificate->logo);
            if (file_exists($certificateOldLogo)) {
                @unlink($certificateOldLogo);
            }

            $certificateOldSignature = public_path($certificate->signature);
            if (file_exists($certificateOldSignature)) {
                @unlink($certificateOldSignature);
            }
            $certificate->delete();
        }

        // checkout controller update
        $totalCheckout = Checkout::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($totalCheckout) {
            foreach ($totalCheckout as $checkout) {
                $checkout->status = 'deleted';
                $checkout->save();
            }
        }

        // course activities
        $totalActivity = CourseActivity::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($totalActivity) {
            foreach ($totalActivity as $activity) {
                $activity->delete();
            }
        }

        // course likes
        $course_likes = course_like::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($course_likes) {
            foreach ($course_likes as $course_liked) {
                $course_liked->delete();
            }
        }

        // course Log
        $course_logs = CourseLog::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($course_logs) {
            foreach ($course_logs as $course_log) {
                $course_log->delete();
            }
        }

        // course review
        $course_reviews = CourseReview::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($course_reviews) {
            foreach ($course_reviews as $course_review) {
                $course_review->delete();
            }
        }

        // course users
        $course_useres = DB::table('course_user')->where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($course_useres) {
            foreach ($course_useres as $course_usere) {
                DB::table('course_user')
                    ->where('id', $course_usere->id)
                    ->delete();
            }
        }

        // delete notification for this course
        $course_notifications = Notification::where(['course_id' => $selectedCourseValue, 'instructor_id' => $instructorId])->get();
        if ($course_notifications) {
            foreach ($course_notifications as $course_notification) {
                $course_notification->delete();
            }
        }

        // delete main course
        $course = Course::where(['id' => $selectedCourseValue, 'user_id' => $instructorId])->first();

        if ($course) {
            //delete thumbnail
            $oldThumbnail = public_path($course->thumbnail);
            if (file_exists($oldThumbnail)) {
                @unlink($oldThumbnail);
            }
            //delete certficate
            $oldCertificate = public_path($course->sample_certificates);
            if (file_exists($oldCertificate)) {
                @unlink($oldCertificate);
            }
            //delete modules
            $modules = Module::where('course_id', $course->id)->get();
            foreach ($modules as $module) {
                //delete lessons
                $lessons = Lesson::where('module_id', $module->id)->get();
                foreach ($lessons as $lesson) {
                    //delete lesson thumbnail
                    $lessonOldThumbnail = public_path($lesson->thumbnail);
                    if (file_exists($lessonOldThumbnail)) {
                        @unlink($lessonOldThumbnail);
                    }
                    //delete lesson file
                    $lessonOldFile = public_path($lesson->lesson_file);
                    if (file_exists($lessonOldFile)) {
                        @unlink($lessonOldFile);
                    }

                    $lesson->delete();
                }
                $module->delete();
            }
            $course->delete();
            return redirect('instructor/courses')->with('success', 'Course deleted Successfully!');
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        }
    }
}
