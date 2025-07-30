<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

protected $fillable = ['name', 'slug', 'images', 'parent_id'];
public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}

