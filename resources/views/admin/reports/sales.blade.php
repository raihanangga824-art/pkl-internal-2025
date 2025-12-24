@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-bold mb-0">📊 Laporan Penjualan</h1>
    </div>

    {{-- Filter (opsional, belum aktif logic) --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="from" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="to" class="form-control">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Laporan --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>No. Order</th>
                        <th>Pelanggan</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- DATA DUMMY (AMAN, TIDAK ERROR) --}}
                    <tr>
                        <td>1</td>
                        <td>ORD-20241224-ABC123</td>
                        <td>Administrator</td>
                        <td>
                            <span class="badge bg-success">Paid</span>
                        </td>
                        <td>Rp 1.500.000</td>
                        <td>24-12-2025</td>
                    </tr>

                    {{-- Kalau belum ada data --}}
                    
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada data penjualan
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection