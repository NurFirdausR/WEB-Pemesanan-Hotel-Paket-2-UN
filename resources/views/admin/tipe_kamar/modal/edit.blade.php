<form id="form-tipe-kamar">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Tipe</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama_tipe" id="nama_tipe_edit"
                            value="{{$tipe_kamar->nama_tipe}}">

                        <div class="invalid-feedback">
                            Nama Tipe tidak boleh kosong
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Luas Kamar</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="luas" id="luas_edit"
                            value="{{$tipe_kamar->luas}}">

                        <div class="invalid-feedback">
                            Luas Kamar tidak boleh koosng
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Keterangan Tipe Kamar</label>
                    <div class="input-group">
                        <textarea class="form-control h-25" name="keterangan_edit" id="keterangan_edit" cols="50" rows="6">{{$tipe_kamar->keterangan}}</textarea>
                    
                        <div class="invalid-feedback">
                            Keterangan tidak boleh kosong
                        </div>
                    </div>
                </div>
            </div>
          

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="button_tipe_kamar_update" type="submit"
            class="btn btn-success btm-md justify-content-end mr-3 text-dark"
            style="border-radius: 10px; background: rgb(101, 255, 80);">Update</button>
    </div>
</form>