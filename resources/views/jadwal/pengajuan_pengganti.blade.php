<form method="POST">
  <div class="row mb-3">
    <label for="inputText" class="col-sm-3 col-form-label">Alasan</label>
    <div class="col-sm-9">
      <textarea type="text" class="form-control" name="alasan" rows="5" id="alasan"></textarea>
    </div>
  </div>
  <input type="hidden" value="{{$data->id}}" id="id-jadwal-for-pengajuan-pengganti">
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary" onclick="simpanPengajuan('{{csrf_token()}}')">Submit</button>
  </div>
</form>