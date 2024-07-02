<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Course;

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id', 'is_fromSite', 'password', 'name', 'fName', 'mName', 'email', 'address', 'mobile', 'qualification', 'profession', 'guardianMobileNo', 'student_status', 'is_certificate', 'dateofbirth', 'gender', 'profile', 'department_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('name', 'like', "%{$value}%")
        ->orwhere('fName', 'like', "%{$value}%")
        ->orwhere('mName', 'like', "%{$value}%")
        ->orwhere('email', 'like', "%{$value}%")
        ->orwhere('student_id', 'like', "%{$value}%")
        ->orwhere('batch_id', 'like', "%{$value}%")
        ->orwhere('mobile', 'like', "%{$value}%");
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function pament_mode(): HasOne
    {
        return $this->hasOne(PaymentMode::class,'id','paymentType');
    }

    public function certificate_criteria(): HasOne
    {
        return $this->hasOne(CertificateCriterias::class,'student_id','id');
    }

    public function department(): HasOne
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function payments(): HasOne
    {
        return $this->hasOne(Payment::class,'student_id','id');
    }

    public function batch(): HasOne
    {
        return $this->hasOne(Batch::class,'id','batch_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
