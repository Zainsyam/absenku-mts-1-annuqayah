@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Edit Data Jadwal</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('jadwal-update', $data->id) }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Mata Pelajaran</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="id_mata_pelajaran" required>
                @foreach($dataMataPelajaran as $value)
                <option value="{{$value->id}}" {{ $data->id_mata_pelajaran == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="id_kelas" required>
                <option>Pilih Kelas</option>
                @foreach($dataKelas as $value)
                <option value="{{$value->id}}" {{ $data->id_kelas == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Pengajar</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="id_guru" required>
                <option>Pilih Guru</option>
                @foreach($dataGuru as $value)
                <option value="{{$value->id}}" {{ $data->id_guru == $value->id ? 'selected' : '' }}>{{ $value->nama_lengkap }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Hari</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="hari" required>
                <option>Pilih Hari</option>
                @foreach($dataHari as $value)
                <option value="{{$value->nama}}" {{ $data->hari == $value->nama ? 'selected' : '' }}>{{ $value->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Jam Mulai</label>
            <div class="col-sm-10">
              <input type="time" class="form-control" name="jam_mulai" value="{{ $data->jam_mulai }}">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Jam Selesai</label>
            <div class="col-sm-10">
              <input type="time" class="form-control" name="jam_selesai" value="{{ $data->jam_selesai }}">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Jenis Jadwal</label>
            <div class="col-sm-10">
              <select class="js-example-basic-single js-states form-control" aria-label="Default select example" name="jenis" required>
                <option>Pilih Jenis</option>
                @foreach($dataJenis as $value)
                <option value="{{$value->nama}}" {{ $data->jenis == $value->nama ? 'selected' : '' }}>{{ $value->nama }}</option>
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
