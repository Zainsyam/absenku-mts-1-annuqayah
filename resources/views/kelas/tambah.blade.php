@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Tambah Data Kelas</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('kelas-simpan') }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kode">
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