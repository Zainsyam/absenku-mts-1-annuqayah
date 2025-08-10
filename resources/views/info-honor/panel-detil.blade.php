@if(isset($data) && $data->count() > 0)
  <?php $no = 0;?>
  @foreach($data as $value)
  <?php $no++ ?>
  <tr>
    <th scope="row">{{$no}}</th>
    <td>{{ $value->nama_guru}}</td>
    <td>Rp {{ number_format($value->rate_gaji, 2, ',', '.') }}</td>
    <td>{{ $value->jumlah_kehadiran}}</td>
    <td>Rp {{ number_format($value->total_honor, 2, ',', '.') }}</td>
  </tr>
  @endforeach
@else
  <p class="text-center">Tidak ada data untuk periode yang dipilih.</p>
@endif