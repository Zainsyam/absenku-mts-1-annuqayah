@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Edit Data Siswa</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('siswa-update', $data->id) }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_lengkap" oninput="this.value = this.value.replace(/[0-9]/g, '')" value="{{ $data->nama_lengkap }}">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nama Panggilan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_panggilan" oninput="this.value = this.value.replace(/[0-9]/g, '')" value="{{ $data->nama_panggilan }}">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">No. WhatsApp</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="noHP" value="{{ $data->noHP }}" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="id_kelas" required>
                @foreach($dataKelas as $value)
                <option value="{{$value->id}}" {{ $data->id_kelas == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
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
