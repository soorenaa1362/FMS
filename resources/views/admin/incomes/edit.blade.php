@extends('admin.layouts.admin')

@section('title')
    show incomes
@endsection

@section('script')
    <script>

        $('#date').MdPersianDateTimePicker({
            targetTextSelector: '#dateInput',
            englishNumber: true,
            enableTimePicker: true,
            textFormat: 'yyyy-MM-dd HH:mm:ss',
        });

        $('#cardSelect').selectpicker({
            'title': 'انتخاب کارت بانکی'
        });

    </script>


@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش اطلاعات درآمد</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('incomes.update', [$income->id]) }}" method="POST">
                @csrf
                @method('put')

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="title">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text" value="{{ $income->title }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="amount">مبلغ</label>
                        <input type="text" name="amount" class="form-control" value="{{ $income->amount }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>تاریخ</label>
                        <div class="input-group">
                            <div class="input-group-prepend order-2">
                                <span class="input-group-text" id="date">
                                    <i class="fas fa-clock"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="dateInput"
                                name="date" value="{{ verta($income->date)->format('Y/m/d') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="number">حساب</label>
                        <select name="card_id" id="cardSelect" class="form-control" data-live-search="true">
                            @foreach ($cards as $card)
                                <option value="{{ $card->id }}" {{ $card->id == $income->card->id ? 'selected' : '' }}>
                                    {{ $card->name }} ({{ $card->alias }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                            name="description">{{ $income->description }}
                        </textarea>
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-2" type="submit">بروزرسانی</button>
                <a href="{{ route('incomes.index') }}" class="btn btn-dark mt-2 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
