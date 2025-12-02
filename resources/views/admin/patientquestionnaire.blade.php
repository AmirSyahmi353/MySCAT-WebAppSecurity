@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-semibold">Questionnaire for {{ $patient->name }}</h2>

    @if($questionnaire)
        <p><strong>Status:</strong> Completed</p>
        <p><strong>Score:</strong> {{ $questionnaire->score }}</p>

        <a href="{{ route('admin.patientshow', $patient->id) }}" class="btn btn-secondary mt-3">
            Back to Patient
        </a>
    @else
        <p>No questionnaire submitted yet.</p>
    @endif
</div>
@endsection
