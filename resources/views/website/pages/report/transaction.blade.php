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
                                <h4>Transaction Data</h4>
                                <p>Total: Rp {{ number_format($total_price) }}</p>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Price per unit</th>
                                        <th>Total Price</th>
                                        <th>Platform</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name_customer . ' || ' . $item->acc_number . ' || ' . $item->area }}
                                                </td>
                                                <td>{{ $item->product[0]->name }}</td>
                                                <td>{{ $item->product[0]->category[0]->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ rupiah_format(round($item->product[0]->price)) }}</td>
                                                <td>{{ rupiah_format(round($item->total_price)) }}</td>
                                                <td>{{ $item->platform[0]->name }}</td>
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
                                    <input type="date" name="date" id="dateForm" class="form-control mt-1"
                                        value="{{ !empty($date_now) ? $date_now : '' }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="platform">Platforms</label>
                                    {{-- @dd($platform)); --}}
                                    <select id="platform" class="form-control mt-1">
                                        <option value="null" selected hidden>Choose...</option>
                                        @foreach ($platform_data as $item)
                                            <option
                                                {{ !empty($platform) ? ($platform != null ? ($platform == $item->name ? 'selected' : '') : '') : '' }}
                                                value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category">Categories</label>
                                    <select id="category" class="form-control mt-1">
                                        <option value="null" selected hidden>Choose...</option>
                                        @foreach ($category_data as $item)
                                            <option
                                                {{ !empty($category) ? ($category != null ? ($category == $item->name ? 'selected' : '') : '') : '' }}
                                                value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                                        @endforeach
                                    </select>

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
            let categoryValue = $('#category').val()
            let platformValue = $('#platform').val()



            let url = `/report/total-report/${dateValue}/${platformValue}/${categoryValue}`;
            // console.log(url)

            window.location.href = url;
        }
    </script>
@endpush
