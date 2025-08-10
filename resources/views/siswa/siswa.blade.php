@extends ('master')
@section('navigation')
@endsection
@section('content')
<form id="hapus" method="GET" action= "" style="display:none;">
  @csrf 
</form>
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Siswa</h5>
          <a type="button" class="btn btn-primary" style="margin-bottom: 10px;" href="{{ route('siswa-tambah') }}"><i class="ri-add-circle-fill"></i> Tambah Data</a>

          <!-- Table with stripped rows -->
          <table id="myTable" class="table table-striped">
            <thead>
              <tr>
                <th>
                  Nama Lengkap
                </th>
                <th>Nama Panggilan</th>
                <th>Kelas</th>
                <th>No WhatsApp</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $value)
              <tr id="item-{{$value->id}}">
                <td>{{ $value->nama_lengkap }}</td>
                <td>{{ $value->nama_panggilan }}</td>
                <td>{{ $value->kelas->nama }}</td>
                <td>{{ $value->noHP}}</td>
                <td>
                  <a type="button" class="btn btn-secondary" href="#" onclick= "event.preventDefault();if(confirm('Apakah Anda Yakin?')) { $('form#hapus').attr('action', '{{ route('siswa-reset', $value->id) }}').submit();}"><i class="ti ti-password"></i></a>
                	<a type="button" class="btn btn-warning" href="{{ route('siswa-edit', $value->id) }}"><i class="ti ti-pencil"></i></a>
                	<a type="button" class="btn btn-danger" href="#" onclick="deleteData('{{csrf_token()}}', '{{ $value->id }}', 'siswa-delete')"><i class="ti ti-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
</div>
@endsection
