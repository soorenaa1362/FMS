@extends('admin.layouts.admin')

@section('title')
    index cards
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-3 bg-white">
            <div class="d-flex flex-column flex-md-row text-center justify-content-md-between mb-4">
                <h5 class="mb-3 mb-md-0">لیست کارت ها</h5>
            </div>

            <div>
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام مستعار</th>
                            <th>موجودی</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $card)
                            <tr>
                                <th>
                                    <a href="{{ route('incomes.create', [$card->id]) }}">
                                        {{ $card->name }}
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('incomes.create', [$card->id]) }}">
                                        {{ $card->alias }}
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('incomes.create', [$card->id]) }}">
                                        {{ number_format($card->cash) }} تومان
                                    </a>
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
    </div>
@endsection
