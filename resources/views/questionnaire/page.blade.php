@extends('layouts.app')

@section('content')

@php
    // 🔥 Move your question list HERE instead of controller
    $questions = [
        1 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Agar-agar/jelly/ pudding/ tau-foo fah'],
        2 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Air batu campur (ABC)/ cendol/ laici kang'],
        3 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Biscuits (creamed/ flavored) / Cookies'],
        4 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Porridge (e.g.: caca, corn, red beans)'],
        5 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Bun (with filling/ topping)'],
        6 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Cake/Muffin/ Swiss roll/ Brownies'],
        7 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Candy/Sweets'],
        8 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Banana dumpling'],
        9 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Chocolate (usual/ dark/ white)'],
        10 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Dodol/ Wajik/Lempuk'],
        11 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Donuts / Cinnamon rolls'],
        12 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Fruit juices (bottle/ can/ carton)'],
        13 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Dried fruits'],
        14 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Ice-cream/popsicles'],
        15 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Egg jam'],
        16 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Fruit jam'],
        17 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Traditional kuihs'],
        18 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Traditional kuihs (with condiments)'],
        19 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Dumpling (egg jam/redbean fillings)'],
        20 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => "Lepat (banana, tapioca)"],
        21 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Pancake/Waffle with syrup'],
        22 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Pop corn (caramel)'],
        23 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Soft drinks'],
        24 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Instant drinks (3-in-1 etc.)'],
        25 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Sweetened tea / iced tea'],
        26 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Drinks with condensed milk'],
        27 => ['image' => 'assets/img/questionnaire/q27.png', 'text' => 'Flavored milk (chocolate/strawberry)'],
        28 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Flavored cordial'],
        29 => ['image' => 'assets/img/questionnaire/q3.png', 'text' => 'Canned fruits'],
        30 => ['image' => 'assets/img/questionnaire/q30.png', 'text' => 'Energy bar'],
    ];

    $perPage = 5;
    $pageQuestions = array_slice($questions, ($page - 1) * $perPage, $perPage, true);
@endphp

<div class="questionnaire-wrapper">
    <div class="questionnaire-card">

        {{-- Progress bar --}}
        <p class="text-center fw-bold">Page {{ $page }} of {{ $totalPages }}</p>
        <div class="progress mb-4">
            <div class="progress-bar"
                style="width: {{ (($page - 1) / $totalPages) * 100 }}%">
                {{ round((($page - 1) / $totalPages) * 100) }}%
            </div>
        </div>

        <form action="{{ route('questionnaire.savePage', ['page' => $page]) }}" method="POST">
            @csrf

            @foreach($pageQuestions as $id => $q)
                <div class="mb-5 text-center">
                    <h2 class="question-text">
                        {{ ($page - 1) * 5 + $loop->iteration }}. {{ $q['text'] }}
                    </h2>

                    <img src="{{ asset($q['image']) }}" class="question-image">

                    <div class="rating-scale">
                        <span>Never</span>

                        @foreach(['A','B','C','D','E'] as $index => $letter)
                            <label>
                                <input type="radio" name="answers[{{ $id }}]" value="{{ $index + 1 }}" required>
                                <span>{{ $letter }}</span>
                            </label>
                        @endforeach

                        <span>Always</span>
                    </div>
                </div>
            @endforeach

            {{-- Navigation --}}
            <div class="d-flex {{ $page === 1 ? 'justify-content-end' : 'justify-content-between' }}">
                @if($page > 1)
                    <a href="{{ route('questionnaire.page', ['page' => $page - 1]) }}" class="btn btn-back">Back</a>
                @endif

                @if($page < $totalPages)
                    <button type="submit" class="btn btn-next">Next</button>
                @else
                    <button type="submit" class="btn btn-submit">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>

@endsection
