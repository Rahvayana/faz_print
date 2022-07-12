@extends('layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sales</a></li>
              <li class="breadcrumb-item active">Sales Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Edit Sales</h5>
              </div>
              <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('sales.store') }}" method="POST">@csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nama_produk">Nama Barang</label>
                        <input type="text" class="form-control" value="{{$sale->nama_produk}}" name="nama_barang" id="nama_produk" placeholder="Nama Barang">
                      </div>
                      <div class="form-group">
                        <label for="Kategori">Kategori</label>
                        <input type="text" class="form-control" value="{{$sale->kategori}}" id="Kategori" name="kategori" placeholder="Kategori">
                      </div>
                      <div class="form-group">
                        <label for="Harga">Harga</label>
                        <input type="number" class="form-control" value="{{$sale->harga}}" id="Harga" name="harga" placeholder="Harga">
                      </div>
                      <div class="form-group">
                        <label for="nama_produk">Nama Barang</label>
                        <select name="status" id="status" class="form-control">
                            <option value="bisa dijual" {{$sale->status=='bisa dijual'?'selected':''}}>BISA DIJUAL</option>
                            <option value="tidak bisa dijual" {{$sale->status=='tidak bisa dijual'?'selected':''}}>TIDAK BISA DIJUAL</option>
                        </select>
                      </div>
                      
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection