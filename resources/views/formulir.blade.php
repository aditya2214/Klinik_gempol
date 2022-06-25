@extends('master')
@section('konten')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir</h6>
        </div>
        <div class="card-body">
            <form action="{{route ('store_formulir') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik_karyawan" id="nik_karyawan" value="{{$users->nik_karyawan}}"  placeholder="Please Insert NIK Karyawan"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nik">Nama</label>
                            <input type="text" name="nama" id="nama" value="{{$users->nama}}"  placeholder="Please Insert NIK Karyawan"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="time">Waktu Permintaan</label>
                            <input type="datetime-local" name="time_booking" id="time_booking" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="time">Keluhan</label>
                            <textarea name="keluhan" id="keluhan" class="form-control" cols="30" rows="10">Ceritakan keluhan anda...</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button id="booking" class="btn btn-primary">Booking</button>
                </div>
            </form>
        </div>
    </div>
    
</script>
@endsection