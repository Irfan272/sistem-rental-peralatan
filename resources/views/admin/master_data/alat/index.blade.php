@extends('admin.layout.master')

@section('title', 'Data alat')

@section('content')
    
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="top_tiles">
            <h1>Data alat</h1>
          </div>

          {{-- @if(session('notifications'))
          <div class="alert alert-info">
              <ul>
                  @foreach(session('notifications') as $notification)
                      <li>{{ $notification }}</li>
                  @endforeach
              </ul>
          </div>
          @endif --}}
        
          <div class="col-md-12 col-sm-12 ">
              <a href="/alat/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data
                Alat</a>
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
                  <h2>Tabel Data <small>Alat</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="card-box table-responsive">
                            {{-- @if(count($alat) > 0) --}}
                  <table id="datatable" class="table table-striped table-bordered " style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th>Type</th>
                        <th>Harga/Hari</th>
                        <th>Status</th>
                        <th>Gambar</th>
                        <th style="width: 30%">Action</th>
                      </tr>
                    </thead>


                    <tbody>
                      @foreach ($alat as $b)

                        <tr >
                        <td >{{ $loop->iteration }}</td>
                        <td>{{ $b->Jenis->nama_jenis}}</td>
                        <td>{{ $b->merk}}</td>
                        <td>{{ $b->type}}</td>
                        <td>{{ $b->harga_perhari}}</td>
                        <td>{{ $b->status}}</td>
                        <td>{{ $b->gambar_alat}}</td>

                        <td style="text-align: left">
                          <a href="/alat/view/{{ $b->id }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> </a>
                          <a href="/alat/edit/{{ $b->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                          <form action="/alat/delete/{{$b->id}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </button>
                        </form>
                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  {{-- @else --}}
    {{-- <p>Tidak ada alat yang tersedia.</p> --}}
    {{-- @endif --}}
                </div>
                </div>
            </div>
          </div>

              </div>
            </div>
@endsection