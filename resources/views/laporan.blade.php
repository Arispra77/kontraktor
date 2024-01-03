<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
</head>
<style>

</style>
<style>
    .container {
        padding-top: 40px;
    }

   

    .ab {
        padding-left: 30px;
    }

    .hr-full {
        border-top: 1px solid #000;
        margin: 0;
        padding: 0;
    }


</style>

    
<body>
    <div class="laporan" id="laporan" style="padding-bottom: 50px">
    <div class="hr-full" style="margin-top:50px"></div>
    <div class="hr-full" style="margin-top:3px"></div>

  
     
        <div class="ab">
            <h1>Laporan Penyelesaian Akhir</h1>
        </div>
        <div class="hr-full"></div>
        <div class="hr-full" style="margin-top:3px"></div>
        
        <!-- Informasi SubKontraktor, Vesed, dan Nos. SPK -->
        <table style="margin-left:30px">
            <tr>
                <td>-SubKontraktor</td>
                <td>: {{ old('nama_kary1', Auth::user()->nama_kary1) }}</td>
            </tr>
            <tr>
                <td>-Vesed</td>
                <td>: {{ $data->{'Nama Kapal'} }}</td>
            </tr>
            <tr>
                <td>-Nos. SPK</td>
                <td>: {{$data->NoSPK}}</td>
            </tr>
        </table>
        
        <div class="hr-full"></div>
        <div class="hr-full" style="margin-top:3px"></div>
        <!-- Tabel Kode WP, Realisasi, QTY, dan Satuan -->
        <div class="table-container" style="margin-left:50px">
            <div class="left-column">
                <table>
                  <thead>
                    <tr>
                        <th style="width: 80px">Kode WP</th>
                        <th style="padding-left:40px">Realisasi</th>
                        <th style="padding-left:300px;width:50px">QTY</th>
                        <th style="padding-left:20px">Satuan</th>
                      </tr>
                    </thead>
                    
                </table>
            </div>
           
        </div>

        <div class="hr-full"></div>
        <div class="hr-full" style="margin-top:3px"></div>

        <!-- Informasi Durasi -->
        <p style="padding-left: 55px;">{{ $data->Kode_WP }}
          @foreach($data->job()->get() as $po)
          (Durasi : {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $po->Tgl_Start)->format('Y/m/d') }}
          - 
          {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $po->Tgl_Finish)->format('Y/m/d') }} )
          @endforeach
        </p>
        @foreach($data->real()->get() as $pos)
        <table style="margin-left: 80px">
          <tbody>
            <tr>
              <td style="width: 80px">{{$pos->Kode}}</td>
              <td style="width: 360px;max-width:360px; word-wrap: break-word">{{$pos->realisasi_WP}} <p>{{$pos->tgl_update}}</p></td>
              <td style="padding-left:30px;width:10;max-width:10px;">{{$pos->volume_Task}}</td>
              <td style="padding-left:40px;width:10;max-width">{{$pos->Satuan}}</td>
            </tr>
          </tbody>
        </table>
        @endforeach
       
        <div class="hr-full"></div>
      
        <div class="hr-full" style="margin-top:5px"></div>
        <div class="hr-full" style="margin-top:3px"></div>
        <table>
          <thead>
              <tr>
                  <th style="width:50px">
                      <input type="checkbox" id="myCheckboxA" name="myCheckboxA" {{ $isCheckedA ? 'checked' : '' }}>
                  </th>
                  <th>
                      Validasi Bengkel MES
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td></td>
                  <td> {{ $data->Val_A_Date }}</td>
              </tr>
          </tbody>
      </table>
      
      <br>
      <table>
        <thead>
            <tr>
                <th style="width:50px">
                    <input type="checkbox" id="myCheckboxB" name="myCheckboxB" {{ $isCheckedB ? 'checked' : '' }}>
                </th>
                <th>
                    Validasi Mondal
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td> {{ $data->Val_B_Date }}</td>
            </tr>
        </tbody>
    </table>
    <br>
     
      
      <br>
      
      <table style="margin-bottom: 10px;">
          <thead>
              <tr>
                  <th style="width:50px">
                      <input type="checkbox" id="myCheckboxC" name="myCheckboxC" {{ $isCheckedC ? 'checked' : '' }}>
                  </th>
                  <th>
                      Validasi Pimpro
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td></td>
                  <td> {{ $data->Val_C_Date }}</td>
              </tr>
          </tbody>
      </table>
      
<br>
<div class="hr-full" style="margin-top:5px"></div>
<div class="hr-full" style="margin-top:3px"></div>
    </div>
    
   
    {{-- <div class="print-footer no-print">
         <div class="hr-full" style="margin-top:5px"></div>
    <div class="hr-full" style="margin-top:3px"></div>
        <script>
            var today = new Date();
            var formattedDate = today.toLocaleDateString('en-US');
            document.write('Printed on ' + formattedDate);
        </script>
    </div> --}}
</body>
</html>
