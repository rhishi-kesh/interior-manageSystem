<?php

namespace App\Livewire\Admission;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MentorStudentList extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        $student = Student::query()
    ->with(['batch:id,name', 'courses'])
    ->search($this->search) // Assuming 'search' is a custom scope or method to filter students based on some criteria
    ->whereHas('batch', function ($query) {
        $query->whereHas('mentors', function ($q) {
            $q->where('mentor_id', Auth::guard('mentor')->user()->id);
        });
    })
    ->latest()
    ->paginate(50);
        return view('livewire.admission.mentor-student-list', compact('student'));
    }
}
