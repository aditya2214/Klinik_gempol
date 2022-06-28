@extends('master')
@section('konten')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<style>
  .dataTables_filter {
    text-align:right;
  }
</style>
<div class="row">

      <!-- Content Column -->
      <div class="col-lg-12 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-12">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Kunjungan terakhir</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
          <table class="table table-bordered table-striped table-sm" id="rm" width="100%" cellspacing="0">
            <thead>
                <th>No RM</th>
                <th>Tanggal Periksa</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Dept</th>
                <th>Diagnosis</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No RM</th>
                <th>Tanggal Periksa</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Dept</th>
                <th>Diagnosis</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach ($rms as $rm)
              <tr>
                <td>{{str_pad($rm->idpasien, 4, '0', STR_PAD_LEFT)  }}</td>
                <td>{{ format_date($rm->created_time) }}</td>
                <td>{{$rm->nik_karyawan}}</td>
                <td>{{$rm->nama}}</td>
                <td>{{$rm->departemen}}</td>
                <td>{{ $rm->diagnosis}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#rm').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
  
    </script>
@endsection