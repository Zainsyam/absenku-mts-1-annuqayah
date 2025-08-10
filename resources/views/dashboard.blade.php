@inject('siswaModel', 'App\Models\Siswa')
@extends ('master')
@section('navigation')
@endsection
@section('content')
  @if(Auth::user() != null && Auth::user()->role == 'Guru')
  <section class="section">
      <div class="row">
        <div class="col-lg-9">
          <div class="row align-items-top">
            @foreach($data as $hari => $jadwals)
            <h5>{{ $hari }}</h5>
              @foreach($jadwals as $value)
              <div class="col-lg-4" id="item-{{$value->id}}">
                <!-- Card with header and footer -->
                <div class="card">
                  <div class="card-header">{{$value->hari}}, {{ date('H:i', strtotime($value->jam_mulai)) }} - {{ date('H:i', strtotime($value->jam_selesai)) }}</div>
                  <div class="card-body">
                    <h5 class="card-title">{{ $value->matapelajaran->nama }}</h5>
                    <h6 class="text-muted">Kelas: {{$value->kelas->nama}}</h6>
                    <h6 class="text-muted">Pengajar: {{$value->guru->nama_lengkap}}</h6>
                  </div>
                  <div class="card-footer">
                      @if ($hariIni == $value->hari)
                      <a type="button" class="btn btn-success" onclick="mulaiAbsensi('{{ csrf_token() }}', '{{ $value->id }}')">
                         <i class="ti ti-check"></i>
                      </a>
                      @endif
                      @if ($value->status_pengganti == false)
                      <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#verticalycentered2" 
                         onclick="editData('{{ csrf_token() }}', '{{ $value->id }}', 'akademik/jadwal/pengajuan-pengganti', '#modal-pengajuan-pengganti-content')">
                         <i class="ti ti-user-off"></i>
                      </a>
                      @endif
                      <button type="button" class="d-none" id="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#verticalycentered" 
                         onclick="editData('{{ csrf_token() }}', '{{ $value->id }}', 'akademik/jadwal/rekam-absensi', '#modal-absensi-content')">
                      </button>
                  </div>
                </div><!-- End Card with header and footer -->
              </div>
              @endforeach
            @endforeach
          </div>
        </div>
        <div class="col-lg-3">
          <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                  <h4>Data Terkini</h4>
                  <!-- Sales Card -->
                  <div class="col-xxl-12 col-md-12">
                    <div class="card info-card customers-card">
                      <div class="card-body">
                        <h5 class="card-title">Absensi</h5>

                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi-lightbulb"></i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ $totalAbsenTercatat }}</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Sales Card -->

                  <div class="col-xxl-12 col-md-12">
                    <div class="card info-card revenue-card">
                      <div class="card-body">
                        <h5 class="card-title">Honor</h5>

                        <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi-person-check"></i>
                          </div>
                          <div class="ps-3">
                            <h6>{{ $totalHonor }}</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Sales Card -->
                </div>
            </div>
          </div>
        
      </div>
      
    </div>
  </section>
  @elseif(Auth::user() != null && Auth::user()->role == 'Admin')
  <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <h4>Data Terkini</h4>
          <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Kelas</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-mortarboard"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalKelas }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Mata Pelajaran</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-lightbulb"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalMataPelajaran }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Guru</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-person-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalGuru }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Absensi</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-calendar-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalAbsenTercatat }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
          </div>
          <hr>
          <div class="row">
            <h4>Peringkat Kehadiran</h4>
            <!-- Top Staf Hadir -->
            <div class="col-6">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Guru Paling Rajin Bulan Ini</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah Sesi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($topStafHadir as $index => $staf)
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $staf->nama_lengkap }}</td>
                        <td class="fw-bold text-success">{{ $staf->total_hadir }}x</td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="3" class="text-center">Belum ada data kehadiran bulan ini.</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>

                </div>
              </div>
            </div><!-- End Top Staf -->

            <!-- Top Staf Hadir -->
            <div class="col-6">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Top Siswa dengan Kehadiran Terendah (Alpha)</h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah Alpha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($topSiswaAlpha as $index => $siswa)
                      <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $siswa->nama_lengkap }}</td>
                        <td class="fw-bold text-success">{{ $siswa->total_alpha }}x</td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="3" class="text-center">Belum ada data kehadiran bulan ini.</td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>

                </div>
              </div>
            </div><!-- End Top Staf -->
          </div>
        </div>
      </div>
    </section>
  @elseif(Auth::user() != null && Auth::user()->role == 'Siswa')
  @php
    $siswa = $siswaModel->where('user_id', Auth::user()->id)->first();
  @endphp
  <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <!-- Top Staf Hadir -->
            <div class="col-8">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Data Siswa</h5>
                    <form method="POST">
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Nama Lengkap</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_lengkap" value="{{ $siswa->nama_lengkap }}" readonly>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Nama Panggilan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_panggilan" value="{{ $siswa->nama_panggilan }}" readonly>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Kelas</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_panggilan" value="{{ $siswa->kelas->nama }}" readonly>
                      </div>
                    </div>
                  </form><!-- End General Form Elements -->
                </div>
              </div>
            </div><!-- End Top Staf -->

            <!-- Top Staf Hadir -->
            <div class="col-4">
              <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                  <h5 class="card-title">Absensi Siswa</h5>
                  <canvas id="absensiPieChart" height="200"></canvas>
                </div>
              </div>
            </div><!-- End Top Staf -->

          </div>
        </div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const pieData = {
            labels: ['Hadir', 'Izin', 'Sakit', 'Alpha'],
            datasets: [{
                label: 'Absensi',
                data: [
                    {{ $totalAbsenHadir }},
                    {{ $totalAbsenIzin }},
                    {{ $totalAbsenSakit }},
                    {{ $totalAbsenAlpha }}
                ],
                backgroundColor: [
                    '#4caf50', // Hadir - Hijau
                    '#ff9800', // Izin - Oranye
                    '#2196f3', // Sakit - Biru
                    '#f44336'  // Alpha - Merah
                ],
                borderWidth: 1
            }]
        };

        const pieConfig = {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: ''
                    }
                }
            },
        };

        new Chart(document.getElementById('absensiPieChart'), pieConfig);
    </script>
  @elseif(Auth::user() != null && Auth::user()->role == 'Guru Piket')
    <section class="section">
        <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <h4>Data Terkini</h4>
            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Absensi</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-lightbulb"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalAbsenTercatat }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Honor</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi-person-check"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalHonor }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->
          </div>
          <hr>
          <div class="row">
              <h4>Jadwal Anda</h4>
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
                      @if ($hariIni == $value->hari)
                      <a type="button" class="btn btn-success" onclick="mulaiAbsensi('{{ csrf_token() }}', '{{ $value->id }}')">
                         <i class="ti ti-check"></i>
                      </a>
                      @endif
                      @if ($value->status_guru_pengganti == false)
                      <a type="button" class="btn btn-primary" onclick="alihkanJadwal('{{csrf_token()}}', '{{ $value->id }}', 'akademik/jadwal/alihkan-jadwal')">
                         <i class="ti ti-user-plus"></i>
                      </a>
                      @endif
                      <button type="button" class="d-none" id="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#verticalycentered" 
                         onclick="editData('{{ csrf_token() }}', '{{ $value->id }}', 'akademik/jadwal/rekam-absensi', '#modal-absensi-content')">
                      </button>
                  </div>
                </div><!-- End Card with header and footer -->
              </div>
              @endforeach
          </div>
        </div>
      </div>
    </section>
  @endif
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
  <div class="modal fade" id="verticalycentered2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Pengajuan Izin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-pengajuan-pengganti-content">
          
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->
@endsection
