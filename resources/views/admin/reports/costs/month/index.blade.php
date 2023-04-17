@extends('admin.layouts.admin')

@section('title')
    index month costs
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-2 bg-white">
            <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">درآمد های ماه</h5>
                {{-- <div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('costs.add') }}">
                        <i class="fa fa-plus"></i>
                        افزودن مورد جدید
                    </a>
                </div> --}}
            </div>

            {{-- <h6>کل درآمد :‌ {{ number_format($costAmount) }} تومان</h6> --}}
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
                        @foreach ($monthCosts as $key => $cost)
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
                {{ $monthCosts->render() }}
            </div>
        </div> <!-- col-xl-12 -->

    </div> <!-- row -->
@endsection
