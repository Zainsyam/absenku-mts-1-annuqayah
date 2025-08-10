<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Absenku</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
   integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
   crossorigin=""/>

    <style>
        #map {
            height: 80vh;
            width: 100%;
        }
  </style>
  <style>
    .siswa-container{
      gap: :5px;
    }
    .siswa-container.data{
      margin-bottom: 5px;
    }
    .siswa-nama{
      min-width: 56%;
      max-width: 56%;
    }
    .absensi-container.header{
      margin-left: 3px;
      gap: 32px;
    }
    .absensi-container{
      gap:19px;
    }
</style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  App Topstrip -->
    <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
        <a class="d-flex justify-content-center" href="#">
          <img src="{{ asset('assets/images/logos/logo.png') }}" alt="" width="30px">
        </a>

        
      </div>

      <div class="d-lg-flex align-items-center gap-2">
       
        <div class="d-flex align-items-center justify-content-center gap-2">
          
          <div class="dropdown d-flex">
            <a class="d-flex align-items-center gap-1 " href="javascript:void(0)" id="drop4"
              data-bs-toggle="dropdown" aria-expanded="false">
              
            </a>
          </div>
        </div>
      </div>

    </div>
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="#" class="text-nowrap logo-img">
            <img src="{{ asset('assets/images/logos/logo.png') }}" width="50px" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-6"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Master</span>
            </li>
            @if(Auth::user() != null)
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                <i class="ti ti-atom"></i>
                <span class="hide-menu">Dashboard</span>
              </a>
            
            @endif
            @if(Auth::user() != null && Auth::user()->role == 'Admin')
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('akademik/kelas*') ? 'active' : '' }}" href="{{ route('kelas') }}" aria-expanded="false">
                <i class="ti ti-school"></i>
                <span class="hide-menu">Kelas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('akademik/matapelajaran*') ? 'active' : '' }}" href="{{ route('matapelajaran') }}" aria-expanded="false">
                <i class="ti ti-book"></i>
                <span class="hide-menu">Mata Pelajaran</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('akademik/jadwal*') ? 'active' : '' }}" href="{{ route('jadwal') }}" aria-expanded="false">
                <i class="ti ti-clock"></i>
                <span class="hide-menu">Jadwal</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('akademik/siswa*') ? 'active' : '' }}" href="{{ route('siswa') }}" aria-expanded="false">
                <i class="ti ti-users"></i>
                <span class="hide-menu">Siswa</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('akademik/guru*') ? 'active' : '' }}" href="{{ route('guru') }}" aria-expanded="false">
                <i class="ti ti-user-check"></i>
                <span class="hide-menu">Guru</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('akademik/staf*') ? 'active' : '' }}" href="{{ route('staf') }}" aria-expanded="false">
                <i class="ti ti-user-circle"></i>
                <span class="hide-menu">Staf</span>
              </a>
            </li>
            @endif
            @if(Auth::user() != null && Auth::user()->role == 'Admin')
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Informasi</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('informasi/absensi') ? 'active' : '' }}" href="{{ route('info-absensi') }}" aria-expanded="false">
                <i class="ti ti-info-circle"></i>
                <span class="hide-menu">Info Absensi Guru</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('informasi/absensi-siswa*') ? 'active' : '' }}" href="{{ route('info-absensi-siswa') }}" aria-expanded="false">
                <i class="ti ti-info-circle"></i>
                <span class="hide-menu">Info Absensi Siswa</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('informasi/honor*') ? 'active' : '' }}" href="{{ route('info-honor') }}" aria-expanded="false">
                <i class="ti ti-info-circle"></i>
                <span class="hide-menu">Info Honor</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
              <span class="hide-menu">Konfigurasi</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link {{ request()->is('setting/system*') ? 'active' : '' }}" href="{{ route('setting-system') }}" aria-expanded="false">
                <i class="ti ti-settings"></i>
                <span class="hide-menu">Pengaturan</span>
              </a>
            </li>
            @endif           
            <li class="sidebar-item">
              <a href="{{ route('logout') }}" class="sidebar-link {{ request()->is('logout*') ? 'active' : '' }}">
                <i class="ti ti-logout"></i>
                <span class="hide-menu">Logout</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
               
              <!-- <li class="nav-item dropdown">
                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>                    
                    <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li> -->
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="body-wrapper-inner">
        
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script>
    $('#myTable').DataTable();
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    
    function prosesFilter(token, act, form) {
        var tanggalAwal = $('#tanggalAwal').val();
        var tanggalAkhir = $('#tanggalAkhir').val();
        
        //alert(form);
        if(form == "Absensi"){
          var idguru = $('#idguru').val();
          $.post(act, {
                _token: token,
                tanggalAwal: tanggalAwal,
                tanggalAkhir: tanggalAkhir,
                idguru: idguru,
            },
            function (data) {
                $('#table-data').html(data);
            });
        }
        else if(form == "AbsensiSiswa"){
          //alert("Masuk ke absensi");
          var idsiswa = $('#idSiswa').val();
          var idmatapelajaran = $('#idMataPelajaran').val();
          var idkelas = $('#idKelas').val();
          $.post(act, {
                _token: token,
                tanggalAwal: tanggalAwal,
                tanggalAkhir: tanggalAkhir,
                idsiswa: idsiswa,
                idmatapelajaran: idmatapelajaran,
                idkelas: idkelas,
            },
            function (data) {
                $('#table-data').html(data);
            });
        }
        else{
          $.post(act, {
                _token: token,
                tanggalAwal: tanggalAwal,
                tanggalAkhir: tanggalAkhir,
            },
            function (data) {
                $('#table-data').html(data);
            });
        }
        
    }

    function cetakData(act, form) {
        var tanggalAwal = $('#tanggalAwal').val();
        var tanggalAkhir = $('#tanggalAkhir').val();
        document.getElementById('tanggalAwalCetak').value = tanggalAwal;
        document.getElementById('tanggalAkhirCetak').value = tanggalAkhir;
        if(form == "Absensi"){
          var idguru = $('#idguru').val();
          document.getElementById('idguruCetak').value = idguru;
        }else if(form == "AbsensiSiswa") {
          var idsiswa = $('#idSiswa').val();
          document.getElementById('idsiswaCetak').value = idsiswa;
          var idmatapelajaran = $('#idMataPelajaran').val();
          document.getElementById('idmatapelajaranCetak').value = idmatapelajaran;
          var idkelas = $('#idKelas').val();
          document.getElementById('idkelasCetak').value = idkelas;

        }
        document.getElementById('cetak-form').submit();
    }

    function editData(token, id, act, target) {
        //alert(id);
        $.post(act, {
            _token: token,
            id: id
        },
            function (data) {
                $(target).html(data);
            });
    }

    function deleteData(token, id, act) {
          Swal.fire({
              title: 'Anda Yakin ?',
              text: "",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#4caf50',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonText: 'Batal',
          }).then((result) => {
              if (result.value) {
                  $.post(act, {
                      _token: token,
                      id: id
                  },
                      function (data) {
                      });
                  Swal.fire(
                      'Sukses!',
                      'Data Berhasil dihapus!',
                      'success'
                  )
                  $("#item-" + id).hide();
              }
          });
    }

    function alihkanJadwal(token, id, act) {
          Swal.fire({
              title: 'Anda Yakin ?',
              text: "",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#4caf50',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya',
              cancelButtonText: 'Batal',
          }).then((result) => {
              if (result.value) {
                  $.post(act, {
                      _token: token,
                      id: id
                  },
                      function (data) {
                      });
                 
                 location.reload();
              }
          });
    }



    

    function mulaiAbsensi(token, id) {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (position) {
              var lat = position.coords.latitude;
              var long = position.coords.longitude;

              $.ajax({
                  url: 'akademik/jadwal/validasi-absensi',
                  method: "POST",
                  data: {
                      _token: token,
                      id: id,
                      latitude: lat,
                      longitude: long
                  },
                  success: function (res) {
                      // Kalau response 200 OK, periksa isi JSON
                      if (res.status === 'success') {
                          document.getElementById(id).click();
                      } else {
                          Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message,
                          });
                      }
                  },
                  error: function (xhr) {
                      try {
                          var res = JSON.parse(xhr.responseText);
                          if (res.message) {
                              Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message,
                              });
                          } else {
                              Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan tidak dikenal',
                              });
                          }
                      } catch (e) {
                          Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan tidak dikenal',
                          });
                      }
                  }
              });

          }, function (err) {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal mendapatkan lokasi. Pastikan GPS diaktifkan dan izin lokasi diberikan',
              });
          });
      } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Browser tidak mendukung Geolocation',
          });
      }
  }

  function simpanPengajuan(token) {
        // Ambil nilai dari form
        const idJadwal = document.getElementById("id-jadwal-for-pengajuan-pengganti").value;
        const alasan = document.getElementById("alasan").value;

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: 'akademik/jadwal/simpan-pengajuan', // Endpoint API di Laravel
            type: 'POST',
            data: {
                _token: token, // Token CSRF
                id: idJadwal,
                alasan: alasan,
            },
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire('Sukses!', response.message, 'success');
                } else {
                    Swal.fire('Gagal!', response.message, 'error');
                }

            },
            error: function (xhr) {
                const error = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan pada server.';
                Swal.fire('Gagal', error, 'error');
            }
        });

        $('#verticalycentered2').modal('hide');
    }

  </script>
</body>

</html>