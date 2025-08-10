@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Tambah Data Guru</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('guru-simpan') }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" oninput="this.value = this.value.replace(/[0-9]/g, '')" name="nama_lengkap" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama Panggilan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" oninput="this.value = this.value.replace(/[0-9]/g, '')" name="nama_panggilan" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Jenis</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="id_jabatan" required>
                <option>Pilih Jenis</option>
                @foreach($dataJabatan as $value)
                <option value="{{$value->id}}">{{ $value->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Rate Honor</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="rate_gaji">
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
