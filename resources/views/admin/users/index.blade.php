@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Pengaturan Pengguna')

@section('content')
<div class="container-fluid px-0">

    {{-- Header & Stats --}}
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h4 class="fw-bold text-dark mb-1">Manajemen Pengguna</h4>
            <p class="text-muted small mb-0">Kelola hak akses dan pantau status verifikasi akun pengguna.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <button class="btn btn-primary rounded-3 fw-bold px-4 shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Admin
            </button>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom-0">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="fw-bold mb-0">Daftar Pengguna</h6>
                </div>
                <div class="col-auto">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-0" placeholder="Cari nama atau email...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fs-xs fw-bold text-secondary">Identitas Pengguna</th>
                            <th class="py-3 text-uppercase fs-xs fw-bold text-secondary text-center">Role</th>
                            <th class="py-3 text-uppercase fs-xs fw-bold text-secondary text-center">Verifikasi</th>
                            <th class="py-3 text-uppercase fs-xs fw-bold text-secondary text-center">Bergabung</th>
                            <th class="pe-4 py-3 text-uppercase fs-xs fw-bold text-secondary text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3 bg-soft-primary text-primary fw-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-0">{{ $user->name }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if(($user->role ?? 'user') == 'admin')
                                <span class="badge rounded-pill bg-dark px-3 py-2 fw-medium">
                                    <i class="bi bi-shield-lock me-1"></i> Admin
                                </span>
                                @else
                                <span class="badge rounded-pill bg-light text-dark border px-3 py-2 fw-medium">
                                    Customer
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($user->email_verified_at)
                                <span class="text-success small fw-bold">
                                    <i class="bi bi-patch-check-fill me-1"></i> Terverifikasi
                                </span>
                                @else
                                <span class="text-warning small fw-bold">
                                    <i class="bi bi-hourglass-split me-1"></i> Pending
                                </span>
                                @endif
                            </td>
                            <td class="text-center text-muted small">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm rounded-circle p-0"
                                        style="width: 32px; height: 32px;" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                        <li><a class="dropdown-item small py-2" href="#"><i
                                                    class="bi bi-pencil me-2"></i> Edit Profil</a></li>
                                        <li><a class="dropdown-item small py-2 text-primary" href="#"><i
                                                    class="bi bi-key me-2"></i> Reset Password</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item small py-2 text-danger" href="#"><i
                                                    class="bi bi-trash me-2"></i> Hapus User</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-people display-4 opacity-25 mb-3 d-block"></i>
                                Belum ada data pengguna yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-top-0 py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan {{ $users->count() }} pengguna</small>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .fs-xs {
        font-size: 0.7rem;
        letter-spacing: 0.05em;
    }

    .bg-soft-primary {
        background-color: #e7f1ff;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.9rem;
    }

    .table thead th {
        border-bottom: none;
    }

    .dropdown-item:active {
        background-color: var(--bs-primary);
    }

    /* Modern Pagination Styling */
    .pagination {
        margin-bottom: 0;
        gap: 5px;
    }

    .page-link {
        border: none;
        border-radius: 8px !important;
        color: #64748b;
        font-weight: 500;
    }

    .page-item.active .page-link {
        background-color: #0d6efd;
        box-shadow: 0 4px 6px -1px rgba(13, 110, 253, 0.3);
    }
</style>
@endsection