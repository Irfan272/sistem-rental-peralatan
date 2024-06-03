@extends('admin.layout.master')

@section('title', 'Input Data Alat')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Alat</h3>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">

                    <div class="x_content">
                        {{-- @foreach ($alat as $alat) --}}
                        <form enctype="multipart/form-data" action="/alat/update/{{ $alat->id }}" method="post" novalidate>
                            @csrf
                            @method('PATCH')
                            <span class="section">Input Data Alat</span>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="jenis_id">Jenis<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="jenis_id" id="jenis_id" class="form-control @error('jenis_id') parsley-error @enderror" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach($jenis as $k)
                                        <option value="{{ $k->id }}" {{ $alat->jenis_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_jenis }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_id')
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_alat">Merk <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input value="{{ $alat->merk }}" id="merk" name="merk" class="form-control @error('merk') parsley-error @enderror" type="text" />
                                    @error('merk')
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_alat">Type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input value="{{ $alat->type }}" id="type" name="type" class="form-control @error('type') parsley-error @enderror" type="text" />
                                    @error('type')
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="harga_perhari">Harga/Hari <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <input value="{{ $alat->harga_perhari }}" id="harga_perhari" name="harga_perhari" class="form-control @error('harga_perhari') parsley-error @enderror" type="text" />
                                    </div>
                                    @error('harga_perhari')
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="denda_perhari">Denda/Hari <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <input value="{{ $alat->denda_perhari }}" id="denda_perhari" name="denda_perhari" class="form-control @error('denda_perhari') parsley-error @enderror" type="text" />
                                    </div>
                                    @error('denda_perhari')
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="gambar_alat">Gambar Alat <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input value="{{ $alat->gambar_alat }}" id="gambar_alat" name="gambar_alat" class="form-control @error('gambar_alat') parsley-error @enderror" type="text" />
                                    @error('gambar_alat')
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="/admin/akun" class="btn btn-danger">Batal</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function removeNonNumeric(value) {
        return value.replace(/[^\d]/g, ''); // Menghapus semua karakter non-numerik
    }

    // Mengambil elemen input harga_rental_perhari berdasarkan ID
    var hargaInput = document.getElementById('harga_rental_perhari');

    // Event listener untuk menghapus simbol "Rp" saat pengguna memasukkan nilai
    hargaInput.addEventListener('input', function(e) {
        var value = hargaInput.value;
        hargaInput.value = removeNonNumeric(value);
    });

    // Event listener untuk menghapus simbol "Rp" saat input field kehilangan fokus
    hargaInput.addEventListener('blur', function(e) {
        var value = hargaInput.value;
        var numberValue = removeNonNumeric(value); // Menghapus semua karakter non-numerik
        hargaInput.value = numberValue;
    });
</script>

    
@endsection
