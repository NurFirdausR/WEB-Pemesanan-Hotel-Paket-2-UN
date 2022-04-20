<style>
    #img-preview_edit {
    /* display: none; */
    width: 400px;
    border: 2px dashed #333;  
    margin-bottom: 20px;
  }
  #img-preview_edit img {
    width: 100%;
    height: 80%;
    display: block;
  }
</style>
<form id="form-fasilitas" enctype="multipart/form-data">
    <div class="card-body">
        {{-- Baris Pertama --}}
        <div class="row">
            {{-- Sebelah Kanan --}}
            <div class="col-md-6">

                <div class="form-group">
                    <label>Nama Fasilitas</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama_fasilitas" id="nama_fasilitas_edit"
                            value="{{$fasilitas->nama_fasilitas}}">

                        <div class="invalid-feedback">
                            Nama Fasilitas tidak boleh kosong
                        </div>
                    </div>
                </div>

               



            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Tipe Fasilitas</label>
                    <div class="input-group">
                        <select style="font-size: 15px; font-weight: 600;" name="tipe_fasilitas"
                            id="tipe_fasilitas_edit" class="form-control col-md-12">
                            <option style="font-size: 15px; font-weight: 600;" value="" >
                                --Pilihan--</option>
                                <option style="font-size: 15px; font-weight: 600;" value="kamar" {{$fasilitas->tipe_fasilitas == 'kamar' ? 'selected' : ''}} >Kamar</option>
                                <option style="font-size: 15px; font-weight: 600;" value="umum" {{$fasilitas->tipe_fasilitas == 'umum'  ? 'selected' : ''}} >Umum</option>
                          

                        </select>
                        <div class="invalid-feedback">
                            Tipe Fasilitas tidak boleh koosng
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>Keterangan Fasilitas</label>
                    <div class="input-group">
                        <textarea class="form-control h-25" name="keterangan" id="keterangan_edit" cols="50" rows="6">{{$fasilitas->keterangan}}</textarea>
                        
                        <div class="invalid-feedback">
                            Keterangan tidak boleh kosong
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Gambar Fasilitas</label>
                    <div class="input-group">
                             <input class="form-control" type="file" id="gambar_edit" name="gambar">
                        <div class="invalid-feedback">
                            Gambar tidak boleh kosong
                        </div>
                        <div class="requirement invalid-feedback">
                            Gambar harus jpg,png ,jpeg
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div id="img-preview_edit">
                    <img src="{{asset('fasilitas_image/'.$fasilitas->gambar)}}" alt="" srcset="">
                </div>

            </div>

            <input type="text" hidden id="gambar_hidden" value="{{$fasilitas->gambar}}">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
                <button  id="button_fasilitas_update" type="submit"
                class=" btn btn-success btm-md justify-content-end mr-3 text-dark"
                style="border-radius: 10px; background: rgb(101, 255, 80);">Update</button>
    
        </div>
    </div>
   
</form>


<script>

$(function () {
    const chooseFile = document.getElementById("gambar_edit");
    const imgPreview = document.getElementById("img-preview_edit");
    const gambar_hidden = document.getElementById("gambar_hidden");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
  }else{
    imgPreview.innerHTML = "<img src='{{ URL::asset('fasilitas_image/"gambar_hidden"') }}' />";

  }
}
      
      
    });
      
</script>