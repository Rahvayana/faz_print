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
              <li class="breadcrumb-item active">Sales Index</li>
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
                <h5 class="m-0">List Sales</h5>
              </div>
              <div class="card-body">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$sale->nama_produk}}</td>
                          <td>{{$sale->kategori}}</td>
                          <td>Rp. {{number_format($sale->harga)}}</td>
                          <td>
                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-xs btn-primary">Edit</a>
                            <button type="button" data-record-id="{{$sale->id}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-xs btn-danger">Delete</button>
                          </td>
                        </tr> 
                        @endforeach
                    </tbody>
                  </table>
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
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Hapus Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-ok">Delete</button>
            </div>
        </div>
    </div>
  </div>
@endsection
@section('script')
<script>
  $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      
      $.post('/delete-sale/' + id).then()
      setTimeout(function() {
          location.reload();            
      })
  });
  $('#confirm-delete').on('show.bs.modal', function(e) {
      var data = $(e.relatedTarget).data();
      $('.btn-ok', this).data('recordId', data.recordId);
  });
  </script>
@endsection