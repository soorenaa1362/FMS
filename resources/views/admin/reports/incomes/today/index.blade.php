@extends('admin.layouts.admin')

@section('title')
    index today incomes
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-2 bg-white">
            <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">درآمد های امروز</h5>
                {{-- <div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('incomes.add') }}">
                        <i class="fa fa-plus"></i>
                        افزودن مورد جدید
                    </a>
                </div> --}}
            </div>

            {{-- <h6>کل درآمد :‌ {{ number_format($incomeAmount) }} تومان</h6> --}}
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
                        @foreach ($todayIncomes as $key => $income)
                            <tr>
                                <td>{{ verta($income->date)->format('Y/m/d') }}</td>
                                <td>
                                    <a href="{{ route('incomes.show', [$income->id]) }}">
                                        {{ $income->title }}
                                    </a>
                                </td>
                                <td>{{ number_format($income->amount) }} تومان</td>
                                <td>{{ $income->card->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $todayIncomes->render() }}
            </div>
        </div> <!-- col-xl-12 -->

    </div> <!-- row -->
@endsection
