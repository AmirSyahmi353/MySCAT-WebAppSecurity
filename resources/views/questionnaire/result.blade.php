@extends('layouts.app')

@section('content')
<section class="d-flex justify-content-center align-items-center"
         style="
            min-height: 80vh;
            background: url('{{ asset('assets/img/auth/mysca.png') }}') no-repeat center/cover;
         ">

    <section class="p-5 rounded-4 shadow-sm text-center"
             style="
                background-color: rgba(248, 250, 250, 0.95);
                max-width: 600px;
                width: 100%;
                border: 1px solid #E3ECEC;
             ">

        <h2 class="mb-4 fw-bold" style="color:#2F5755;">
            Your Craving Results
        </h2>

        <!-- Total Score -->
        <p class="fs-5 mb-2 text-muted">
            Total Score
        </p>
        <p class="fs-4 fw-semibold mb-4" style="color:#2F5755;">
            {{ $totalScore }} / {{ $maxScore }}
        </p>

        <!-- Craving Level -->
        <div class="py-3 px-4 mb-4 rounded-3 fw-semibold fs-5"
             style="background-color:#E6F2F1; color:#2F5755;">
            {{ $level }} Craving
        </div>

        <!-- Message -->
        <p class="fs-6 text-secondary mb-4">
            {{ $message }}
        </p>

        <!-- Actions -->
        <div class="d-flex justify-content-center gap-3 flex-wrap">

            <!-- Take Again -->
            <a href="{{ route('questionnaire.intro') }}"
               class="btn px-4 py-2"
               style="
                    border:1px solid #2F5755;
                    color:#2F5755;
                    background-color:transparent;
                    border-radius:10px;
               ">
                Take Again
            </a>

            <!-- View Food Diary -->
            <a href="{{ route('food-diary.view') }}"
               class="btn px-4 py-2"
               style="
                    background-color:#2F5755;
                    color:#fff;
                    border-radius:10px;
               ">
                View Food Diary Log
            </a>

        </div>

    </section>

</section>
@endsection
