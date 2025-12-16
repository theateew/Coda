@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="bi bi-people"></i> Kelola User
                        <span class="badge bg-danger">Admin Only</span>
                    </h4>
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

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th width="100" class="text-center">Role</th>
                                    <th width="120" class="text-center">Jumlah Catatan</th>
                                    <th width="150" class="text-center">Terdaftar</th>
                                    <th width="100" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $users->firstItem() + $index }}</td>
                                        <td>
                                            <i class="bi bi-person-circle"></i>
                                            {{ $user->name }}
                                            @if($user->id === auth()->id())
                                                <span class="badge bg-primary">You</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            @if($user->role === 'admin')
                                                <span class="badge bg-danger">Admin</span>
                                            @else
                                                <span class="badge bg-secondary">User</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info">{{ $user->notes_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <small class="text-muted">{{ $user->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if($user->id !== auth()->id())
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')"
                                                        title="Hapus User">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $users->links() }}
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
                <h5 class="modal-title">Konfirmasi Hapus User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus user "<strong id="userName"></strong>"?</p>
                <p class="text-danger mb-0">
                    <i class="bi bi-exclamation-triangle"></i> 
                    <small>Semua catatan dan kategori milik user ini akan ikut terhapus!</small>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function deleteUser(userId, userName) {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteForm = document.getElementById('deleteForm');
        document.getElementById('userName').textContent = userName;
        deleteForm.action = `/admin/users/${userId}`;
        deleteModal.show();
    }
</script>
@endpush
@endsection