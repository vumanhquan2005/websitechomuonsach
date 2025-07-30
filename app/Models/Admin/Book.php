<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\Category;
use App\Models\User;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'publisher',
        'isbn',
        'language',
        'pages',
        'cover_image',
        'description',
        'category_id',
        'quantity',
        'available',
        'status',
        'published_year',
        'created_by',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
