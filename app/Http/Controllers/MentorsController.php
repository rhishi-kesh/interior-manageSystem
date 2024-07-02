<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Homework;
use App\Models\Student;
use Illuminate\Http\Request;

class MentorsController extends Controller
{
    public function mentors()
    {
        return view('application.mentors.mentors');
    }
    public function MentorgenereateReporate($id) {

        $student = Student::where('id', $id)->first();

        $attendance = Attendance::query()
                    ->where('student_id', $id)
                    ->get();

        $attendanceReport = $attendance->groupBy('attendance')->map(function ($group) {
            return $group->count();
        });

        $homeworkReport = Homework::query()
                    ->selectRaw('status, COUNT(*) as count')
                    ->where('student_id', $id)
                    ->groupBy('status')
                    ->pluck('count', 'status');

        $totalAttendance = Attendance::query()
                        ->where('student_id', $id)->count();

        $totalHomework = Homework::query()
                        ->where('student_id', $id)->count();

        return view('application.admission.mentorStudentReport', compact('student', 'attendanceReport', 'homeworkReport', 'totalAttendance', 'totalHomework'));
    }
}
