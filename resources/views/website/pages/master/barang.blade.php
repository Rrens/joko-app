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
                            <div class="card-header">
                                <h4>Data Barang</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" class="form-control mt-3">
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="price">Harga</label>
                                                <input type="number" name="price" class="form-control mt-3">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="quantity">quantity</label>
                                                <input type="number" name="quantity" class="form-control mt-3">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2"
                                        style="float: right;">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
