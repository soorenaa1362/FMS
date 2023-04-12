@extends('admin.layouts.admin')

@section('title')
    index costs
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">خرجکرد های این ماه کارت {{ $card->name }}</h5>
                <h6 class="font-weight-bold mb-3 mb-md-0">({{ $card->alias }})</h6>
                <h6 class="font-weight-bold">مجموع خرجکرد این ماه : {{ number_format($cash) }} تومان</h6>
                <a href="{{ route('cards.show', [$card->id]) }}" class="btn btn-sm btn-success">بازگشت</a>
            </div>
            <div>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>تاریخ</th>
                            <th>عنوان</th>
                            <th>مبلغ</th>
                            <th>حساب</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($costs as $key => $cost)
                            <tr>
                                <td>{{ verta($cost->date)->format('Y/m/d') }}</td>
                                <td>
                                    <a href="{{ route('costs.show', [$cost->id]) }}">
                                        {{ $cost->title }}
                                    </a>
                                </td>
                                <td>{{ number_format($cost->amount) }} تومان</td>
                                <td>{{ $cost->card->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{-- {{ $incomes->render() }} --}}
            </div>
        </div> <!-- col-xl-12 -->

    </div> <!-- row -->
@endsection
