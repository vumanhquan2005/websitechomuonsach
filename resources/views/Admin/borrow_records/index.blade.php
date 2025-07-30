@extends('Layout.admin')

@section('title', 'Danh sách phiếu mượn sách')

@section('contents')
    <div class="container-fluid py-4">
        <h3 class="mb-4">Danh sách phiếu mượn sách</h3>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Mã phiếu</th>
                    <th>Người mượn</th>
                    <th>Sách</th>
                    <th>Số lượng</th>
                    <th>Ngày mượn</th>
                    <th>Hạn trả</th>
                    <th>Ngày trả</th>
                    <th>Trạng thái</th>
                    <th>Duyệt bởi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowRecords as $record)
                    <tr>
                        <td>{{ $record->borrow_code ?? '---' }}</td>
                        <td>{{ $record->user->name ?? '---' }}</td>
                        <td>{{ $record->book->title ?? '---' }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>{{ optional($record->borrowed_at)->format('d/m/Y') ?? '---' }}</td>
                        <td>{{ optional($record->due_date)->format('d/m/Y') ?? '---' }}</td>
                        <td>{{ optional($record->returned_at)->format('d/m/Y') ?? '---' }}</td>
                        <td>
                            @php
                                $badge = match ($record->status) {
                                    'pending' => 'secondary',
                                    'approved' => 'info',
                                    'borrowing' => 'warning',
                                    'returned' => 'success',
                                    'late' => 'danger',
                                    'cancelled' => 'dark',
                                    default => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">
                                {{ ucfirst($record->status) }}
                            </span>
                        </td>
                        <td>{{ $record->approver->name ?? '---' }}</td>
                        <td>
                            <form id="status-form-{{ $record->id }}"
                                action="{{ route('admin.borrow-records.update-status', $record->id) }}" method="POST"
                                class="status-form">
                                @csrf
                                <select name="status" class="form-select form-select-sm status-select"
                                    data-record-id="{{ $record->id }}" data-current-status="{{ $record->status }}">
                                    <option selected disabled>
                                        {{ match ($record->status) {
                                            'pending' => 'Chờ duyệt',
                                            'approved' => 'Đã duyệt',
                                            'borrowing' => 'Đang mượn',
                                            'returned' => 'Đã trả',
                                            'late' => 'Trễ hạn',
                                            'cancelled' => 'Đã hủy',
                                            default => ucfirst($record->status),
                                        } }}
                                    </option>

                                    @if ($record->status === 'pending')
                                        <option value="approved">Duyệt yêu cầu</option>
                                    @elseif ($record->status === 'approved')
                                        <option value="borrowing">Xác nhận đã nhận sách</option>
                                    @elseif ($record->status === 'borrowing')
                                        @if ($record->due_date && now()->greaterThan($record->due_date))
                                            <option value="late">Đánh dấu trễ hạn</option>
                                        @else
                                            <option value="returned">Xác nhận đã trả sách</option>
                                        @endif
                                    @elseif ($record->status === 'late')
                                        <option value="returned">Xác nhận đã trả sách</option>
                                    @endif
                                </select>
                            </form>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Không có phiếu mượn nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $borrowRecords->links() }}
        </div>
    </div>
@endsection
@section('js')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                const form = this.closest('form');
                const selectedStatus = this.value;
                const currentStatus = this.dataset.currentStatus;

                Swal.fire({
                    title: 'Xác nhận thay đổi trạng thái?',
                    text: `Bạn muốn chuyển từ "${currentStatus}" sang "${selectedStatus}"?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
