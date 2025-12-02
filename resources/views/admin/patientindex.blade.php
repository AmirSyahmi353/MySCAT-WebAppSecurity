@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 fw-semibold">Patients</h1>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.patientindex') }}" class="row g-3 mb-4 align-items-center">
        <!-- Search -->
        <div class="col-auto">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name, email, or ID..."
                class="form-control"
            >
        </div>

        <!-- Status Filter -->
        <div class="col-auto">
            <select name="status" class="form-select">
                <option value="">Status</option>
                <option value="Normal" {{ request('status') == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="High" {{ request('status') == 'High' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.patientindex') }}" class="btn btn-link">Reset</a>
        </div>
    </form>

    {{-- Patients Table --}}
    <div class="card shadow-sm rounded-2 overflow-hidden">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                 <tr class="small text-uppercase text-muted">
                        <th>Name</th>
                        <th>ID</th>
                        <th>Email address</th>
                        <th>Score</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($patients as $p)
                        @php
                            $result = $p->result ?? null;
                        @endphp

                        <tr class="clickable-row"
                            data-href="{{ route('admin.patientshow', $p->_id) }}">

                            <td class="text-dark">
                                {{ ucfirst($p->name) }}
                            </td>

                            <td>{{ $p->_id }}</td>

                            <td class="text-muted">{{ $p->email }}</td>

                            <td class="fw-normal">
                                {{ $result->totalScore ?? '-' }}
                            </td>

                            <td class="fw-normal">
                                @if (!$result)
                                    <span class="text-secondary">No Assessment</span>
                                @elseif ($result->totalScore <= 45)
                                    <span class="text-success">Normal</span>
                                @else
                                    <span class="text-danger">High</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

{{-- TABLE & ROW CSS --}}
<style>
/* Alternate row colors */
.custom-table tbody tr:nth-child(odd) {
    background-color: #f8f9fb;
}
.custom-table tbody tr:nth-child(even) {
    background-color: #ffffff;
}

/* Hover effect */
.custom-table tbody tr:hover {
    background-color: #e9eef7 !important;
    transition: 0.2s ease;
}

/* Clickable row */
.clickable-row {
    cursor: pointer;
}

.custom-table th {
    background: #f1f3f7;
    text-transform: uppercase;
    font-size: 0.75rem;
    font-weight: 600;
    color: #6c757d;
}

.custom-table td {
    padding: 14px 16px;
    vertical-align: middle;
    font-size: 0.95rem;
}

.custom-table td.fw-normal {
    font-weight: 400 !important;
}
</style>

{{-- CLICKABLE ROW SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".clickable-row").forEach(row => {
        row.addEventListener("click", () => {
            const url = row.dataset.href;
            if (url && url !== "#") {
                window.location.href = url;
            }
        });
    });
});
</script>

@endsection
