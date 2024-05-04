@extends('website.components.master')
@section('title', 'Master Barang')

@section('container')
    <div class="page-heading">
        <h3>Master Barang</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Data Products</h4>
                                <button class="btn btn-outline-primary rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#modalAdd">
                                    <i class="bi bi-plus-circle-fill"></i> Add Product
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category[0]->name }}</td>
                                                <td>{{ rupiah_format($item->price) }}</td>
                                                <td>{{ $item->quantity }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade text-left" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Product</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('master.product.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control mt-3"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="categoryID" id="category" class="form-select">
                                <option selected hidden>Choose Category...</option>
                                @foreach ($categories as $row)
                                    <option {{ old('categoryID') == $item->categoryID ? 'selected' : '' }}
                                        value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price">Price *</label>
                                    <input type="number" name="price" value="{{ old('price') }}"
                                        class="form-control mt-3" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity *</label>
                                    <input type="text" name="quantity" class="form-control mt-3" required>
                                </div>
                            </div>
                            <small class="text-muted mb-3">* (required)</small>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-secondary" style="margin-right: 5px;"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    @foreach ($data as $item)
        <div class="modal fade text-left" id="modalUpdate{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Update {{ $item->id }}</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('master.product.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="number" name="id" value="{{ $item->id }}" hidden>
                                <input type="text" name="name"
                                    value="{{ !empty(old('name')) ? old('name') : $item->name }}"
                                    class="form-control mt-3" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="categoryID" id="category" class="form-select">
                                    <option selected hidden>Choose Category...</option>
                                    @foreach ($categories as $row)
                                        <option
                                            {{ (old('categoryID') == $row->id ? 'selected' : $item->categoryID == $row->id) ? 'selected' : '' }}
                                            value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price *</label>
                                        <input type="number" name="price"
                                            value="{{ !empty(old('price')) ? old('price') : $item->price }}"
                                            class="form-control mt-3" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity *</label>
                                        <input type="text" name="quantity"
                                            value="{{ !empty(old('quantity')) ? old('quantity') : $item->quantity }}"
                                            class="form-control mt-3" required>
                                    </div>
                                </div>
                                <small class="text-muted mb-3">* (required)</small>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button type="button" class="btn btn-secondary" style="margin-right: 5px;"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                                </div>
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
                        <h4 class="modal-title" id="myModalLabel33">Delete {{ $item->name }}?</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('master.product.delete') }}" method="post" id="formEdit">
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
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" crossorigin href="{{ asset('assets/css/table-datatable-jquery.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
@endpush
