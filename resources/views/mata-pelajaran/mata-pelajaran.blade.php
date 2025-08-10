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
          <h5 class="card-title">Mata Pelajaran</h5>
          <a type="button" class="btn btn-primary" style="margin-bottom:10px;" href="{{ route('matapelajaran-tambah') }}"><i class="ri-add-circle-fill"></i> Tambah Data</a>

          <!-- Table with stripped rows -->
          <table id="myTable" class="table table-striped">
            <thead>
              <tr>
                <th>
                  Mata Pelajaran
                </th>
                <th>Kode</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $value)
              <tr id="item-{{$value->id}}">
                <td>{{ $value->nama}}</td>
                <td>{{ $value->kode}}</td>
                <td>
                	<!--a type="button" class="btn btn-secondary"><i class="ri-printer-line"></i></a-->
                	<a type="button" class="btn btn-warning" href="{{ route('matapelajaran-edit', $value->id) }}"><i class="ti ti-pencil"></i></a>
                	<a type="button" class="btn btn-danger" href="#" onclick="deleteData('{{csrf_token()}}', '{{ $value->id }}', 'matapelajaran-delete')"><i class="ti ti-trash"></i></a>

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
