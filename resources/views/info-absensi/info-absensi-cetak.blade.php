<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <style type="text/css">
    body {
      font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
      margin: 20px;
    }
    /* Table */
    table {
      margin: auto;
      font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
      font-size: 12px;
      width: 100%;
    }
    .demo-table {
      border-collapse: collapse;
      font-size: 13px;
    }
    .demo-table th,
    .demo-table td {
      border-bottom: 1px solid #e1edff;
      border-left: 1px solid #e1edff;
      padding: 7px 15px;
    }
    .demo-table th,
    .demo-table td:last-child {
      border-right: 1px solid #e1edff;
      border-top: 1px solid #e1edff;
    }
    .demo-table td:first-child {
      border-top: 1px solid #e1edff;
    }
    .demo-table td:last-child{
      border-bottom: 1px solid #e1edff;
    }
    caption {
      caption-side: top;
      margin-bottom: 10px;
    }
    /* Table Header */
    .demo-table thead th {
      background-color: #508abb;
      color: #FFFFFF;
      border-color: #6ea1cc !important;
      text-transform: uppercase;
    }
    /* Table Body */
    .demo-table tbody td {
      color: #353535;
    }
    .demo-table tbody tr:nth-child(odd) td {
      background-color: #f4fbff;
    }
    .demo-table tbody tr:hover th,
    .demo-table tbody tr:hover td {
      background-color: #ffffa2;
      border-color: #ffff0f;
      transition: all .2s;
    }
  </style>
  <title>Absenku - Cetak</title>
</head>
<body>
  <!-- Kop Surat -->
  <div style="width: 100%; display: flex; align-items: center; margin-bottom: 15px; border-bottom: 2px solid black; padding-bottom: 10px;">
    <!-- Logo -->
    
    <!-- Nama dan alamat sekolah -->
    <div style="flex: 1; text-align: center; margin-left: 15px;">
      @if($guru != "")
      <h3 style="margin: 0; font-family: Arial, Helvetica, sans-serif;">Laporan Absensi {{$guru->nama_lengkap}}</h3>
      @else
      <h3 style="margin: 0; font-family: Arial, Helvetica, sans-serif;">Laporan Absensi</h3>
      @endif
      <h3 style="margin: 0; font-family: Arial, Helvetica, sans-serif;">{{ $namaSekolah->nama }}</h3>
      <p style="margin: 2px 0 0 0; font-size: 14px; font-family: Arial, Helvetica, sans-serif;">
        {{ $alamatSekolah->nama }}
      </p>
      <p style="margin: 2px 0 0 0; font-size: 14px; font-family: Arial, Helvetica, sans-serif;">
        Periode {{ date("d F Y", strtotime($tanggalAwal)) }} - {{ date("d F Y", strtotime($tanggalAkhir)) }}
      </p>
    </div>
  </div>
  <table class="demo-table responsive" >
      <thead>
        <tr>
          <th scope="col">Nama</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Pokok Pembahasan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $value)
          <tr>
            <th scope="row">{{ $value->staf->nama_lengkap }}</th>
            <th>{{ date("d F Y", strtotime($value->tanggal)) }}</th>
            <th>{{ $value->status_kehadiran}}</th>
            <th>{{ $value->pokok_pembahasan}}</th>
          </tr>
        @endforeach
      </tbody>
  </table>
</body>
</html>
