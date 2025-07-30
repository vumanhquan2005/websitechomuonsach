<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Admin\Book;

class Borrowrecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'borrow_records';

    protected $fillable = [
        'borrow_code',
        'user_id',
        'approved_by',
        'approved_at',
        'book_id',
        'quantity',
        'borrowed_at',
        'due_date',
        'returned_at',
        'status',
        'notes',
    ];

    protected $dates = [
        'borrowed_at',
        'due_date',
        'returned_at',
        'approved_at',
        'deleted_at',
    ];

    // Người mượn
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Người duyệt
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Cuốn sách
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
