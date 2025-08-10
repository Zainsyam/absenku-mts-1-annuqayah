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
            <h5 class="card-title">Informasi Absensi Siswa<span></span></h5>
            <form id="cetak-form" method="POST" action="{{  route('info-absensi-siswa-cetak') }}" target="_blank">
            @csrf
              <input type="hidden" class="form-control" name="tanggalAwal" id="tanggalAwalCetak">
              <input type="hidden" class="form-control" name="tanggalAkhir" id="tanggalAkhirCetak">
              <input type="hidden" class="form-control" name="idsiswa" id="idsiswaCetak">
              <input type="hidden" class="form-control" name="idkelas" id="idkelasCetak">
              <input type="hidden" class="form-control" name="idmatapelajaran" id="idmatapelajaranCetak">
              <a type="button" class="btn btn-primary" href="#" onclick="cetakData('absensi-siswa/filter', 'AbsensiSiswa')">Cetak</a>
            <form>
            <br/>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Kelas</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Mata Pelajaran</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody id="table-data">
                @include('info-absensi-siswa.panel-detil')
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
          <label for="inputText" class="col-sm-12 col-form-label">Kelas</label>
          <div class="col-sm-12">
            <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="idKelas" id="idKelas">
              <option value="">Pilih Kelas</option>
              @foreach($dataKelas as $value)
              <option value="{{$value->id}}">{{ $value->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Siswa</label>
          <div class="col-sm-12">
            <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="idSiswa" id="idSiswa">
              <option value="">Pilih Siswa</option>
              @foreach($dataSiswa as $value)
              <option value="{{$value->id}}">{{ $value->nama_lengkap }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputText" class="col-sm-12 col-form-label">Mata Pelajaran</label>
          <div class="col-sm-12">
            <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="idMataPelajaran" id="idMataPelajaran">
              <option value="">Pilih Mata Pelajaran</option>
              @foreach($dataMataPelajaran as $value)
              <option value="{{$value->id}}">{{ $value->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <a type="button" class="btn btn-primary" href="#" onclick="prosesFilter('{{csrf_token()}}', 'absensi-siswa/filter', 'AbsensiSiswa')">Filter</a>
      </div>
    </div>
  </div>

  <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Absensi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-absensi-content">
          
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->
</div>
@endsection
