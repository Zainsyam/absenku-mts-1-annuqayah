@if(isset($data) && $data->count() > 0)
  <?php $no = 0;?>
  @foreach($data as $value)
  <?php $no++ ?>
  <tr>
    <th scope="row">{{$no}}</th>
    <td>{{ $value->staf->nama_lengkap }}</td>
    <td>{{ date("d F Y", strtotime($value->tanggal)) }}</td>
    <td>
      <center><a type="button" class="" href="#" id="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#verticalycentered" 
        onclick="editData('{{ csrf_token() }}', '{{ $value->id }}', 'absensi/detail-siswa', '#modal-absensi-content')"><i class="ti ti-eye"></i></a></center>
    </td>
  </tr>
  @endforeach
@else
  <p class="text-center">Tidak ada data untuk periode yang dipilih.</p>
@endif