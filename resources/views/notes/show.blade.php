@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        @if($note->is_pinned)
                            <i class="bi bi-pin-fill text-danger"></i>
                        @endif
                        {{ $note->title }}
                    </h4>
                    
                    <div class="btn-group" role="group">
                        <form action="{{ route('notes.toggle-pin', $note) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary" title="{{ $note->is_pinned ? 'Unpin' : 'Pin' }}">
                                <i class="bi bi-pin{{ $note->is_pinned ? '-fill' : '' }}"></i>
                            </button>
                        </form>
                        
                        <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($note->category)
                        <div class="mb-3">
                            <span class="badge category-badge" style="background-color: {{ $note->category->color }}">
                                <i class="bi bi-folder-fill"></i> {{ $note->category->name }}
                            </span>
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <small class="text-muted">
                            <i class="bi bi-calendar-plus"></i> Dibuat: {{ $note->created_at->format('d M Y, H:i') }}
                        </small>
                        @if($note->created_at != $note->updated_at)
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-calendar-check"></i> Diperbarui: {{ $note->updated_at->diffForHumans() }}
                            </small>
                        @endif
                    </div>
                    
                    <hr>
                    
                    <!-- Tampilkan HTML Content dari Quill -->
                    <div class="note-content-view ql-editor">
                        {!! $note->content !!}
                    </div>
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
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill text-danger"></i> Hapus Catatan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus catatan <strong>"{{ $note->title }}"</strong>?</p>
                <p class="text-danger mb-0">
                    <i class="bi bi-info-circle"></i> Tindakan ini tidak dapat dibatalkan!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash-fill"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .note-content-view {
        padding: 0;
        min-height: 200px;
    }
    
    .note-content-view img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 10px 0;
    }
    
    .note-content-view p {
        margin-bottom: 1rem;
        line-height: 1.8;
    }
    
    .note-content-view blockquote {
        border-left: 4px solid #667eea;
        padding-left: 1rem;
        margin: 1rem 0;
        font-style: italic;
        color: var(--text-secondary);
    }
    
    .note-content-view pre {
        background-color: var(--bg-tertiary);
        padding: 1rem;
        border-radius: 8px;
        overflow-x: auto;
    }
    
    .note-content-view code {
        background-color: var(--bg-tertiary);
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-family: 'Courier New', monospace;
    }
</style>
@endsection