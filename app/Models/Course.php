<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'slug', 'fee', 'description', 'duration', 'lecture', 'project', 'thumbnail', 'video', 'department_id', 'is_web', 'is_footer', 'best_selling'];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function courseLearnings()
    {
        return $this->hasMany(CourseLearnings::class);
    }

    public function courseForThose()
    {
        return $this->hasMany(CourseForThose::class);
    }

    public function courseBenefits()
    {
        return $this->hasMany(BenefitsOfCourse::class);
    }

    public function creativeProject()
    {
        return $this->hasMany(CreativeProject::class);
    }

    public function courseModule()
    {
        return $this->hasMany(CourseModule::class);
    }

    public function courseFaq()
    {
        return $this->hasMany(Course_FAQ::class);
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class,'course_id','id');
    }

    public function certificate_criteria(): HasOne
    {
        return $this->hasOne(CertificateCriterias::class,'course_id','id');
    }

}
