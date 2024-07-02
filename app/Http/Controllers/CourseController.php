<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function course(){
        return view('application.course.course');
    }
    public function manageWebsiteCourse(){
        return view('application.course.manageWebsiteCourse');
    }
    public function myCourse() {
        $student = Student::findOrFail(Auth::guard('student')->user()->id);

        foreach ($student->courses as $course) {
            $classTaken = $course->attendance()->where('course_id', $course)->groupBy('date')->count();
        }

        return view('application.course.myStudentCourse', compact('student',));
    }
}
