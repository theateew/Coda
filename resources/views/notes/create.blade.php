@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card fade-in">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="bi bi-journal-plus"></i> Buat Catatan Baru
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('notes.store') }}" method="POST" id="noteForm">
                        @csrf
                        
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
                                           value="{{ old('title') }}" 
                                           required 
                                           autofocus
                                           placeholder="Masukkan judul catatan...">
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
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                {!! old('content') !!}
                            </div>
                            
                            <!-- Hidden Input untuk Submit -->
                            <input type="hidden" name="content" id="content">
                            
                            @error('content')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Tips:</strong> Anda bisa menambahkan gambar dengan klik icon gambar di toolbar editor.
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Catatan
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

    // Update theme Quill saat toggle dark mode
    const savedTheme = localStorage.getItem('theme') || 'light';
    if (savedTheme === 'dark') {
        document.querySelector('.ql-toolbar').classList.add('dark-toolbar');
        document.querySelector('.ql-container').classList.add('dark-container');
    }
</script>
@endpush
@endsection