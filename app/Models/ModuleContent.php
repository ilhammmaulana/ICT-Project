<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleContent extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'module_id', 'content_type', 'content'];
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
