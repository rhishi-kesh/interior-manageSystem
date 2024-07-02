<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;
use App\Models\Department;
use Carbon\Carbon;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EditCourse extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $description, $exam, $lecture, $project, $image, $oldimage, $update_id, $delete_id;
    protected $listeners = ['deleteConfirm' => 'deleteStudent'];

    public function mount($id)
    {
        $data = Course::where('id', $id)->first();
        $this->update_id = $data->id;
        $this->name = $data->name;
        $this->description = $data->description;
        $this->lecture = $data->lecture;
        $this->exam = $data->exam;
        $this->project = $data->project;
        $this->oldimage = $data->thumbnail;
    }
    public function render()
    {
        $courses = Course::paginate(10);

        return view('livewire.course.edit-course', compact('courses'));
    }
    public function update()
    {
        //slug Generate
        $searchName = Course::where('name', $this->name)->first('name');
        if($searchName){
            $slug = Str::slug($this->name) . rand();
        }else{
            $slug = Str::slug($this->name);
        }

        $validated = $this->validate([
            'name'  => 'required',
            'description' => 'required',
            'lecture'   => 'required|numeric',
            'project'   => 'nullable|numeric',
            'exam'   => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = "";
        $image_path = public_path('storage\\' . $this->oldimage);
        if (!empty($this->image)) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $fileName = $this->image->store('courses', 'public');
        } else {
            $fileName = $this->oldimage;
        }

        $done = Course::where('id', $this->update_id)->update([
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description,
            'lecture' => $this->lecture,
            'project' => $this->project,
            'exam' => $this->exam,
            'thumbnail' => $fileName,
            'updated_at' => Carbon::now()
        ]);
        if ($done) {
            $this->dispatch('swal', [
                'title' => 'Data Update Successfull',
                'type' => "success",
            ]);
            return redirect()->route('course');
        }
    }


}
