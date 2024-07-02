<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    const TABLE = 'departments';
    protected $table = self::TABLE;

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

}
