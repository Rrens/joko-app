@extends('website.components.master')
@section('title', 'Master Barang')

@section('container')
    <div class="page-heading">
        <h3>Transaction Datas</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Transaction Data Per Platform</h4>
                                <p>Total: Rp {{ number_format($total_price) }}</p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <th>No</th>
                                        <th>Platform</th>
                                        <th>Total Price</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->platform[0]->name }}</td>
                                                <td>{{ rupiah_format(round($item->total_price)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Filter</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="dateForm">Date:</label>
                                    <input type="month" name="date" id="dateForm" class="form-control mt-1"
                                        value="{{ !empty($month_year) ? $month_year : '' }}">
                                </div>
                                <button type="button" style="margin-left: 10px; " class="btn btn-primary"
                                    onclick="filterDate()">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/css/table-datatable-jquery.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/choice.css') }}">
    <style>
        .transaction-active {
            color: rgb(129, 129, 136) !important;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>

    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/form-element-select.js') }}"></script>

    <script>
        function filterDate() {
            let dateValue = $('#dateForm').val();
            let monthValue = dateValue.split('-')[1];
            let yearValue = dateValue.split('-')[0];
            console.log(dateValue);

            let url = `/report/category/${monthValue}/${yearValue}`;

            window.location.href = url;
        }
    </script>
@endpush
