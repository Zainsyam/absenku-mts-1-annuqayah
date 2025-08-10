@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Edit Data Mata Pelajaran</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('matapelajaran-update', $data->id) }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kode" value="{{ $data->kode }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form><!-- End General Form Elements -->
      </div>
    </div>
    </div>
</div>
@endsection