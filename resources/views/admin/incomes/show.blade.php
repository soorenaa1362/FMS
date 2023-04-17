@extends('admin.layouts.admin')

@section('title')
    show incomes
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">نمایش اطلاعات درآمد</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="title">عنوان</label>
                        <input class="form-control" value="{{ $income->title }}" id="title" disabled>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="amount">مبلغ</label>
                        <input class="form-control" value="{{ number_format($income->amount) }} تومان" id="amount" disabled>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="date">تاریخ و ساعت</label>
                        {{-- <input class="form-control" value="{{ verta($income->date) }}" id="date" disabled> --}}
                        <input class="form-control" value="{{ verta($income->date)->format('Y/m/d') }}" id="date" disabled>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="number">حساب</label>
                        <input class="form-control" value="{{ $card->name }} ( {{ $card->alias }} )" id="number" disabled>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description" disabled
                            name="description">{{ $income->description }}
                        </textarea>
                    </div>

                </div>

                <a href="{{ route('incomes.edit', [$income->id]) }}" class="btn btn-outline-primary mt-2">
                    ویرایش
                </a>
                <a href="{{ route('incomes.index') }}" class="btn btn-dark mt-2 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
