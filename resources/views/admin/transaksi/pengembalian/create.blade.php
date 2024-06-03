@extends('admin.layout.master')

@section('title', 'Input Data Pengembalian')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Pengembalian</h3>
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

                        <form action="/pengembalian/store" method="post">
                            @csrf                
                            <div class="form-group">
                                <label for="rental_id">No PO:</label>
                                <select name="rental_id" id="rental_id" class="form-control" required>
                                    <option value="">Pilih NO PO</option>
                                    @foreach($rental as $s)
                                        <option value="{{ $s->id }}" data-tanggal-sewa="{{ $s->tanggal_sewa }}" data-tanggal-kembali="{{ $s->tanggal_kembali }}" data-biaya-sewa="{{ $s->biaya_sewa }}">{{ $s->no_po }}</option>
                                    @endforeach
                                </select>
                            </div>                           
                            <div class="form-group">
                                <label for="tanggal_pengembalian">Tanggal Pengembalian:</label>
                                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" required>
                            </div>   
                            <div class="form-group">
                                <label for="kondisi_alat">Kondisi Alat:</label>
                                <select name="kondisi_alat" id="kondisi_alat" class="form-control" required>
                                    <option value="">Pilih Kondisi Alat</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>                
                            <div class="form-group">
                                <label for="denda">Denda</label>
                                <input type="text" value="" name="denda" id="denda" class="form-control" readonly>
                            </div>                       
                            
                            <button type="submit" class="btn btn-success">Simpan Pengembalian</button>
                            <a href="/admin/barang_keluar" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const noPoSelect = document.getElementById('rental_id');
    const tanggalPengembalianInput = document.getElementById('tanggal_pengembalian');
    const dendaInput = document.getElementById('denda');
    
    function calculateDenda() {
        const selectedOption = noPoSelect.options[noPoSelect.selectedIndex];
        const tanggalKembali = new Date(selectedOption.getAttribute('data-tanggal-kembali'));
        const biayaSewa = parseFloat(selectedOption.getAttribute('data-biaya-sewa'));
        const tanggalPengembalian = new Date(tanggalPengembalianInput.value);

        if (tanggalPengembalian > tanggalKembali) {
            const diffTime = Math.abs(tanggalPengembalian - tanggalKembali);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const denda = ((biayaSewa * 0.10) * diffDays).toFixed(2);
            dendaInput.value = denda;
        } else {
            dendaInput.value = '0';
        }
    }

    noPoSelect.addEventListener('change', function() {
        // Populate date fields and calculate denda on No PO change
        calculateDenda();
    });

    tanggalPengembalianInput.addEventListener('change', function() {
        // Calculate denda on tanggal_pengembalian change
        calculateDenda();
    });
});
</script>

@endsection
