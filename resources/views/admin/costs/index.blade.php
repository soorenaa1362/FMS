@extends('admin.layouts.admin')

@section('title')
    index costs
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        @if (blank($cards))
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">راهنمای کار با اپلیکیشن</h6>
                </div>
                <div class="card-body">
                    <p>
                        برای کار با اپلیکیشن ابتدا باید اطلاعات کارت بانکی خود را در سیستم ثبت نمایید .
                    </p>
                    <a class="btn btn-primary" href="{{ route('cards.create') }}">
                        ثبت اطلاعات کارت بانکی
                    </a>
                </div>
            </div>
        @else
            <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
                <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                    <h5 class="font-weight-bold mb-3 mb-md-0">لیست خرجکرد ها</h5>
                    <div>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('costs.add') }}">
                            <i class="fa fa-plus"></i>
                            افزودن مورد جدید
                        </a>
                    </div>
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
                    {{-- {{ $brands->render() }} --}}
                </div>
            </div> <!-- col-xl-12 -->
        @endif
    </div> <!-- row -->
@endsection
