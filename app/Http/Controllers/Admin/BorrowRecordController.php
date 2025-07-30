<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Borrowrecord;
use Illuminate\Http\Request;

class BorrowRecordController extends Controller
{
    // Hiển thị danh sách phiếu mượn
    public function index(Request $request)
    {
        $query = Borrowrecord::with(['user', 'book', 'approver'])->latest();

        // Lọc theo trạng thái nếu có
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $borrowRecords = $query->paginate(10);

        return view('admin.borrow_records.index', compact('borrowRecords'));
    }

    // Cập nhật trạng thái (vd: trả sách)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:borrowing,returned,late',
        ]);

        $record = Borrowrecord::findOrFail($id);
        $record->status = $request->status;

        // Nếu đánh dấu trả → set returned_at = now()
        if ($request->status === 'returned' && !$record->returned_at) {
            $record->returned_at = now();
        }

        $record->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }
}
