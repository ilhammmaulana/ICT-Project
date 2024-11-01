<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'course_id', 'user_id'];
    public function course()
    {
        return $this->belongsTo(Course::class, ' course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
