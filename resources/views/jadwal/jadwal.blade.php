@extends ('master')
@section('navigation')
@endsection
@section('content')
<section class="section">
    <a type="button" class="btn btn-primary" style="margin-bottom:10px;" href="{{ route('jadwal-tambah') }}"><i class="ri-add-circle-fill"></i> Tambah Data</a>

      <div class="row align-items-top">
        @foreach($data as $value)
        <div class="col-lg-3" id="item-{{$value->id}}">
          <!-- Card with header and footer -->
          <div class="card">
            <div class="card-header">{{$value->hari}}, {{ date('H:i', strtotime($value->jam_mulai)) }} - {{ date('H:i', strtotime($value->jam_selesai)) }}</div>
            <div class="card-body">
              <h5 class="card-title">{{ $value->matapelajaran->nama }}</h5>
              <h6 class="text-muted">Kelas: {{$value->kelas->nama}}</h6>
              <h6 class="text-muted">Pengajar: {{$value->guru->nama_lengkap}}</h6>
            </div>
            <div class="card-footer">
              <a type="button" class="btn btn-warning" href="{{ route('jadwal-edit', $value->id) }}"><i class="ti ti-pencil"></i></a>
              <a type="button" class="btn btn-danger" href="#" onclick="deleteData('{{csrf_token()}}', '{{ $value->id }}', 'jadwal-delete')"><i class="ti ti-trash"></i></a>
            </div>
          </div><!-- End Card with header and footer -->
        </div>
        @endforeach
      </div>
      <div class="modal fade" id="verticalycentered" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Form Rekam Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="modal-absensi-content">
                
              </div>
            </div>
          </div>
        </div><!-- End Vertically centered Modal-->
    </section>
@endsection
