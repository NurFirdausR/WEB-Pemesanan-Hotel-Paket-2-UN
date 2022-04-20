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
<form id="form-kamar">
    <div class="card-body">
        {{-- Baris Pertama --}}
        <div class="row">
            {{-- Sebelah Kanan --}}
            <div class="col-md-6">

                <div class="form-group">
                    <label>Nama Kamar</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nama_kamar_edit" id="nama_kamar_edit"
                            value="{{$kamar->nama_kamar}}">

                        <div class="invalid-feedback">
                            Nama Kamar tidak boleh kosong
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>No Kamar</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="no_kamar_edit" id="no_kamar_edit"
                            value="{{$kamar->no_kamar}}">

                        <div class="invalid-feedback">
                            Nomor Kamar tidak boleh koosng
                        </div>
                    </div>
                </div>



            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Maks Orang</label>
                    <div class="input-group">
                    
                            <select class="form-control" name="maks_orang_edit" id="maks_orang_edit">
                                <option value="" >Pilih Maks Orang</option>
                                <option value="1" {{$kamar->maks_orang == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{$kamar->maks_orang == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{$kamar->maks_orang == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{$kamar->maks_orang == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{$kamar->maks_orang == '5' ? 'selected' : '' }}>5</option>
                            </select>
                        <div class="invalid-feedback">
                            Maks Orang tidak boleh koosng
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <div class="input-group">
                        <select style="font-size: 15px; font-weight: 600;" name="tipe_kamar_edit"
                            id="tipe_kamar_edit" class="form-control col-md-12">
                            <option style="font-size: 15px; font-weight: 600;" value="" selected>
                                --Pilihan--</option>
                            @foreach ($tipe_kamar as $item)
                                <option style="font-size: 15px; font-weight: 600;"
                                    value="{{ $item->id }}"{{ $item->id == $kamar->tipe_kamar_id ? 'selected' : '' }}> {{ $item->nama_tipe }} Luas: {{ $item->luas }}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            Tipe Kamar tidak boleh koosng
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label>Harga</label>
                    <div class="input-group">
                        <input min="1"  type="number" class="form-control"
                            name="harga_edit" id="harga_edit" value="{{$kamar->harga}}">

                        <div class="invalid-feedback">
                            Harga tidak boleh kosong
                        </div>
                    </div>
                </div>
                

            </div>


            <div class="col-12">
                <div class="form-group">
                    <label>Fasilitas</label>
                    <div class="input-group">
                        <select style="font-size: 15px; font-weight: 600;"
                            class="form-control col-md-12 " name="fasilitas[]" id="fasilitas_edit"
                            multiple="multiple">
                            
                            @foreach ($fasilitas as $item)
                                @if(in_array($item->id, $data_fasilitas))
                                <option value="{{ $item->id }}" selected="true">{{ $item->nama_fasilitas }}</option>
                                @else
                                <option value="{{ $item->id }}">{{ $item->nama_fasilitas }}</option>
                                @endif 
                            @endforeach

                        </select>
                        <div class="invalid-feedback">
                            Fasilitas tidak boleh koosng
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Gambar Kamar</label>
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
                    <img src="{{asset('kamar_image/'.$kamar->gambar)}}" alt="" srcset="">
                </div>

            </div>


        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
            <button  id="button_kamar_update" type="submit"
            class=" btn btn-success btm-md justify-content-end mr-3 text-dark"
            style="border-radius: 10px; background: rgb(101, 255, 80);">Update</button>

    </div>
</form>

<script type="text/javascript">
            $('#fasilitas_edit').select2();



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
    imgPreview.innerHTML = "<img src='{{ URL::asset('kamar_image/"gambar_hidden"') }}' />";

  }
}
      
      
    });
      
</script>