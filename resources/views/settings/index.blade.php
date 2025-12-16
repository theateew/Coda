@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="mb-4">
                <i class="bi bi-gear"></i> Pengaturan Akun
            </h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                <!-- Profile Settings -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-person"></i> Informasi Profil
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.settings.profile') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', auth()->user()->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', auth()->user()->email) }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <input type="text" 
                                           class="form-control" 
                                           value="{{ ucfirst(auth()->user()->role) }}" 
                                           disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Bergabung Sejak</label>
                                    <input type="text" 
                                           class="form-control" 
                                           value="{{ auth()->user()->created_at->format('d M Y') }}" 
                                           disabled>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-save"></i> Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Password Settings -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-shield-lock"></i> Ubah Password
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.settings.password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Saat Ini</label>
                                    <input type="password" 
                                           class="form-control @error('current_password') is-invalid @enderror" 
                                           id="current_password" 
                                           name="current_password" 
                                           required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Minimal 8 karakter</small>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirm Password Baru</label>
<input type="password" 
                                        class="form-control" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        required>
</div>
<button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-key"></i> Ubah Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Statistics -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-bar-chart"></i> Statistik Akun
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-journal-text" style="font-size: 3rem; color: #667eea;"></i>
                                    <h3 class="mt-2">{{ auth()->user()->notes->count() }}</h3>
                                    <p class="text-muted">Total Catatan</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-folder" style="font-size: 3rem; color: #764ba2;"></i>
                                    <h3 class="mt-2">{{ auth()->user()->categories->count() }}</h3>
                                    <p class="text-muted">Total Kategori</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-pin-angle" style="font-size: 3rem; color: #ef4444;"></i>
                                    <h3 class="mt-2">{{ auth()->user()->notes->where('is_pinned', true)->count() }}</h3>
                                    <p class="text-muted">Catatan Ter-pin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection