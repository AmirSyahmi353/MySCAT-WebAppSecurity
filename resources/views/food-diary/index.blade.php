@extends('layouts.app')

@section('content')
<section class="fooddiary-summary d-flex align-items-center"
    style="background: url('{{ asset('assets/img/auth/mysca.png') }}') no-repeat center/cover;
        min-height: 100vh;
        padding: 60px 0;
    ">

<div class="container">

    <section class="p-4 rounded-4 shadow-sm"
        style="
            background-color: rgba(248, 250, 250, 0.95);
            border: 1px solid #E3ECEC;
        ">

        <h2 class="text-center mb-4 fw-bold" style="color:#2F5755;">
            My Food Diary Summary
        </h2>

        @if(!$diaries)
            <div class="alert text-center"
                 style="background-color:#E6F2F1; color:#2F5755; border:none;">
                No diary entries found.
            </div>
        @else

            @foreach($diaries->entries as $day => $meals)
                <div class="card mb-4 border-0">

                    <div class="card-header fw-semibold"
                         style="background-color:#E6F2F1; color:#2F5755;">
                        {{ strtoupper($day) }}
                    </div>

                    <div class="card-body p-3">

                        @if(count($meals) === 0)
                            <p class="text-muted mb-0">No meals logged.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead style="background-color:#F8FAFA;">
                                        <tr>
                                            <th>Meal</th>
                                            <th>Time</th>
                                            <th>Food</th>
                                            <th>Portion</th>
                                            <th>Drink</th>
                                            <th class="text-center">Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($meals as $meal)
                                            <tr>
                                                <td>{{ $meal['meal'] }}</td>
                                                <td>{{ $meal['time'] }}</td>
                                                <td>{{ $meal['food'] }}</td>
                                                <td>{{ $meal['portion'] }}</td>
                                                <td>{{ $meal['drink'] }}</td>
                                                <td class="text-center">
                                                    @if(!empty($meal['image']))
                                                        <img src="{{ asset($meal['image']) }}"
                                                             style="
                                                                width:70px;
                                                                height:70px;
                                                                object-fit:cover;
                                                                border-radius:10px;
                                                                border:1px solid #E3ECEC;
                                                             ">
                                                    @else
                                                        <span class="text-muted">–</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach

        @endif

    </section>

</div>
</section>
@endsection
