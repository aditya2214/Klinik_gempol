@extends('master')
@section('konten')
    <div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
            <h6 class="m-0 font-weight-bold text-primary">Data Pendaftaran Online</h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nik Karyawan</th>
                      <th>Nama Lengkap</th>
                      <th>Departemen</th>
                      <th>Email</th>
                      <th>No. Hp</th>
                      <th>Jam Periksa</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tfoot>
                  <tr>
                      <th>Nik Karyawan</th>
                      <th>Nama Lengkap</th>
                      <th>Departemen</th>
                      <th>Email</th>
                      <th>No. Hp</th>
                      <th>Jam Periksa</th>
                      <th>Tindakan</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($pendaftaran as $key => $row)
                        <tr data-toggle="popover" data-trigger="focus" title="Keluhan" data-content="{{$row->keluhan}}">
                            <td>{{$row->nik_karyawan}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->departemen}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->hp}}</td>
                            <td>{{$row->time_selected}}</td>
                            <td>
                                <a href ="{{route('rm.list', $row->id) }}" title="Buka RM" class="btn btn-circle btn-primary">
                                    <i class="fas fa-file"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
  <script type="text/javascript">
    $('[data-toggle="popover"]').popover({trigger :"hover",
    placement: function (context, source) {
        var position = $(source).position();

        if (position.left > 515) {
            return "left";
        }

        if (position.left < 515) {
            return "right";
        }

        if (position.top < 110){
            return "bottom";
        }

        return "top";
    }
  });
  </script>
@endsection