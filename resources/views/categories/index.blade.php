@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-folder"></i> Kelola Kategori
                    </h4>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Kategori
                    </a>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($categories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th>Nama Kategori</th>
                                        <th width="100" class="text-center">Warna</th>
                                        <th width="120" class="text-center">Jumlah Catatan</th>
                                        <th width="150" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $index => $category)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <i class="bi bi-folder-fill" style="color: {{ $category->color }}"></i>
                                                {{ $category->name }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge" style="background-color: {{ $category->color }}; width: 60px;">
                                                    {{ $category->color }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">{{ $category->notes_count }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('categories.edit', $category) }}" 
                                                       class="btn btn-outline-primary" 
                                                       title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-outline-danger" 
                                                            onclick="deleteCategory({{ $category->id }}, '{{ $category->name }}')"
                                                            title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-folder-x" style="font-size: 4rem; color: #6c757d;"></i>
                            <h5 class="mt-3 text-muted">Belum ada kategori</h5>
                            <p class="text-muted">Buat kategori untuk mengorganisir catatan Anda</p>
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Buat Kategori
                            </a>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer bg-transparent">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori "<strong id="categoryName"></strong>"?</p>
                <p class="text-danger mb-0">
                    <i class="bi bi-exclamation-triangle"></i> 
                    <small>Catatan yang menggunakan kategori ini akan menjadi tanpa kategori.</small>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function deleteCategory(categoryId, categoryName) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        document.getElementById('categoryName').textContent = categoryName;
        deleteForm.action = `/categories/${categoryId}`;
        deleteModal.show();
    }
</script>
@endpush
@endsection