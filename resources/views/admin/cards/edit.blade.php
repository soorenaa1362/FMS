@extends('admin.layouts.admin')

@section('title')
    edit cards
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش کارت : {{ $card->name }}</h5>
            </div>
            <hr>
            @include('admin.sections.errors')
            <form action="{{ route('cards.update' , ['card' => $card->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ $card->name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="alias">نام مستعار</label>
                        <input class="form-control" id="alias" name="alias" type="text" value="{{ $card->alias }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="number">شماره</label>
                        <input class="form-control" id="number" name="number" type="text" value="{{ $card->number }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="cash">موجودی</label>
                        <input class="form-control" id="cash" name="cash" type="text" value="{{ $card->cash }}">
                    </div>
                </div>

                @if (blank($incomes))
                    <button class="btn btn-outline-primary mt-2" type="submit">بروز رسانی</button>
                @else
                    <br>
                    <h5 class="text-danger">برای این حساب تراکنش هایی ثبت شده است . آیا از ویرایش این حساب اطمینان دارید ؟</h5>
                    <button class="btn btn-danger mt-2" type="submit">بروز رسانی</button>
                @endif
                <a href="{{ route('cards.index') }}" class="btn btn-dark mt-2 mr-3">بازگشت</a>
            </form>
        </div> <!-- col-xl-12 -->

    </div> <!-- row -->

@endsection
