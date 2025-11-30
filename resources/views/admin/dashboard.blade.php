@extends('layouts.admin')

@section('content')
 <!-- Menu -->
<div class="container-fluid py-4">

{{-- 🩺 Professional Welcome Header --}}
<div class="mb-4 pb-3 border-bottom">
    <div class="d-flex align-items-center">
        <div class="me-3">
            <i class="fas fa-user-md text-primary fs-2"></i>
        </div>

        <div>
            <h1 class="h4 text-dark fw-bold mb-1">
                Welcome to the Dietitian Dashboard, {{ Str::ucfirst(Auth::user()->name) ?? 'Dietitian' }}!
            </h1>

            <p class="text-muted mb-0">
                Supporting healthier habits, one patient at a time.
            </p>
        </div>
    </div>
</div>

  {{-- 📊 Summary Cards --}}
<div class="row g-4 mb-4">

    {{-- Total Patients --}}
    <div class="col-lg-4 col-md-6">
        <div class="stat-card border-blue d-flex justify-content-between align-items-center">
            <div>
                <div class="stat-title">Total Patients</div>
                <div class="stat-value">{{ $totalPatients ?? 0 }}</div>
            </div>
            <i class="fas fa-users stat-icon"></i>
        </div>
    </div>

    {{-- Normal Craving --}}
    <div class="col-lg-4 col-md-6">
        <div class="stat-card border-green d-flex justify-content-between align-items-center">
            <div>
                <div class="stat-title">Normal Craving</div>
                <div class="stat-value">{{ $normalCount ?? 0 }}</div>
            </div>
            <i class="fas fa-smile stat-icon"></i>
        </div>
    </div>

    {{-- High Craving --}}
    <div class="col-lg-4 col-md-6">
        <div class="stat-card border-yellow d-flex justify-content-between align-items-center">
            <div>
                <div class="stat-title">High Craving</div>
                <div class="stat-value">{{ $highCount ?? 0 }}</div>
            </div>
            <i class="fas fa-exclamation-triangle stat-icon"></i>
        </div>
    </div>

</div>

{{-- 📋 Recent Patients --}}
<div class="card shadow-sm border-0 rounded-4 p-4 mb-5">
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-user-clock text-primary fs-4 me-2"></i>
        <h5 class="fw-semibold text-secondary mb-0">Recent Patients</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr class="small text-uppercase text-muted">
                    <th>Name</th>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Total Score</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($recentPatients as $p)

                    <tr class="clickable-row"
                        data-href="{{ route('admin.patientshow', $p->_id) }}">

                        {{-- Patient Name + Gender Icon --}}
                        <td class="fw-semibold">
                            @php
                                $gender = $p->demographic->gender ?? null;
                            @endphp

                            @if($gender === 'Male')
                                <i class="fas fa-mars text-primary me-2"></i>
                            @elseif($gender === 'Female')
                                <i class="fas fa-venus text-danger me-2"></i>
                            @else
                                <i class="fas fa-user text-secondary me-2"></i>
                            @endif

                            {{ $p->demographic->full_name ?? $p->name }}
                        </td>

                        {{-- User ID --}}
                        <td>{{ $p->_id }}</td>

                        {{-- Email --}}
                        <td class="text-muted">{{ $p->email }}</td>

                        {{-- Score --}}
                        <td>
                            {{ $p->result->totalScore ?? '-' }}
                        </td>

                        {{-- Status --}}
                        <td>
                            @if (!$p->result)
                                <span class="text-secondary">No Assessment</span>
                            @elseif ($p->result->totalScore <= 45)
                                <span class="text-success">Normal</span>
                            @else
                                <span class="text-danger">High</span>
                            @endif
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">
                            No recent patient data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Clickable Row Script --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".clickable-row").forEach(row => {
        row.addEventListener("click", () => {
            const url = row.dataset.href;
            if (url) window.location.href = url;
        });
    });
});
</script>


{{-- ⚡ Quick Access --}}
<div class="row justify-content-center mb-5">
    <div class="col-lg-4 col-md-6 col-sm-10">
        <a href="{{ route('admin.patientindex') }}" class="quick-access-small d-flex align-items-center gap-3 text-white text-decoration-none">

            {{-- Icon --}}
            <i class="fas fa-list-ul fs-3"></i>

            {{-- Text --}}
            <div>
                <div class="fw-bold fs-5">Patient List</div>
                <p class="small mb-0 text-white-50">View and manage patient records.</p>
            </div>

        </a>
    </div>
</div>

{{-- CSS --}}
<style>
    /* Welcome Header */
    .border-bottom { border-color: #e3e6ea !important; }

    /* Summary Cards */
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 22px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-left: 4px solid #4e73df;
        transition: .25s ease;
    }
    .stat-title { font-size: .75rem; text-transform: uppercase; color: #6c757d; font-weight: 600; }
    .stat-value { font-size: 1.5rem; font-weight: 700; color: #4b4b4b; }
    .stat-icon { opacity: .18; font-size: 2.4rem; }

    .border-blue { border-left-color: #4e73df !important; }
    .border-green { border-left-color: #1cc88a !important; }
    .border-yellow { border-left-color: #f6c23e !important; }

    /* Recent Table */
    .clickable-row { cursor: pointer; }
    .clickable-row:hover { background-color: #eef3ff !important; }

    /* Quick Access Button */
    .quick-access-btn {
        display: block;
        padding: 22px;
        background: #0C1E42;
        border-radius: 14px;
        transition: .25s ease;
    }
    .quick-access-btn:hover {
        background: #1f3d77;
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    }
    .quick-access-small {
        background: #0C1E42;          /* Dark blue */
        padding: 18px 20px;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: 0.25s ease;
        min-height: 80px;             /* Much shorter */
    }

    .quick-access-small:hover {
        background: #1A4FA3;          /* Hover blue */
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.25);
    }

    .quick-access-small i {
        width: 40px;
        text-align: center;
        opacity: 0.9;
    }
    </style>

{{-- JS: Make Row Clickable --}}
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".clickable-row").forEach(row =>
            row.addEventListener("click", () => window.location.href = row.dataset.href)
        );
    });
    </script>

@endsection
