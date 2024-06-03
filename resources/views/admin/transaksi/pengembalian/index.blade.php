@extends('admin.layout.master')

@section('title', 'Data Pengembalian')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="top_tiles">
            <h1>Data Pengembalian</h1>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <h2>Tabel Data <small>Pengembalian</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Invoice</th>
                                            <th>Pelanggan</th>
                                            <th>Merk Alat</th>
                                            <th>Type Alat</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status Pengembalian</th>
                                            <th>Biaya Sewa</th>
                                            <th>Denda</th>
                                            <th>Total Pembayaran</th>
                                            <th style="width: 25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rental as $s)
                                        <tr class="rental-row">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$s->no_invoice}}</td>
                                            <td>{{ $s->Pelanggan->nama_pelanggan }}</td>
                                            <td>{{ $s->Alat->merk }}</td>
                                            <td>{{ $s->Alat->type }}</td>
                                            <td>{{ $s->tanggal_pengembalian }}</td>
                                            <td class="status-pengembalian">{{ $s->status_pengembalian }}</td>
                                            <td class="biaya-sewa">{{ $s->biaya_sewa }}</td>
                                            <td class="denda-perhari">{{ $s->denda_perhari }}</td>
                                            <td class="total-pembayaran">{{ $s->total_pembayaran }}</td>
                                            <td style="text-align: left">
                                                <a href="/pengembalian/view/{{ $s->id }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> </a>
                                                <a href="/pengembalian/edit/{{ $s->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                                <a href="/pengembalian/kwintansi/{{ $s->id }}" class="btn btn-info btn-xs"><i class="fa fa-print"></i> </a>
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

            <style>
                .status-pengembalian {
                    padding: 1px;
                    border-radius: 5px;
                }

                .status-terlambat {
                    background-color: red;
                    color: white;
                }

                .status-tepat-waktu {
                    background-color: blue;
                    color: white;
                }
            </style>

            <script>
                function formatRupiah(angka, prefix) {
                    var number_string = angka.toString().replace(/[^,\d]/g, ''),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
                }

                document.addEventListener("DOMContentLoaded", function() {
                    var biayaSewaElements = document.querySelectorAll('.biaya-sewa');
                    var dendaPerHariElements = document.querySelectorAll('.denda-perhari');
                    var totalPembayaranElements = document.querySelectorAll('.total-pembayaran');
                    var statusPengembalianElements = document.querySelectorAll('.status-pengembalian');

                    biayaSewaElements.forEach(function(element) {
                        element.textContent = formatRupiah(element.textContent, 'Rp');
                    });
                    dendaPerHariElements.forEach(function(element) {
                        element.textContent = formatRupiah(element.textContent, 'Rp');
                    });
                    totalPembayaranElements.forEach(function(element) {
                        element.textContent = formatRupiah(element.textContent, 'Rp');
                    });

                    statusPengembalianElements.forEach(function(element) {
                        var status = element.textContent.toLowerCase();
                        if (status.includes('terlambat')) {
                            element.classList.add('status-terlambat');
                        } else if (status.includes('tepat waktu')) {
                            element.classList.add('status-tepat-waktu');
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
@endsection
