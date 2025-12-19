@extends('layouts.admin')

@section('page-title', 'Daftar Kategori')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Daftar Kategori</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Jumlah Produk</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>{{ $category->products_count ?? $category->products->count() }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($categories->isEmpty())
    <p class="text-muted">Belum ada kategori tersedia.</p>
    @endif
</div>
@endsection