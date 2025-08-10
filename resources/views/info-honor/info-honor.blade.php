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
            <h5 class="card-title">Informasi Honor<span></span></h5>
            <form id="cetak-form" method="POST" action="{{  route('info-honor-cetak') }}" target="_blank">
              @csrf
              <input type="hidden" class="form-control" name="tanggalAwal" id="tanggalAwalCetak">
              <input type="hidden" class="form-control" name="tanggalAkhir" id="tanggalAkhirCetak">
              <a type="button" class="btn btn-primary" href="#" onclick="cetakData('honor/filter', 'Honor')">Cetak</a>
            <form>
            <br/>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Rate Honor</th>
                  <th scope="col">Jumlah Kehadiran</th>
                  <th scope="col">Total Honor</th>
                </tr>
              </thead>
              <tbody id="table-data">
                @include('info-honor.panel-detil')
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
        <a type="button" class="btn btn-primary" href="#" onclick="prosesFilter('{{csrf_token()}}', 'honor/filter', 'Honor')">Filter</a>
      </div>
    </div>
  </div>
</div>
@endsection
