@extends('admin.layouts.admin')

@section('title')
    create incomes
@endsection

@section('script')
    <script>
        $('#date').MdPersianDateTimePicker({
            targetTextSelector: '#dateInput',
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });
    </script>
@endsection

@section('content')

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ثبت درآمد : {{ $card->name }}</h5>
                <h6 class="font-weight-bold">موجودی : {{ number_format($card->cash) }} تومان</h6>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('incomes.store', [$card->id]) }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="title">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label>تاریخ</label>
                        <div class="input-group">
                            <div class="input-group-prepend order-2">
                                <span class="input-group-text" id="date">
                                    <i class="fas fa-clock"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="dateInput"
                                name="date">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="amount">مبلغ</label>
                        <input type="text" name="amount" class="form-control">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ old('description') }}</textarea>
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-2" type="submit">ثبت</button>
                <a href="{{ route('cards.action', [$card->id]) }}" class="btn btn-dark mt-2 mr-3">بازگشت</a>
            </form>
        </div>

    </div> <!-- Row -->

@endsection
