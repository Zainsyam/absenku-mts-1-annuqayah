<form method="POST" action="{{ route('jadwal-simpan-absensi') }}">
  @csrf
  <div class="row mb-3">
    <label for="inputText" class="col-sm-6 col-form-label">Pokok Pembahasan</label>
    <div class="col-sm-12">
      <textarea type="text" class="form-control" name="pokok_pembahasan" rows="5" id="pokok_pembahasan_absensi"></textarea>
    </div>
  </div>
  <br>
  <span style="font-weight: 600;color:#11142d">Daftar Siswa<span>
  <hr>
  <div class="d-flex siswa-container" style="margin-bottom:10px;">
      <span class="siswa-nama" style="font-weight: 400;color:#11142d">Nama</span>
      <div class="d-flex absensi-container header" style="font-weight: 400;color:#11142d">
        <span>H</span>
        <span>I</span>
        <span>S</span>
        <span>A</span>
      </div>
  </div>
  @foreach($dataSiswa as $value)
  <div class="d-flex siswa-container data">
    <span class="siswa-nama" style="font-weight: 400;color:#8d989d">{{ $value->nama_lengkap }}</span>
    <div class="d-flex absensi-container">
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Hadir">
      </span>
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Izin">
      </span>
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Sakit">
      </span>
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Alpha">
      </span>
    </div>
  </div>
  @endforeach
  <input type="hidden" value="{{$data->id}}" name="id" id="id-jadwal-for-absensi">
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
