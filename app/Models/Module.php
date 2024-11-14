<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['id', 'course_id', 'title', 'description'];
    public function moduleContents()
    {
        // return $this->hasMany(ModuleContent::class, 'module_id');
        return $this->hasOne(ModuleContent::class, 'module_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
