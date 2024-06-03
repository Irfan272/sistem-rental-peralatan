@extends('admin.layout.master')

@section('title', 'Input Data Penyewaan')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Penyewaan</h3>
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

                        <form action="/rental/store" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="no_po">No Invoice</label>
                                <input type="text" value="{{$no_po}}" name="no_invoice" id="no_invoice" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="pelanggan_id">Pelanggan:</label>
                                <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($pelanggan as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_pelanggan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alat_id">Nama Alat:</label>
                                <select name="alat_id" id="alat_id" class="form-control" required>
                                    <option value="">Pilih Alat</option>
                                    @foreach($alat as $s)
                                        <option value="{{ $s->id }}" data-harga="{{ $s->harga_perhari }}">{{$s->Jenis->nama_jenis}} || {{ $s->merk }} || {{$s->type}} || {{ $s->harga_perhari }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sewa">Tanggal Sewa:</label>
                                <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Kembali:</label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lama_sewa">Lama Sewa</label>
                                <input type="text" value="" name="lama_sewa" id="lama_sewa" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="biaya_sewa">Biaya Sewa</label>
                                <input type="text" value="" name="biaya_sewa" id="biaya_sewa" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status_pembayaran">Status Pembayaran:</label>
                                <select name="status_pembayaran" id="status_pembayaran" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Bayar">Belum Bayar</option>
                                    <option value="Sudah Bayar">Sudah Bayar</option>
                                   
                                </select>
                            </div>                       
                            
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="/rental" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alatSelect = document.getElementById('alat_id');
        const tanggalSewaInput = document.getElementById('tanggal_sewa');
        const tanggalKembaliInput = document.getElementById('tanggal_kembali');
        const biayaSewaInput = document.getElementById('biaya_sewa');
        const lamaSewaInput = document.getElementById('lama_sewa');

        function calculateBiayaSewa() {
            const alatOption = alatSelect.options[alatSelect.selectedIndex];
            const hargaPerHari = alatOption.getAttribute('data-harga');
            const tanggalSewa = new Date(tanggalSewaInput.value);
            const tanggalKembali = new Date(tanggalKembaliInput.value);
            
            if (hargaPerHari && tanggalSewa && tanggalKembali && tanggalKembali >= tanggalSewa) {
                const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Termasuk hari sewa dan hari kembali
                const biayaSewa = diffDays * hargaPerHari;
                biayaSewaInput.value = biayaSewa;
            } else {
                biayaSewaInput.value = '';
            }
        }

        function calculateLamaSewa() {
            const tanggalSewa = new Date(tanggalSewaInput.value);
            const tanggalKembali = new Date(tanggalKembaliInput.value);
            
            if (tanggalSewa && tanggalKembali && tanggalKembali >= tanggalSewa) {
                const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Termasuk hari sewa dan hari kembali
                lamaSewaInput.value = diffDays + ' hari';
            } else {
                lamaSewaInput.value = '';
            }
        }

        alatSelect.addEventListener('change', () => {
            calculateBiayaSewa();
            calculateLamaSewa();
        });
        tanggalSewaInput.addEventListener('change', () => {
            calculateBiayaSewa();
            calculateLamaSewa();
        });
        tanggalKembaliInput.addEventListener('change', () => {
            calculateBiayaSewa();
            calculateLamaSewa();
        });
    });
</script>

@endsection
