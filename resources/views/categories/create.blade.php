@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="bi bi-folder-plus"></i> Buat Kategori Baru
                    </h4>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus
                                   placeholder="Contoh: Pekerjaan, Pribadi, Kuliah">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="color" class="form-label">Warna Kategori</label>
                            <div class="row g-2">
                                <div class="col-auto">
                                    <input type="color" 
                                           class="form-control form-control-color @error('color') is-invalid @enderror" 
                                           id="color" 
                                           name="color" 
                                           value="{{ old('color', '#3B82F6') }}" 
                                           title="Pilih warna">
                                </div>
                                <div class="col">
                                    <input type="text" 
                                           class="form-control" 
                                           id="colorHex" 
                                           value="{{ old('color', '#3B82F6') }}" 
                                           readonly>
                                </div>
                            </div>
                            @error('color')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Pilih warna yang akan mewakili kategori ini</small>
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Preview:</strong>
                            <br>
                            <span class="badge mt-2" id="preview" style="font-size: 1rem; padding: 0.5rem 1rem;">
                                <i class="bi bi-folder-fill"></i> <span id="previewName">Nama Kategori</span>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Kategori
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
    const nameInput = document.getElementById('name');
    const colorInput = document.getElementById('color');
    const colorHex = document.getElementById('colorHex');
    const preview = document.getElementById('preview');
    const previewName = document.getElementById('previewName');

    // Update preview saat mengetik nama
    nameInput.addEventListener('input', function() {
        previewName.textContent = this.value || 'Nama Kategori';
    });

    // Update preview dan hex saat memilih warna
    colorInput.addEventListener('input', function() {
        colorHex.value = this.value;
        preview.style.backgroundColor = this.value;
    });

    // Update warna saat input hex diubah
    colorHex.addEventListener('input', function() {
        if (/^#[0-9A-F]{6}$/i.test(this.value)) {
            colorInput.value = this.value;
            preview.style.backgroundColor = this.value;
        }
    });

    // Set initial preview
    preview.style.backgroundColor = colorInput.value;
</script>
@endpush
@endsection