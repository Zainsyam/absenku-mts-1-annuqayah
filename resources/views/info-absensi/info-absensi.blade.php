@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <!-- Left side columns -->
  <div class="col-lg-8">
    <div class="row">
      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Informasi Absensi<span></span></h5>
            <form id="cetak-form" method="POST" action="{{  route('info-absensi-cetak') }}" target="_blank">
            @csrf
              <input type="hidden" class="form-control" name="tanggalAwal" id="tanggalAwalCetak">
              <input type="hidden" class="form-control" name="tanggalAkhir" id="tanggalAkhirCetak">
              <input type="hidden" class="form-control" name="idguru" id="idguruCetak">
              <a type="button" class="btn btn-primary" href="#" onclick="cetakData('absensi/filter', 'Absensi')">Cetak</a>
            <form>
            <br/>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama Guru</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col"><center>Opsi</center></th>
                </tr>
              </thead>
              <tbody id="table-data">
                @include('info-absensi.panel-detil')
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- End Recent Sales -->
    </div>
  </div><!-- End Left side columns -->

  <!-- Right side columns -->
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Filter Data<span></span></h5>
        <div class="row mb-3">
            <label for="inputText" class="col-sm-12 col-form-label">Tanggal Awal</label>
            <div class="col-sm-12">
              <input type="date" class="form-control" name="tanggalAwal" id="tanggalAwal">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputText" class="col-sm-12 col-form-label">Tanggal Akhir</label>
            <div class="col-sm-12">
              <input type="date" class="form-control" name="tanggalAkhir" id="tanggalAkhir">
            </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Guru</label>
          <div class="col-sm-12">
            <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="idguru" id="idguru">
              <option value="">Pilih Guru</option>
              @foreach($dataGuru as $value)
              <option value="{{$value->id}}">{{ $value->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <a type="button" class="btn btn-primary" href="#" onclick="prosesFilter('{{csrf_token()}}', 'absensi-siswa/filter', 'Absensi')">Filter</a>
      </div>
    </div>
  </div>

  <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-absensi-content">
          
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->
</div>
@endsection
