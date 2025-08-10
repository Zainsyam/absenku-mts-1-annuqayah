@extends ('master')
@section('navigation')
@endsection
@section('content')
<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Setting System</h5>
        <!-- General Form Elements -->
        <form method="POST" action="{{ route('setting-system-update') }}">
          @csrf
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">Nama Sekolah</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="namaSekolah" id="namaSekolah" value="{{ $namaSekolah->nama }}" required>
              <input type="hidden" class="form-control" name="namaSekolahid" id="namaSekolahid" value="{{ $namaSekolah->id }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">Alamat Sekolah</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="alamatSekolah" id="alamatSekolah" value="{{ $alamatSekolah->nama }}" required>
              <input type="hidden" class="form-control" name="alamatSekolahid" id="alamatSekolahid" value="{{ $alamatSekolah->id }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">Lokasi Latitude</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="schoolLat" id="schoolLat" value="{{ $schoolLat->nama }}" required>
              <input type="hidden" class="form-control" name="schoolLatid" value="{{ $schoolLat->id }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">Lokasi Longitude</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="schoolLong" id="schoolLong" value="{{ $schoolLong->nama }}" required>
              <input type="hidden" class="form-control" name="schoolLongid" value="{{ $schoolLong->id }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">Batas Area (km)</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="batasArea" id="batasArea" value="{{ $batasArea->nama }}" required>
              <input type="hidden" class="form-control" name="batasAreaid" id="batasAreaid" value="{{ $batasArea->id }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">Status Validasi Lokasi</label>
            <div class="col-sm-6">
              <select class="js-example-basic-single js-states form-control" name="statusValidasiLokasiValue" aria-label="Default select example" required>
                @if($statusValidasiLokasi->nama == 'Yes')
                <option value="Yes" selected>Aktif</option>
                <option value="No">Nonaktif</option>
                @else
                <option value="Yes">Aktif</option>
                <option value="No" selected>Nonaktif</option>
                @endif
              </select>
            </div>
          </div>
          <input type="hidden" class="form-control" name="statusValidasiLokasi" value="{{ $statusValidasiLokasi->id }}" required>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">Status Validasi Network</label>
            <div class="col-sm-6">
              <select class="js-example-basic-single js-states form-control" name="statusValidasiNetworkValue" aria-label="Default select example" required>
                @if($statusValidasiNetwork->nama == 'Yes')
                <option value="Yes" selected>Aktif</option>
                <option value="No">Nonaktif</option>
                @else
                <option value="Yes">Aktif</option>
                <option value="No" selected>Nonaktif</option>
                @endif
              </select>
            </div>
          </div>
          <input type="hidden" class="form-control" name="statusValidasiNetwork" value="{{ $statusValidasiNetwork->id }}" required>
          <div class="row mb-3">
            <label for="inputText" class="col-sm-6 col-form-label">IP Network</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="ipNetwork" id="ipNetwork" value="{{ $ipNetwork->nama }}" required>
              <input type="hidden" class="form-control" name="ipNetworkId" value="{{ $ipNetwork->id }}" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form><!-- End General Form Elements -->
      </div>
    </div>
    </div>
  <div class="col-lg-6">
        <center>
            <div id="map"></div>
        </center>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // fungsi ini akan berjalan ketika akan menambahkan gambar dimana fungsi ini
    // akan membuat preview image sebelum kita simpan gambar tersebut.      
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // Ketika tag input file denghan class image di klik akan menjalankan fungsi di atas
    $("#image").change(function() {
        readURL(this);
    });

    $(document).ready(function () {
        // Semua kode di sini
    var latInput = document.querySelector("[name=schoolLat]");
    var lngInput = document.querySelector("[name=schoolLong]");

    var schoolLat = parseFloat(latInput.value) || -7.105051;
    var schoolLng = parseFloat(lngInput.value) || 113.811255;
    console.log("LAT VALUE:", document.querySelector("[name=schoolLat]").value);
    console.log("LNG VALUE:", document.querySelector("[name=schoolLong]").value);
    var streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    });

    var satellite = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        maxZoom: 17,
        attribution: '© OpenTopoMap contributors'
    });

    var map = L.map('map', {
        center: [schoolLat, schoolLng],
        zoom: 15,
        layers: [streets]
    });

    L.control.layers({
        "Streets": streets,
        "Satellite": satellite
    }).addTo(map);

    var marker = L.marker([schoolLat, schoolLng], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function (event) {
        var location = marker.getLatLng();
        latInput.value = location.lat;
        lngInput.value = location.lng;
    });

    map.on("click", function (e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        marker.setLatLng(e.latlng);
        latInput.value = lat;
        lngInput.value = lng;
    });
});

        
</script>
@endsection