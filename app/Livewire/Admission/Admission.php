<?php

namespace App\Livewire\Admission;

use App\Jobs\SendAdmissionMail;
use App\Models\CertificateCriterias;
use App\Models\Course;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Student;
use App\Models\PaymentMode;
use Livewire\Component;
use App\Utils;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Admission extends Component
{
    use Utils;
    public $name, $fatherName, $motherName, $mobileNumber, $address, $email, $gMobile, $qualification, $profession, $courseId = null, $discount = null, $paymentType, $totalAmount, $totalPay = null, $totalDue, $paymentNumber, $admissionFee, $classday = [], $date, $courseFee, $gender , $paymentTypes = [], $department = [], $allClassDays = [];

    public function updated($discount) {
        $singleDepartment = Department::where('id', $this->courseId)->first(['fee']);
        $this->courseFee = $singleDepartment->fee ?? 0;
        $discountValue = $this->discount ?? 0;

        // Ensure both $courseFee and $discountValue are interpreted as numeric values
        $this->totalAmount = (float) $this->courseFee - (float) $discountValue;

        $totalAmount = $this->totalAmount ?? 0;
        $totalPay = $this->totalPay ?? 0;
        $this->totalDue = (float) $totalAmount - (float) $totalPay;
    }

    public function updatedCourseId() {
        $this->discount = null;
        $this->totalPay = null;
        $this->totalAmount = $this->courseFee;
        $this->totalDue = $this->courseFee;
    }

    public function mount() {
        $this->paymentTypes = PaymentMode::get();
        $this->department = Department::get();
        $this->allClassDays = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
    }

    public function render() {
        return view('livewire.admission.admission');
    }

    public function submit() {

         //user id and Password generate
         $user_id = $this->generateCode('Student', '202');
         $password = Str::random(8);
         $password_hash = Hash::make($password);

         //Multiful ClassDay Upload
         $previousClassday = $this->classday;
         if (is_array($this->classday)) {
             $this->classday = implode(',', $this->classday);
         } else {
             $this->classday = $previousClassday;
         }

        //validation
        $validated = $this->validate([
            'name' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'mobileNumber' => 'required|regex:/^(?:\+?88)?01[35-9]\d{8}$/',
            'address' => 'required',
            'email' => 'nullable|unique:students',
            'gMobile' => 'required|regex:/^(?:\+?88)?01[35-9]\d{8}$/',
            'paymentNumber' => 'nullable|regex:/^(?:\+?88)?01[35-9]\d{8}$/',
            'qualification' => 'required',
            'profession' => 'required',
            'courseId' => 'required',
            'paymentType' => 'required',
            'totalAmount' => 'required',
            'gender'   => 'required',
            'date' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $student = Student::create([
                'student_id' => $user_id,
                'name' => $this->name,
                'fName' => $this->fatherName,
                'mName' => $this->motherName,
                'email' => $this->email,
                'dateofbirth' => $this->date,
                'department_id' => $this->courseId,
                'password' => $password_hash,
                'address' => $this->address,
                'mobile' => $this->mobileNumber,
                'qualification' => $this->qualification,
                'profession' => $this->profession,
                'guardianMobileNo' => $this->gMobile,
                'gender' => $this->gender,
                'class_days' => $this->classday,
                'created_at' => Carbon::now(),
            ]);

            Payment::insert([
                'student_id' => $student->id,
                'paymentType' => $this->paymentType,
                'pay' => $this->totalPay,
                'due' => $this->totalDue,
                'total' => $this->totalAmount,
                'paymentNumber' => $this->paymentNumber,
                'admissionFee' => $this->admissionFee,
                'discount' => $this->discount,
                'created_at' => Carbon::now(),
            ]);

            $department = Department::findOrFail($this->courseId);
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
            $department = Department::where('id',$this->courseId)->first();

            //Mail Data
            $data = [
                'name'=> $this->name,
                'email'=> $this->email,
                'user_id'=> $user_id,
                'password'=> $password,
                'department_name' => $department->name,
            ];

            DB::commit();

            //SMS Message
            $message = "Congratulations $this->name! You've been admitted to the $department->name at Interior Bangladesh. Visit our website and Facebook page for info. Check your email and phone for login details. Contact 0199833324 for help.";


            dispatch(new SendAdmissionMail($data, $message, $this->mobileNumber));
            $this->reset();
            $this->mount();
            $this->dispatch('swal', [
                'title' => 'Data Instert Successfull',
                'type' => "success",
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('swal', [
                'title' => $e->getMessage(),
                'type' => "error",
            ]);
        }
    }
}
