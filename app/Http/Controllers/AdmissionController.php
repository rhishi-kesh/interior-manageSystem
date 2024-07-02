<?php

namespace App\Http\Controllers;

class AdmissionController extends Controller
{
    public function admission(){
        return view('application.admission.admission');
    }
    public function studentsList(){
        return view('application.admission.studentsList');
    }
    public function studentsEdit($id){
        return view('application.admission.studentsListEdit', compact('id'));
    }
    public function studentDownload(){
        return view('application.admission.studentDownload');
    }
}
