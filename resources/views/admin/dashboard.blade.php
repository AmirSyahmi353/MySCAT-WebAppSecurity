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
        {{-- @php
            $stats = [
                ['label' => 'Total Patients', 'value' => $totalPatients, 'icon' => 'fa-users', 'class' => 'border-blue'],
                ['label' => 'Normal', 'value' => $normalCount, 'icon' => 'fa-smile', 'class' => 'border-green'],
                ['label' => 'High Craving', 'value' => $highCount, 'icon' => 'fa-exclamation-triangle', 'class' => 'border-yellow'],
            ];
        @endphp --}}

        {{-- @foreach ($stats as $s)
        <div class="col-lg-4 col-md-6">
            <div class="stat-card {{ $s['class'] }} d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title">{{ $s['label'] }}</div>
                    <div class="stat-value">{{ $s['value'] }}</div>
                </div>
                <i class="fas {{ $s['icon'] }} stat-icon"></i>
            </div>
        </div>
        @endforeach --}}
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


@endsection
