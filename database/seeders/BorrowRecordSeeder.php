<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Borrowrecord;
use App\Models\User;
use App\Models\Admin\Book;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BorrowRecordSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $books = Book::pluck('id')->toArray();

        if (empty($users) || empty($books)) {
            $this->command->warn('⚠️ Bạn cần có dữ liệu sẵn trong bảng users và books để chạy seeder này.');
            return;
        }

        for ($i = 1; $i <= 5; $i++) {
            $borrowedAt = Carbon::now()->subDays(rand(1, 10));
            $dueDate = (clone $borrowedAt)->addDays(7);

            Borrowrecord::create([
                'borrow_code' => 'BRW' . Str::upper(Str::random(6)),
                'user_id' => $users[array_rand($users)],
                'approved_by' => $users[0], // giả sử user đầu tiên là admin
                'approved_at' => Carbon::now()->subDays(rand(0, 2)),
                'book_id' => $books[array_rand($books)],
                'quantity' => rand(1, 2),
                'borrowed_at' => $borrowedAt,
                'due_date' => $dueDate,
                'returned_at' => rand(0, 1) ? Carbon::now()->subDays(rand(0, 2)) : null,
                'status' => collect(['borrowing', 'returned', 'late'])->random(),
                'notes' => rand(0, 1) ? 'Mượn cho nhóm học chung' : null,
            ]);
        }

        $this->command->info('✅ Đã tạo 5 phiếu mượn thành công.');
    }
}
