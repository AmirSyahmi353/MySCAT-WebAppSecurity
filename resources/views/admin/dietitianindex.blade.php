@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold">Dietitian Management</h2>

        <a href="{{ route('admin.dietitians.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Dietitian
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dietitians as $d)
                        <tr>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->created_at->format('d M Y') }}</td>

                            <td>
                                <a href="{{ route('admin.dietitians.edit', $d->_id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form action="{{ route('admin.dietitians.destroy', $d->_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this dietitian?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr><td colspan="4" class="text-center text-muted">No dietitians found.</td></tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection
