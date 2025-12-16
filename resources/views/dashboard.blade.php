@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0 sidebar">
            <div class="p-3">
                <div class="d-grid gap-2 mb-4">
                    <a href="{{ route('notes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Catatan Baru
                    </a>
                </div>
                
                <h6 class="text-muted mb-3">KATEGORI</h6>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" 
                       class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i> Semua Catatan
                        <span class="badge bg-secondary float-end">{{ auth()->user()->notes->count() }}</span>
                    </a>
                    
                    @foreach($categories as $category)
                        <a href="{{ route('dashboard', ['category' => $category->id]) }}" 
                           class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                            <i class="bi bi-folder-fill" style="color: {{ $category->color }}"></i> 
                            {{ $category->name }}
                            <span class="badge bg-secondary float-end">{{ $category->notes->count() }}</span>
                        </a>
                    @endforeach
                    
                    <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action text-primary">
                        <i class="bi bi-plus"></i> Kelola Kategori
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        @if(request('category'))
                            {{ $categories->find(request('category'))->name }}
                        @else
                            Semua Catatan
                        @endif
                    </h2>
                </div>

                <!-- Search & Filter -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('dashboard') }}" method="GET" class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="search" 
                                           placeholder="Cari judul atau isi catatan..."
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="category">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="sort">
                                    <option value="">Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul A-Z</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-funnel"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Alert Messages -->
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

                <!-- Notes Grid -->
                @if($notes->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($notes as $note)
                            <div class="col">
                                <div class="card note-card h-100 position-relative" onclick="window.location='{{ route('notes.show', $note) }}'">
                                    @if($note->is_pinned)
                                        <span class="pinned-badge">
                                            <i class="bi bi-pin-fill text-danger"></i>
                                        </span>
                                    @endif
                                    
                                    <div class="card-body">
                                        <h5 class="card-title">{{ Str::limit($note->title, 50) }}</h5>
                                        
                                        @if($note->category)
                                            <span class="badge category-badge mb-2" 
                                                  style="background-color: {{ $note->category->color }}">
                                                {{ $note->category->name }}
                                            </span>
                                        @endif
                                        
                                        <p class="card-text text-muted note-content">
                                            {{ Str::limit(strip_tags($note->content), 100) }}
                                        </p>
                                    </div>
                                    
                                    <div class="card-footer bg-transparent border-top-0">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i> 
                                            {{ $note->created_at->diffForHumans() }}
                                        </small>
                                        
                                        <div class="btn-group btn-group-sm float-end" role="group" onclick="event.stopPropagation()">
                                            <form action="{{ route('notes.toggle-pin', $note) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-secondary" title="Pin">
                                                    <i class="bi bi-pin{{ $note->is_pinned ? '-fill' : '' }}"></i>
                                                </button>
                                            </form>
                                            
                                            <a href="{{ route('notes.edit', $note) }}" 
                                               class="btn btn-outline-secondary" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-outline-danger" 
                                                    onclick="deleteNote({{ $note->id }})"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $notes->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-journal-x" style="font-size: 4rem; color: #6c757d;"></i>
                        <h4 class="mt-3 text-muted">Belum ada catatan</h4>
                        <p class="text-muted">Mulai buat catatan pertama Anda!</p>
                        <a href="{{ route('notes.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Buat Catatan
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus catatan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
    function deleteNote(noteId) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/notes/${noteId}`;
        deleteModal.show();
    }
</script>
@endpush
@endsection