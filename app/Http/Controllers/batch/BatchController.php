<?php

namespace App\Http\Controllers\batch;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
{
    public function batch(){
        return view('application.batch.batch');
    }
    public function myBatchMentor(){
        $batch = Batch::query()
                // ->with(['attendance', 'course:id,name', 'course.courseModule'])
                ->whereHas('mentors', function ($query) {
                    $query->where('mentor_id', Auth::guard('mentor')->user()->id);
                })
                ->latest()
                ->paginate();

        // dd($batch->attendance);
        return view('application.batch.myBatchMentor', compact('batch'));
    }
}
