@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card fade-in">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit Catatan
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('notes.update', $note) }}" method="POST" id="noteForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">
                                        <i class="bi bi-card-heading"></i> Judul Catatan
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $note->title) }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">
                                        <i class="bi bi-folder"></i> Kategori
                                    </label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                            id="category_id" 
                                            name="category_id">
                                        <option value="">Tanpa Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $note->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-text-paragraph"></i> Isi Catatan
                            </label>
                            
                            <!-- Quill Editor Container -->
                            <div id="editor" style="height: 400px;">
                                {!! old('content', $note->content) !!}
                            </div>
                            
                            <!-- Hidden Input untuk Submit -->
                            <input type="hidden" name="content" id="content">
                            
                            @error('content')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-lightbulb"></i>
                            <strong>Info:</strong> Catatan terakhir diubah pada {{ $note->updated_at->format('d M Y, H:i') }}
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Catatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize Quill Editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Tulis catatan Anda di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Submit form dengan content dari Quill
    document.getElementById('noteForm').onsubmit = function() {
        var content = document.querySelector('#content');
        content.value = quill.root.innerHTML;
        
        // Validasi content tidak kosong
        if (quill.getText().trim().length === 0) {
            alert('Isi catatan tidak boleh kosong!');
            return false;
        }
        
        return true;
    };
</script>
@endpush
@endsection