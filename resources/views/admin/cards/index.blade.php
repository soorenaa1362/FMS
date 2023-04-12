@extends('admin.layouts.admin')

@section('title')
    index cards
@endsection

@section('content')

    <div class="row">

        @if (blank($cards))
            <div class="col-lg-12 mb-4">

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

            </div>
        @else
            <div class="col-xl-12 col-md-12 mb-4 p-3 bg-white">
                <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                    {{-- <h5 class="font-weight-bold mb-3 mb-md-0">لیست برند ها ({{ $brands->total() }})</h5> --}}
                    <h5 class="mb-3 mb-md-0">لیست کارت ها</h5>
                    {{-- <h6>کل موجودی : تومان</h6> --}}
                    <div>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('cards.create') }}">
                            <i class="fa fa-plus"></i>
                            ثبت اطلاعات کارت جدید
                        </a>
                    </div>
                </div>

                <div>
                    <table class="table table-bordered table-striped text-center">

                        <thead>
                            <tr>
                                <th>نام</th>
                                <th>نام مستعار</th>
                                <th>موجودی</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cards as $card)
                                <tr>
                                    <th>
                                        <a href="{{ route('cards.show', ['card' => $card->id]) }}">
                                            {{ $card->name }}
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('cards.show', ['card' => $card->id]) }}">
                                            {{ $card->alias }}
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('cards.show', ['card' => $card->id]) }}">
                                            {{ number_format($card->cash) }} تومان
                                        </a>
                                    </th>
                                    <th>
                                        <a class="btn btn-sm btn-success mr-3"
                                            href="{{ route('cards.action', [$card->id]) }}">ثبت تراکنش</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{-- {{ $brands->render() }} --}}
                </div>
            </div>
        @endif

    </div> <!-- Row -->
@endsection
