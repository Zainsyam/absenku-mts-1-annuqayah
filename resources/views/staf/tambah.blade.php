@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Tambah Data Staf</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('staf-simpan') }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_lengkap" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama Panggilan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_panggilan" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="id_jabatan" required>
                <option>Pilih Jabatan</option>
                @foreach($dataJabatan as $value)
                <option value="{{$value->id}}">{{ $value->nama }}</option>
                @endforeach
              </select>
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
