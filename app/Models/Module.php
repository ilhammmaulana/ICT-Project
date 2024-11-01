<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'course_id', 'title', 'description'];
    public function moduleContents()
    {
        return $this->hasMany(ModuleContent::class, 'module_id');
    }
}
