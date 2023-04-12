@extends('admin.layouts.admin')

@section('title')
    home
@endsection

@section('content')
    <div class="row">

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

    </div> <!-- Row -->
@endsection
