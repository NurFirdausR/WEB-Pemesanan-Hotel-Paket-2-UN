<form id="form-kamar">
    <div class="card-body">
        {{-- Baris Pertama --}}
        <div class="row">
            {{-- Sebelah Kanan --}}
            <div class="col-md-6">

                <div class="form-group">
                    <label>Nama Referral</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama" id="nama_edit"
                            value="{{$referral->nama}}">

                        <div class="invalid-feedback">
                            Nama Referral tidak boleh kosong
                        </div>
                    </div>
                </div>

               


            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Disc</label>
                    <div class="input-group">
                        <input min="1" max="100" type="number" class="form-control" name="disc" id="disc_edit"
                            value="{{$referral->disc}}">

                        <div class="invalid-feedback">
                            Discount tidak boleh koosng
                        </div>
                    </div>
                </div>

            </div>
           

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="button_referral_update" type="submit"
            class="btn btn-success btm-md justify-content-end mr-3 text-dark"
            style="border-radius: 10px; background: rgb(101, 255, 80);">Update</button>
    </div>
</form>