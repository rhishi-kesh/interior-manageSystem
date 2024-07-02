<?php

namespace App\Http\Controllers\Homework;

use App\Http\Controllers\Controller;
use App\Jobs\SendHomeworkAssignMail;
use App\Mail\assignHomeworkMail;
use App\Models\Batch;
use App\Models\Homework;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils;
use Illuminate\Support\Facades\Mail;

class HomeworkController extends Controller
{
    use Utils;
    public function homework() {
        $batch = Batch::select('id', 'name')
        ->whereHas('mentors', function ($query) {
            $query->where('mentor_id', Auth::guard('mentor')->user()->id);
        })
        ->withCount('students')
        ->with('students')
        ->latest()
        ->paginate(20);
        return view('application.homework.homework', compact('batch'));
    }

    public function homeworkAssign($id) {
        $students = Student::where('batch_id', $id)->get();
        $batchName = Batch::where('id', $id)->first('name');
        return view('application.homework.assignHomework', compact('students', 'batchName'));
    }

    public function homeworkAssignPost(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'priority' => 'required',
            'dueDate' => 'required',
            'text' => 'required',
            'person' => 'required',
        ]);


        foreach($request->person as $person){

            $user = Student::where('id', $person)->first();

            //Mail Data
            $data = [
                'name'=> $user->name,
                'email'=> $user->email,
                'mentorName'=> Auth::guard('mentor')->user()->name,
            ];

            // SMS Message
            $message = "Dear $user->name, Your mentor, " . Auth::guard('mentor')->user()->name . ", has assigned homework to you. Please log in to your panel to check the details and complete the homework by the deadline. Thank you.";

            $done = Homework::insert([
                'student_id' => $user->id,
                'mentor_id' => Auth::guard('mentor')->user()->id,
                'title' => $request->title,
                'priority' => $request->priority,
                'dueDate' => $request->dueDate,
                'text' => $request->text,
                'created_at' => Carbon::now()
            ]);

            if($done){
                dispatch(new SendHomeworkAssignMail($data, $message, $user));
            }

        }

        return back()->with('success','Homework Assaign Successful');
    }
    public function homeworkView() {
        return view('application.homework.homeworkView');
    }

    public function studentHomeworkView() {
        return view('application.homework.studentHomeworkView');
    }

    public function submitedHomework() {
        return view('application.homework.submitedHomework');
    }
}
