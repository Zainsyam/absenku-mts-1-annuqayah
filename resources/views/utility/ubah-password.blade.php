@extends ('master')
@section('navigation')
@endsection
@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Ubah Password</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('setting-password-update') }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Password Lama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="current_pass">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Password Baru</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="new_pass">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="confirm_pass">
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
