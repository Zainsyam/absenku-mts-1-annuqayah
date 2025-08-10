@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Ubah Profile</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('setting-profile-update') }}" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="username" value="{{Auth::user()->username}}" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Foto Profil</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="userpp" accept="image/*">
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
