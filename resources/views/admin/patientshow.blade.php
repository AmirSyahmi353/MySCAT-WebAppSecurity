@extends('layouts.admin')

@section('title', 'Patient Details')

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.patientindex') }}" class="text-primary" style="text-decoration: none;">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Patients
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark m-0" style="text-transform: capitalize;">
            {{ $patient->name }}
        </h2>
        @php
            // Anything NOT 'Normal' becomes 'High'
            $level = $patient->level === 'Normal' ? 'Normal' : 'High';
        @endphp
        <span class="px-3 py-1 rounded-pill text-capitalize fw-semibold
            @if($level === 'Normal')
                text-success bg-success bg-opacity-10
            @else
                text-danger bg-danger bg-opacity-10
            @endif">
        {{ $level }}
        </span>

    </div>

    {{-- Patient Information --}}
    <div class="row mb-4 text-dark">
        <div class="col-md-6 mb-3">
            <p class="mb-1"><strong>ID:</strong> {{ $patient->_id }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $patient->email }}</p>
        </div>
        <div class="col-md-6 mb-3">
            <p class="mb-1"><strong>Score:</strong> {{ $patient->score ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Date Joined:</strong>
                {{ $patient->created_at?->format('d M Y') ?? '-' }}
            </p>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="row g-4">

        {{-- Profile --}}
        <div class="col-md-4">
            <a href="{{ route('admin.patientprofile', $patient->_id) }}"
               class="btn btn-primary w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                <i class="fa-solid fa-id-card fs-2 mb-2"></i>
                <span class="fw-semibold">Profile</span>
            </a>
        </div>

        {{-- Questionnaire --}}
        <div class="col-md-4">
            <a href="{{ route('admin.patientquestionnaire', $patient->id) }}"
               class="btn btn-primary w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                <i class="fa-solid fa-clipboard-list fs-2 mb-2"></i>
                <span class="fw-semibold">Questionnaire</span>
            </a>
        </div>

        {{-- Food Diary --}}
        <div class="col-md-4">
            <a href="{{ route('admin.patientfooddiary', $patient->id) }}"
               class="btn btn-primary w-100 py-4 rounded-4 shadow-sm d-flex flex-column align-items-center">
                <i class="fa-solid fa-utensils fs-2 mb-2"></i>
                <span class="fw-semibold">Food Diary</span>
            </a>
        </div>

    </div>

</div>

@endsection
