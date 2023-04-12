@extends('admin.layouts.admin')

@section('title')
    show cards
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-2 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">نمایش اطلاعات کارت</h5>
                <h6 class="font-weight-bold">موجودی اولیه : {{ number_format($card->first_cash) }} تومان</h6>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" value="{{ $card->name }}" id="name" disabled>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="alias">نام مستعار</label>
                        <input class="form-control" value="{{ $card->alias }}" id="alias" disabled>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="number">شماره کارت</label>
                        <input class="form-control" value="{{ $card->number }}" id="number" disabled>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="cash">موجودی</label>
                        <input class="form-control" value="{{ number_format($card->cash) }} تومان" id="cash" disabled>
                    </div>

                </div>

                <a href="{{ route('cards.edit', ['card' => $card->id]) }}" class="btn btn-outline-primary mt-2">
                    ویرایش
                </a>
                <a href="{{ route('cards.index') }}" class="btn btn-dark mt-2 mr-3">بازگشت</a>
            </form>
        </div> <!-- col-xl-12 -->

        @if ( blank($incomes) && (blank($costs)) )
            <h6 class="mr-4">هنوز هیچ تراکنشی برای این حساب ثبت نشده است !</h6>
        @else

            @if ( blank($incomes) )
                <h6 class="mr-4">هنوز هیچ درآمدی برای این حساب ثبت نشده است !</h6>
            @else
                {{-- Incomes List --}}
                <div class="col-xl-12 col-md-12 mb-4 p-2 bg-white">
                    <div class="mb-4 text-center text-md-right">
                        <h5 class="font-weight-bold">لیست درآمدها</h5>
                    </div>
                    <table class="table table-bordered table-striped text-center">

                        <thead>
                            <tr>
                                <th>تاریخ</th>
                                <th>عنوان</th>
                                <th>مبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $income)
                                <tr>
                                    <td>{{ verta($income->date)->format('Y/m/d') }}</td>
                                    <td>{{ $income->title }}</td>
                                    <td>{{ number_format($income->amount) }} تومان</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- col-xl-12 -->
            @endif

            @if ( blank($costs) )
                <h6 class="mr-4">هنوز هیچ خرجکردی برای این حساب ثبت نشده است !</h6>
            @else
                {{-- Costs List --}}
                <div class="col-xl-12 col-md-12 mb-4 p-2 bg-white">
                    <div class="mb-4 text-center text-md-right">
                        <h5 class="font-weight-bold">لیست خرجکردها</h5>
                    </div>
                    <table class="table table-bordered table-striped text-center">

                        <thead>
                            <tr>
                                <th>تاریخ</th>
                                <th>عنوان</th>
                                <th>مبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($costs as $cost)
                                <tr>
                                    <td>{{ verta($cost->date)->format('Y/m/d') }}</td>
                                    <td>{{ $cost->title }}</td>
                                    <td>{{ number_format($cost->amount) }} تومان</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- col-xl-12 -->
            @endif

        @endif

    </div> <!-- row -->

@endsection
