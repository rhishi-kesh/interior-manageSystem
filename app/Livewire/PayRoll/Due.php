<?php

namespace App\Livewire\PayRoll;

use App\Mail\DueMail;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Student;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Utils;
use Illuminate\Support\Facades\Mail;
class Due extends Component
{
    use WithPagination;
    use Utils;
    public $total, $pay, $due, $payment, $isUpdate, $studentMailId, $students, $totalAmount, $startDate, $endDate;

    protected $listeners = [
        'sendComfirm' => 'sendDueMail',
    ];

    // public function updated() {
    //     $npayment = $this->payment ?? 0;
    //     $student = Student::findOrFail($this->isUpdate);
    //     $npay = $student->pay ?? 0;
    //     $ndue = $student->due ?? 0;
    //     $this->pay = (float) $npay + (float) $npayment;
    //     $this->due = (float) $ndue - (float) $npayment;
    // }

    public function mount() {
        $this->students = Payment::query()
        ->where('due', '>', 0)
        ->latest()
        ->get();
    }
    public function render() {

        return view('livewire.pay-roll.due');
    }

    public function filter()
    {
        $validated = $this->validate([
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        $this->students = Payment::query()
        ->where('due', '>', 0)
        ->whereBetween('created_at', [$this->startDate, $this->endDate])
        ->latest()
        ->get();
    }

    public function ShowUpdateModel($id){
        $student = Payment::findOrFail($id);
        $this->total = $student->total;
        $this->pay = $student->pay;
        $this->due = $student->due;
        $this->isUpdate = $student->id;
    }

    public function addDue()
    {
        $validated = $this->validate([
            'total' => 'required|numeric',
            'pay' => 'required|numeric',
            'due' => 'required|numeric',
            'payment' => 'required|numeric',
        ]);
        $done = Payment::where('id', $this->isUpdate)->update([
            'pay' => $this->pay,
            'due' => $this->due,
            'updated_at' => Carbon::now(),
        ]);
        if($done){
            $this->reset();
            $this->dispatch('swal', [
                'title' => 'Data Update Successfull',
                'type' => "success",
            ]);
        }
    }

    public function sendmailConfirm($id) {
        $this->studentMailId = $id;
        $this->dispatch('sendDueMail');
    }

    public function sendDueMail() {
        $student = Student::where('id', $this->studentMailId)->first();
        //Mail Data
        $data = [
            'name'=> $student->name,
            'email'=> $student->email,
            'departmentName' => $student->department->name,
            'paidAmount' => $student->payments->pay ?? "Not Paid",
            'dueAmount' => $student->payments->due,
        ];

        $departmentName = $student->department->name;
        $paidAmount = $student->payments->pay ?? "Not Paid";
        $dueAmount = $student->payments->due;
        //SMS Message
        $message = "Dear $student->name, you have enrolled in the $departmentName course. Amount paid: $paidAmount. Outstanding balance: $dueAmount. Please settle the balance at your earliest convenience. Thank you.";

        $this->sendSMS($student->mobile, $message);
        Mail::to($student->email)->send(new DueMail($data));

        $this->dispatch('sentSuccessfull', [
            'title' => 'Mail Successfully Send',
            'type' => "success",
        ]);
    }
}
