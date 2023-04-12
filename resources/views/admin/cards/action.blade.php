@extends('admin.layouts.admin')

@section('title')
    create cards
@endsection

@section('content')

    <div class="row">

        <!-- Action : Income -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-right-success shadow h-100 py-2">
                <div class="card-body">
                    <a href="{{ route('incomes.create', [$card->id]) }}" style="text-decoration: none;">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <h5 class="font-weight-bold text-success">
                                    درآمد
                                </h5>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Action : Cost -->
        @if ($card->cash > 0)
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        <a href="{{ route('costs.create', [$card->id]) }}" style="text-decoration: none;">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h5 class="font-weight-bold text-primary">
                                        خرجکرد
                                    </h5>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wallet fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-right-primary shadow h-100 py-2">
                    <div class="card-body">
                        {{-- <a href="{{ route('costs.create', [$card->id]) }}" style="text-decoration: none;"> --}}
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <h6 class="font-weight-bold text-primary">
                                        این کارت بانکی موجودی ندارد .
                                    </h6>
                                    <h6 class="font-weight-bold text-primary">
                                        لطفا بررسی نمایید .
                                    </h6>
                                </div>
                                <a href="{{ route('cards.show', [$card->id]) }}" class="btn btn-sm btn-success">
                                    جزییات حساب
                                </a>
                            </div>
                        {{-- </a> --}}
                    </div>
                </div>
            </div>
        @endif

    </div> <!-- Row -->

@endsection
