@extends('admin.layout.master')

@section('title', 'Input Data Barang ')

@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Barang </h3>
            </div>

          
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    
                    <div class="x_content">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        {{-- <form action="/admin/barang_/store" method="post">
                            @csrf --}}
                            <div class="form-group">
                                <label for="supplier_id">Barang:</label>
                                <select name="nama_barang" id="nama_barang" class="form-control" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($barang as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="col-12 d-flex justify-content-end">
                               
                                <a href="" onclick="this.href='/admin/cetak-barang-detail/'+ document.getElementById('nama_barang').options[document.getElementById('nama_barang').selectedIndex].text" 
    target="_blank" class="btn btn-primary me-1 mb-1">Cetak</a>
                            </div>
                            {{-- <button type="button" class="btn btn-primary" id="addRow">Tambah Baris</button>
                            <button type="submit" class="btn btn-success">Simpan Barang </button>
                            <a href="/admin/barang_" class="btn btn-danger" >Batal</a> --}}
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>











    
@endsection
