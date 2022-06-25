<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Nik : {{$data2->nik_karyawan}} 
                    Time : {{$time_booking}}
                </div>
                <div class="card-body text-center"style="margin:auto;" >
                    <p><b>Nomor antrian</b></p>
                    <b><p style="font-size:128px;">{{$nomor_antrian}}</p></b>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            
        </div>
    </div>
</div>
</body>
</html>