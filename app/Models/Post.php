<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['category_id','title','slug','content','is_published','image'];
    //protected $casts=['is_published'=>'boolean'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tag(){
        return $this->belongsToMany(Tag::class);
    }
}
