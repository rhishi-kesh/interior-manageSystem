<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Utils;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendAdmissionMail;
use App\Models\CertificateCriterias;
use App\Models\Department;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    use Utils;
    public function admissionWeb(Request $request){

        //user id and Password generate
        $user_id = $this->generateCode('Student', '202');
        $password = Str::random(8);
        $password_hash = Hash::make($password);

        //image
        $fileName = "";
        if ($request->image) {
            $fileName = $request->image->store('profile', 'public');
        } else {
            $fileName = null;
        }

        //Course
        $course = Course::where('id', $request->course)->first();

        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'mobileNumber' => 'required|regex:/^(?:\+?88)?01[35-9]\d{8}$/',
            'address' => 'required',
            'email' => 'nullable|unique:students',
            'gMobile' => 'required|regex:/^(?:\+?88)?01[35-9]\d{8}$/',
            'qualification' => 'required',
            'profession' => 'required',
            'departmentID' => 'required',
            'gender'   => 'required',
            'date' => 'required',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }else{
            //insert
            DB::beginTransaction();
            try {
                $student = Student::create([
                    'student_id' => $user_id,
                    'is_fromSite' => 1,
                    'name' => $request->name,
                    'fName' => $request->fatherName,
                    'mName' => $request->motherName,
                    'email' => $request->email,
                    'dateofbirth' => $request->date,
                    'department_id' => $request->departmentID,
                    'password' => $password_hash,
                    'address' => $request->address,
                    'mobile' => $request->mobileNumber,
                    'qualification' => $request->qualification,
                    'profession' => $request->profession,
                    'guardianMobileNo' => $request->gMobile,
                    'gender' => $request->gender,
                    'profile' => $fileName,
                    'created_at' => Carbon::now(),
                ]);

                $department = Department::where('id', $request->departmentID)->first();

                Payment::insert([
                    'student_id' => $student->id,
                    'due' => $department->fee,
                    'total' => $department->fee,
                    'created_at' => Carbon::now(),
                ]);

                $department = Department::findOrFail($request->departmentID);
                foreach($department->courses as $course){
                    $course = Course::where('id', $course->id)->first();
                    $student->courses()->attach($course->id);

                    $certificate = CertificateCriterias::insert([
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'lecture' => $course->lecture,
                        'project' => $course->project,
                        'exam' => $course->exam,
                        'created_at' => Carbon::now(),
                    ]);
                }

                $data = [
                    'name'=> $request->name,
                    'email'=> $request->email,
                    'user_id'=> $user_id,
                    'password'=> $password,
                ];

                DB::commit();

                //SMS Message
                $message = "Rhishi Admission Form Website User ID: $user_id  Password: $password";

                dispatch(new SendAdmissionMail($data, $message, $request->mobileNumber));
                return response()->json(['status' => 1, 'msg' => 'Admission Successfully Done']);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 1, 'msg' => $e->getMessage()]);
            }
        }
    }

    public function courses() {
        $allCourses = Course::where('is_web', 0)->get();
        return $allCourses;
    }

    public function coursesIsfooter() {
        $allCourses = Course::where('is_web', 0)->where('is_footer', 0)->get();
        return $allCourses;
    }

    public function coursesTopSale() {
        $allCourses = Course::where('is_web', 0)->where('best_selling', 0)->get();
        return $allCourses;
    }

    public function webdepartment() {
        $allDepartments = Department::get();
        return $allDepartments;
    }

    public function singleDepartment($slug) {
        $department = Department::select('id','name')->where('slug',$slug)->first();

        $course = Course::where('is_web', 0)->where('department_id', $department->id)->get();

        return $course;
    }

    public function singleCourse($slug) {
        $course = Course::query()
                    ->with('department', 'courseLearnings', 'courseForThose', 'courseBenefits', 'creativeProject', 'courseModule', 'courseFaq')
                    ->where('slug',$slug)
                    ->where('is_web', '0')
                    ->latest()
                    ->first();
        return $course;
    }
}
