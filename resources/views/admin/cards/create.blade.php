@extends('admin.layouts.admin')

@section('title')
    create cards
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ثبت اطلاعات کارت</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('cards.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="alias">نام مستعار</label>
                        <input class="form-control" id="alias" name="alias" type="text" value="{{ old('alias') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="number">شماره کارت</label>
                        <input class="form-control" id="number" name="number" type="number" value="{{ old('number') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="cash">موجودی</label>
                        <input class="form-control" id="cash" name="cash" type="number" value="{{ old('cash') }}">
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-2" type="submit">ثبت</button>
                <a href="{{ route('cards.index') }}" class="btn btn-dark mt-2 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
