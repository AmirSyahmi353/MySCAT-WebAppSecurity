@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/main.css') }}">

<div class="container py-4">

    <h2 class="fw-semibold mb-3">Patient Profile</h2>
    <p class="text-muted mb-4">Demographic and assessment details of this patient.</p>

    <div class="demo-card shadow-lg p-5 rounded-4">

        {{-- DEMOGRAPHIC INFORMATION --}}
        <h4 class="mb-3">Demographic Information</h4>

        <!-- Full Name -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Full Name</label>
            <input type="text" class="form-control" value="{{ $demographic->full_name ?? ($patient->name ?? '-') }}" readonly>
        </div>

        <!-- Email + Occupation -->
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="text" class="form-control" value="{{ $demographic->email ?? ($patient->email ?? '-') }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Occupation</label>
                <input type="text" class="form-control" value="{{ $demographic->occupation ?? '-' }}" readonly>
            </div>
        </div>

        <!-- Age / Gender / Race -->
        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Age</label>
                <input type="text" class="form-control" value="{{ $demographic->age ?? '-' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Gender</label>
                <input type="text" class="form-control" value="{{ isset($demographic->gender) ? ucfirst($demographic->gender) : '-' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Race</label>
                <input type="text" class="form-control" value="{{ $demographic->race ?? '-' }}" readonly>
            </div>
        </div>

        <!-- Education / Postcode / Income -->
        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Education Level</label>
                <input type="text" class="form-control" value="{{ $demographic->education ?? '-' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Postcode</label>
                <input type="text" class="form-control" value="{{ $demographic->postcode ?? '-' }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Income</label>
                <input type="text" class="form-control" value="{{ $demographic->income ?? '-' }}" readonly>
            </div>
        </div>

        <!-- Height / Weight -->
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Height (cm)</label>
                <input type="text" class="form-control" value="{{ $demographic->height_cm ?? '-' }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Weight (kg)</label>
                <input type="text" class="form-control" value="{{ $demographic->weight_kg ?? '-' }}" readonly>
            </div>
        </div>

        {{-- BMI CALCULATION (safe) --}}
        @php
            $heightCm = isset($demographic->height_cm) ? (float)$demographic->height_cm : null;
            $weightKg = isset($demographic->weight_kg) ? (float)$demographic->weight_kg : null;
            if ($heightCm && $heightCm > 0 && $weightKg && $weightKg > 0) {
                $bmi = round($weightKg / pow($heightCm / 100, 2), 1);
            } else {
                $bmi = null;
            }

            if (is_null($bmi)) {
                $status = 'N/A';
                $color = '#6c757d';
            } else {
                if ($bmi < 18.5) { $status = 'Underweight'; $color = '#A8DADC'; }
                elseif ($bmi < 24.9) { $status = 'Normal'; $color = '#B7E4C7'; }
                elseif ($bmi < 29.9) { $status = 'Overweight'; $color = '#FFD6A5'; }
                else { $status = 'Obese'; $color = '#FFADAD'; }
            }

            // clamp for UI mapping (10..40)
            $bmi_for_ui = is_null($bmi) ? 10 : min(max($bmi, 10), 40);
            // percent 0..100 relative to 10..40
            $bmi_percent = (($bmi_for_ui - 10) / 30) * 100;
        @endphp


        <hr class="my-4">

        {{-- BMI METER --}}
        <h4 class="mb-3">BMI Analysis</h4>

        <div class="bmi-bar-container mb-3">
            <div class="bmi-meter-wrapper position-relative">
                <div class="bmi-bar d-flex">
                    <div class="bmi-segment underweight flex-fill text-center py-2">Underweight</div>
                    <div class="bmi-segment normal flex-fill text-center py-2">Normal</div>
                    <div class="bmi-segment overweight flex-fill text-center py-2">Overweight</div>
                    <div class="bmi-segment obese flex-fill text-center py-2">Obese</div>
                </div>

                <div class="bmi-meter-line"></div>

                <!-- needle -->
                <div id="bmi-needle" aria-hidden="true"></div>
            </div>

            <div class="bmi-value text-center mt-3">
                <strong style="color: {{ $color ?? '#6c757d' }}; font-size:1.5rem;">
                    BMI = {{ $bmi ?? '-' }}
                </strong><br>
                <span style="color: {{ $color ?? '#6c757d' }};">({{ $status }})</span>
            </div>

            <p class="text-center mt-2 text-muted small">Healthy range: 18.5 – 24.9 kg/m²</p>
        </div>

        {{-- Result section --}}
        <hr class="my-4">
        <h4 class="mb-3">MySCAT Result</h4>

        @if (!empty($result))
            <div class="alert {{ ($result->totalScore <= 45) ? 'alert-success' : 'alert-danger' }}">
                <strong>Score:</strong> {{ $result->totalScore }} / {{ $result->maxScore ?? 150 }}<br>
                <strong>Status:</strong> {{ $result->level }}
            </div>
        @else
            <p class="text-muted">No assessment has been completed yet.</p>
        @endif

        {{-- Back Button --}}
        <div class="text-center mt-4">
            <a href="{{ route('admin.patientindex') }}" class="btn btn-secondary">
                Back to Patients List
            </a>
        </div>

    </div>
</div>

{{-- Styles for BMI meter (inline for easy copy/paste) --}}
<style>
    .bmi-bar { height: 52px; border-radius: 8px; overflow: hidden; box-shadow: inset 0 1px 2px rgba(0,0,0,0.06); }
    .bmi-segment { font-weight:600; font-size:0.85rem; display:flex; align-items:center; justify-content:center; }
    .bmi-segment.underweight { background: linear-gradient(90deg,#d0eaf6,#c7e6f0); color:#063a6b; }
    .bmi-segment.normal { background: linear-gradient(90deg,#e6f5ea,#d7f0dd); color:#0b5e2b; }
    .bmi-segment.overweight { background: linear-gradient(90deg,#fff3db,#ffe6c4); color:#6b3f00; }
    .bmi-segment.obese { background: linear-gradient(90deg,#ffe6e6,#ffd6d6); color:#6b1414; }

    .bmi-meter-wrapper { position: relative; margin: 12px 0 0; }
    .bmi-meter-line { position:absolute; left:6px; right:6px; top:50%; height:2px; transform:translateY(-50%); background:rgba(0,0,0,0.08); z-index:1; border-radius:2px; }
    #bmi-needle {
        position:absolute;
        top:calc(50% - 14px);
        width:14px;
        height:28px;
        background: linear-gradient(180deg,#ffffff,#f0f0f0);
        border-radius:3px;
        box-shadow:0 2px 6px rgba(0,0,0,0.15);
        transform-origin: center bottom;
        z-index:3;
        left:0%;
        margin-left:-7px; /* center the 14px needle on the position */
        transition: left 900ms cubic-bezier(.2,.9,.2,1);
        border:1px solid rgba(0,0,0,0.06);
    }

    /* small responsive tweaks */
    @media (max-width: 480px) {
        .bmi-segment { font-size:0.7rem; padding:6px 0; }
        .bmi-bar { height:44px; }
        #bmi-needle { top: calc(50% - 13px); height:26px; width:12px; margin-left:-6px; }
    }
</style>

{{-- BMI needle movement script --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const bmi = {{ is_null($bmi) ? 'null' : $bmi }};
    const needle = document.getElementById("bmi-needle");

    if (!needle) return;

    // If bmi unknown, place at start (left)
    if (bmi === null) {
        needle.style.left = '0%';
        return;
    }

    // compute percent between 10 and 40 -> 0..100
    const clamped = Math.min(Math.max(bmi, 10), 40);
    const percent = ((clamped - 10) / 30) * 100;

    // left percent (use padding left/right offset 0 to simplify)
    needle.style.left = `calc(${percent}% )`;
});
</script>

@endsection
