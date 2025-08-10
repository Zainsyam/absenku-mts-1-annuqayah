<form method="POST" action="{{ route('update-absensi') }}">
  @csrf
  <div class="d-flex siswa-container" style="margin-bottom:10px;">
      <span class="siswa-nama" style="font-weight: 400;color:#11142d">Nama</span>
      <div class="d-flex absensi-container header" style="font-weight: 400;color:#11142d">
        <span>H</span>
        <span>I</span>
        <span>S</span>
        <span>A</span>
      </div>
  </div>
  <hr>
  @foreach($data as $value)
  <div class="d-flex siswa-container data">
    <span class="siswa-nama" style="font-weight: 400;color:#8d989d">{{ $value->siswa->nama_lengkap }}</span>
    <div class="d-flex absensi-container">
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Hadir"
          {{ $value->status_kehadiran === 'Hadir' ? 'checked' : '' }}>
      </span>
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Izin"
          {{ $value->status_kehadiran === 'Izin' ? 'checked' : '' }}>
      </span>
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Sakit"
          {{ $value->status_kehadiran === 'Sakit' ? 'checked' : '' }}>
      </span>
      <span>
        <input class="form-check-input" type="radio" name="absensi[{{ $value->id }}]" value="Alpha"
          {{ $value->status_kehadiran === 'Alpha' ? 'checked' : '' }}>
      </span>
    </div>
  </div>
  @endforeach
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>