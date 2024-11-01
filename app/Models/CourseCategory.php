<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['id', 'name'];
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_category_id');
    }
}
