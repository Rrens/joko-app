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
                                <h4>Transaction Data Per Category</h4>
                                <p>Total: Rp {{ number_format($total_price) }}</p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <th>No</th>
                                        <th>Category</th>
                                        <th>Total Price</th>
                                        <th>Detail</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->product[0]->category[0]->name }}</td>
                                                <td>{{ rupiah_format(round($item->total_price)) }}</td>
                                                <td>
                                                    <button class="btn btn-outline-warning rounded-pill"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetail{{ $item->id }}">
                                                        <i class="bi bi-info"></i>
                                                    </button>
                                                </td>
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
                                        value="">
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

    @foreach ($data as $item)
        <div class="modal fade text-left" id="modalDetail{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Detail {{ $item->product[0]->name }}</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Customer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($name_customer->where('categoryID', $item->product[0]->categoryID) as $item)
                                        <tr>
                                            <td class="text-bold-500">
                                                {{ $item->name_customer . ' || ' . $item->acc_number . ' || ' . $item->area }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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

            let url = `/report/platform/${monthValue}/${yearValue}`;

            window.location.href = url;
        }
    </script>
@endpush
