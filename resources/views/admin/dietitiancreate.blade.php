@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 fw-semibold">Register New Dietitian</h2>

    <div class="card shadow-sm rounded-4 p-4">

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- DUPLICATE EMAIL OR OTHER ERRORS --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>⚠️ Registration failed:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>  {{-- includes duplicate email error --}}
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.dietitians.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       required>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Address</label>
                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       required>

                {{-- Field-specific error message --}}
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            {{-- <div class="mb-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            {{-- Role --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="dietitian" {{ old('role') == 'dietitian' ? 'selected' : '' }}>Dietitian</option>
                </select>

                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4">Create</button>
                <a href="{{ route('admin.dietitianindex') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>

        </form>
    </div>

</div>

{{-- Auto-hide alert after 5 seconds --}}
<script>
    setTimeout(() => {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(a => {
            let bsAlert = new bootstrap.Alert(a);
            bsAlert.close();
        });
    }, 5000);
</script>

@endsection
