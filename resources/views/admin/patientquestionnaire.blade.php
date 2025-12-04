@extends('layouts.admin')

@section('content')

<style>
    .question-box {
        background: #ffffff;
        padding: 18px 22px;
        border-radius: 10px;
        border-left: 5px solid #007bff;
        margin-bottom: 18px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .question-text {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 6px;
    }

    .answer-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        background: #007bff20;
        color: #007bff;
    }
</style>

<div class="container py-4">

    <h2 class="fw-bold mb-4">Questionnaire Result for {{ $patient->name }}</h2>

    @if(!$questionnaire)
        <div class="alert alert-warning">This patient has not completed the questionnaire yet.</div>
        <a href="{{ route('admin.patientshow', $patient->id) }}" class="btn btn-secondary">Back</a>
        @return
    @endif

    {{-- SUMMARY --}}
    <div class="mb-4">
        <p><strong>Total Score:</strong> {{ $questionnaire->totalScore }} / {{ $questionnaire->maxScore }}</p>
        <p><strong>Level:</strong>
            <span class="badge {{ $questionnaire->level === 'Normal' ? 'bg-success' : 'bg-danger' }}">
                {{ $questionnaire->level }}
            </span>
        </p>
    </div>

    @php
        $questions = [
            1 => 'Agar-agar/jelly/ pudding/ tau-foo fah',
            2 => 'Air batu campur (ABC)/ cendol/ laici kang',
            3 => 'Biscuits (creamed/ flavored) / Cookies',
            4 => 'Porridge (caca, corn, red beans)',
            5 => 'Bun (with filling/ topping)',
            6 => 'Cake / Muffin / Swiss roll / Brownies',
            7 => 'Candy / Sweets',
            8 => 'Banana dumpling',
            9 => 'Chocolate (usual / dark / white)',
            10 => 'Dodol / Wajik / Lempuk',
            11 => 'Donuts / Cinnamon rolls',
            12 => 'Fruit juices (bottle / can / carton)',
            13 => 'Dried fruits',
            14 => 'Ice-cream / popsicles',
            15 => 'Egg jam',
            16 => 'Fruit jam',
            17 => 'Traditional kuihs',
            18 => 'Traditional kuihs (with condiments)',
            19 => 'Dumpling (egg jam/redbean fillings)',
            20 => 'Lepat (banana, tapioca)',
            21 => 'Pancake / Waffle (with syrup)',
            22 => 'Pop corn (caramel)',
            23 => 'Soft drink (carbonated)',
            24 => 'Instant drink 3 in 1 / sachet',
            25 => 'Sweetened tea / iced tea',
            26 => 'Drinks with condensed milk',
            27 => 'Flavored milk',
            28 => 'Flavored cordial',
            29 => 'Canned fruits',
            30 => 'Energy bar'
        ];

        $scale = [1=>'A',2=>'B',3=>'C',4=>'D',5=>'E'];
    @endphp


    {{-- LIST OF QUESTIONS & ANSWERS --}}
    @foreach($questions as $num => $text)
        <div class="question-box">
            <div class="question-text">
                {{ $num }}. {{ $text }}
            </div>

            <div>
                @php
                    $val = $questionnaire->answers[$num] ?? null;
                @endphp

                <span class="answer-badge">
                    {{ $val ? $scale[$val] . " (Score: $val)" : '—' }}
                </span>
            </div>
        </div>
    @endforeach


    <a href="{{ route('admin.patientshow', $patient->id) }}" class="btn btn-secondary mt-4">
        Back to Patient
    </a>

</div>

@endsection
