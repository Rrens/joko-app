@extends('website.components.master')
@section('title', 'Master Barang')

@section('container')
    <div class="page-heading d-flex justify-content-between align-items-center">
        <div class="flex-start">
            <h3>Master Barang</h3>
        </div>
        <div class="flex-end">
            <a href="{{ route('transaction.index') }}"
                class="btn btn-default rounded-pill text-decoration-underline {{ $transaction_active == 'input' ? 'transaction-active' : '' }} ">Transaction</a>
            <a href="{{ route('transaction.data') }}"
                class="btn btn-default rounded-pill text-decoration-underline {{ $transaction_active == 'data' ? 'transaction-active' : '' }}">Data</a>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if ($transaction_active == 'data')
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Data Products</h4>
                                    <p>Agent: {{ auth()->user()->name }}</p>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Price per unit</th>
                                            <th>Total Price</th>
                                            <th>Platform</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->product[0]->name }}</td>
                                                    <td>{{ $item->product[0]->category[0]->name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ rupiah_format(round($item->product[0]->price)) }}</td>
                                                    <td>{{ rupiah_format(round($item->total_price)) }}</td>
                                                    <td>{{ $item->platform[0]->name }}</td>
                                                    <td>
                                                        <button class="btn btn-outline-warning rounded-pill"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalUpdate{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button class="btn btn-outline-danger rounded-pill"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDelete{{ $item->id }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="card-header">
                                    <h4>Input Transaction</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('transaction.store') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="name" class="mb-3">Product</label>
                                                    <select class="choices form-select" id="productID" name="productID">
                                                        <option selected hidden>Choose Products...</option>
                                                        @foreach ($products as $item)
                                                            <option {{ old('productID') == $item->id ? 'selected' : '' }}
                                                                value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="text" name="quantity" id="quantity"
                                                        value="{{ old('quantity') }}" class="form-control mt-3 pb-3">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name" class="mb-3">Platform</label>
                                                    <select class="choices form-select" name="platformID">
                                                        <option selected hidden>Choose Platforms...</option>
                                                        @foreach ($platforms as $item)
                                                            <option {{ old('platformID') == $item->id ? 'selected' : '' }}
                                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <p>Price Total: <span id="total_price">0</span></p>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if (!empty($data[0]))
        @foreach ($data as $item)
            <div class="modal fade text-left" id="modalUpdate{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Update {{ $item->product[0]->name }}</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('transaction.update') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="mb-3">Product</label>
                                            <select class="choices form-select" id="productID" name="productID">
                                                <option selected hidden>Choose Products...</option>
                                                @foreach ($products as $row)
                                                    <option
                                                        @if (old('productID') == $row->id) selected
                                                    @elseif ($row->id == $item->productID)
                                                    selected @endif
                                                        value="{{ $row->id }}">
                                                        {{ $row->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" name="id" value="{{ $item->id }}" hidden>
                                            <input type="text" name="quantity" id="quantity"
                                                value="{{ !empty(old('quantity')) ? old('quantity') : $item->quantity }}"
                                                class="form-control mt-3 pb-3">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name" class="mb-3">Platform</label>
                                            <select class="choices form-select" name="platformID">
                                                <option selected hidden>Choose Platforms...</option>
                                                @foreach ($platforms as $row)
                                                    <option
                                                        @if (old('platformID') == $row->id) selected
                                                    @elseif ($row->id == $item->platformID)
                                                    selected @endif
                                                        value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <p>Price Total: <span id="total_price">0</span></p>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @foreach ($data as $item)
            <div class="modal fade text-left" id="modalDelete{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Delete {{ $item->product[0]->name }}?</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="{{ route('transaction.delete') }}" method="post" id="formEdit">
                            @csrf
                            <input type="text" name="id" value="{{ $item->id }}" hidden>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Delete</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

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
        function formatRupiah(number) {
            let integer = Math.round(number);
            let reverse = integer.toString().split('').reverse().join('');
            let thousand = reverse.match(/\d{1,3}/g);
            thousand = thousand.join('.').split('').reverse().join('');
            return 'Rp. ' + thousand;
        }

        $('#quantity').on('change', function() {
            let productID = $('#productID').val()
            let quantity = $('#quantity').val();

            $.ajax({
                url: `/master/product/getPriceProduct/${productID}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let totalPrice = data * quantity;
                    console.log(data)
                    console.log(quantity)
                    $('#total_price').text(formatRupiah(totalPrice));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error:', textStatus, errorThrown);
                }
            });
        })
    </script>
@endpush
