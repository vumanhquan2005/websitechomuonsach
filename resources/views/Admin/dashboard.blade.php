@extends('Layout.admin')

@section('title', 'Thống kê hệ thống')

@section('contents')
    <div class="container-fluid py-4">
        <h4 class="mb-4 fw-bold">Thống Kê</h4>
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-2">
                <input type="text" class="form-control" placeholder="dd/mm/yyyy" />
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <input type="text" class="form-control" placeholder="dd/mm/yyyy" />
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <input type="text" class="form-control" placeholder="dd/mm/yyyy" />
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <button class="btn btn-success me-2 flex-grow-1">Lọc</button>
                <button class="btn btn-danger flex-grow-1">Reset</button>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-journal-bookmark-fill fs-1 text-success"></i>
                        </div>
                        <div class="fs-6 text-muted">Tổng số sách</div>
                        <div class="fs-2 fw-bold"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-people-fill fs-1 text-primary"></i>
                        </div>
                        <div class="fs-6 text-muted">Người dùng</div>
                        <div class="fs-2 fw-bold">{{ \App\Models\User::count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-calendar-check fs-1 text-warning"></i>
                        </div>
                        <div class="fs-6 text-muted">Lượt mượn</div>
                        <div class="fs-2 fw-bold"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="bi bi-person-plus-fill fs-1 text-info"></i>
                        </div>
                        <div class="fs-6 text-muted">Người đăng ký mới ({{ date('m/Y') }})</div>
                        <div class="fs-2 fw-bold">
                            {{ \App\Models\User::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thêm các phần bên dưới: Sách mượn nhiều nhất, top user... -->
    </div>
@endsection
