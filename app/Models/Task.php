<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=['project_id','details'];
    protected $casts=['details'=>'json'];
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
