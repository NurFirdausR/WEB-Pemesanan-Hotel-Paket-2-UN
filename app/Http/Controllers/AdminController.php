<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kamar;
use App\Models\Fasilitas;
use App\Models\Reservasi;
use App\Models\ReferralCode;
use App\Models\TipeKamar;
use App\Models\Pendapatan;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{


      
    public function dashboard_index()
    {
        $total_kamar = Kamar::all()->unique('code_kamar')->count();
        $total_tipe_kamar = TipeKamar::all()->count();
        $total_fasilitas_umum = Fasilitas::where('tipe_fasilitas','umum')->count();
        $total_fasilitas_kamar = Fasilitas::where('tipe_fasilitas','kamar')->count();
        $total_pendapatan = Pendapatan::find(1)->total;
      return view('admin.dashboard',compact('total_pendapatan','total_kamar','total_tipe_kamar','total_fasilitas_umum','total_fasilitas_kamar'));
    }
    

    public function fasilitas_index()
    {
      return view('admin.fasilitas.index');

    }
    public function fasilitas_ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = Fasilitas::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button  id="edit_fasilitas" data-id='.$row->id.' class="edit btn btn-success btn-sm">Edit</button> ';

                    return $actionBtn;
                })
                ->addColumn('gambar', function($row){
                    if (File::exists(public_path('fasilitas_image/'.$row->gambar))) {
                        return '<img src='.asset('fasilitas_image/'.$row->gambar).' style="width: 200px; height:100px;" alt='.$row->gambar.'>';
                    }else{
                        return '<span class="text-secondary">"Gambar tidak di temukan"</span>';

                    }
                })
                ->rawColumns(['action','gambar'])
                ->make(true);
        }
    }
    public function fasilitas_store(Request $request)
    {
          

            if ($files = $request->file('gambar')) {
        
                // //delete old file
                // \File::delete('public/product/'.$request->hidden_gambar);
              
                //insert new file
                // $destinationPath = 'public/fasilitas_image/'; // upload path
                $profilegambar = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move(public_path('fasilitas_image'), $profilegambar);
                // $details['gambar'] = "$profilegambar";
             }else{
                 $res['success'] = false;
                 $res['msg'] = 'Gagal Gambar tidak ada di tambah';
             }
         
             $fasilitas   =   Fasilitas::create([
                 'nama_fasilitas' => $request->nama_fasilitas,
                 'keterangan' =>  $request->keterangan,
                 'gambar' =>  $profilegambar,
                 'tipe_fasilitas' =>  $request->tipe_fasilitas
             ]);

             $res['success'] = true;
             $res['msg'] = 'Berhasil Menambah Fasilitas ';
            return response()->json($res);

        
    }
    public function fasilitas_edit($id)
    {
        $fasilitas = Fasilitas::find($id);
        return view('admin.fasilitas.modal.edit',compact('fasilitas'));

    }
    public function fasilitas_update(Request $request,$id)
    {   


        // return response()->json(Fasilitas::where('id',$id)->first()->gambar);
        
        if ($files = $request->file('gambar')) {
             if(File::exists(public_path('fasilitas_image/'.Fasilitas::where('id',$id)->first()->gambar))){
             File::delete(public_path('fasilitas_image/'.Fasilitas::where('id',$id)->first()->gambar));
             }
            $profilegambar = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('fasilitas_image'), $profilegambar);
            // $details['gambar'] = "$profilegambar";
         }else{
             $profilegambar = Fasilitas::where('id',$id)->first()->gambar;
         }

        $fasilitas =  Fasilitas::where('id',$id)->update([
            'nama_fasilitas' => $request->nama_fasilitas,
            'keterangan' =>  $request->keterangan,
            'gambar' =>  $profilegambar,
            'tipe_fasilitas' =>  $request->tipe_fasilitas
        ]);

        if ($fasilitas) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Update Data Fasilitas';
        }else{
            $res['success'] = false;
            $res['msg'] = 'Gagal Update Data Fasilitas';
        }
    
        return response()->json($res);
        

        # code...
    }
   
    public function kamar_index()
    {
        $tipe_kamar = TipeKamar::all();
        $fasilitas = Fasilitas::where('tipe_fasilitas','kamar')->get();

        return view('admin.kamar.index',compact('tipe_kamar','fasilitas'));
      
    }
    public function kamar_ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = Kamar::latest()->get()->unique('code_kamar');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button  id="edit_kamar" data-id='.$row->id.' class="edit btn btn-success btn-sm">Edit</button> <button id="delete_kamar" data-id='.$row->id.' class="delete btn btn-danger btn-sm">Delete</button>';
                    return $actionBtn;
                })
                ->addColumn('gambar', function($row){
                    if (File::exists(public_path('kamar_image/'.$row->gambar))) {
                        return '<img src='.asset('kamar_image/'.$row->gambar).' style="width: 200px; height:100px;" alt='.$row->gambar.'>';
                    }else{
                        return '<span class="text-secondary">"Gambar tidak di temukan"</span>';

                    }
                })
                ->addColumn('status', function($row){
                    if ($row->status == "process") {
                        return '<span class="btn btn-warning"> Proses</span>';
                    }else if($row->status == "unbooked"){
                        return '<span class="btn btn-secondary">Belum dipesan</span>';
                    }else{
                        return '<span class="btn btn-primary">Dipesan</span>';
                    }
                })

                // if ($row->status == "waiting") {
                //     return '<span class="btn btn-warning"> Proses</span>';
                // }else if($row->status == "check_in"){
                //     return '<span class="btn btn-primary">Booked</span>';
                // }else{
                //     return '<span class="btn btn-dark">Checkout</span>';
                // }

               
                
                ->rawColumns(['action','status','gambar'])
                ->make(true);
        }
    }
    public function kamar_store(Request $request)
    {
        
        $fasilitas = explode(',',$request->fasilitas);
        // return response()->json($fasilitas);
        // return response()->json($request->fasilitas);

        if ($files = $request->file('gambar')) {
        
            // //delete old file
            // \File::delete('public/product/'.$request->hidden_gambar);
          
            //insert new file
            // $destinationPath = 'public/kamar_image/'; // upload path
            $profilegambar = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('kamar_image'), $profilegambar);
            // $details['gambar'] = "$profilegambar";
            
         }else{
             $res['success'] = false;
             $res['msg'] = 'Gagal Gambar tidak ada di tambah';
         }
         
         $code = Str::random(6);
         foreach ($fasilitas as $key => $value) {
             $kamar =   Kamar::create([
                'nama_kamar' => $request->nama_kamar,
                'no_kamar' => $request->no_kamar,
                'code_kamar' => $code,
                'harga' => $request->harga,
                'maks_orang' => $request->maks_orang,
                'fasilitas_id' => $value,
                'tipe_kamar_id' => intval($request->tipe_kamar),
                'status' => 'unbooked',
                'gambar' =>  $profilegambar,
                'created_at' => Carbon::now()
            ]);
         }

     
       



        if (!isset($kamar->id)) {
            $res['success'] = false;
            $res['msg'] = 'Gagal Menambah Data Kamar';
        }
        $res['success'] = true;
        $res['msg'] = 'Berhasil Menambah Data Kamar';
        return response()->json($res);

        
        
        // return response()->json(['msg'=>'Gagal Menambah Data Kamar']);

    }
    public function kamar_edit($id)
    {
        $kamar = Kamar::find($id);
        $kamar_get_by_code = Kamar::where('code_kamar',$kamar->code_kamar)->get();
        foreach ($kamar_get_by_code as $key) {
                $data_fasilitas[] = $key['fasilitas_id'];
        }
        // dd($data_fasilitas);
        $tipe_kamar = TipeKamar::all();
        $fasilitas = Fasilitas::where('tipe_fasilitas','kamar')->get();
        return view('admin.kamar.modal.edit',compact('kamar','data_fasilitas','fasilitas','tipe_kamar'));
    }
    public function kamar_update(Request $request,$id)
    {

        // return response()->json($request);

        // $fasilitas = implode(',',$request->fasilitas);

        if ($files = $request->file('gambar')) {
            if(File::exists(public_path('kamar_image/'.Kamar::where('id',$id)->first()->gambar))){
            File::delete(public_path('kamar_image/'.Kamar::where('id',$id)->first()->gambar));
            }
           $profilegambar = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move(public_path('kamar_image'), $profilegambar);
           // $details['gambar'] = "$profilegambar";
        }else{
            $profilegambar = Kamar::where('id',$id)->first()->gambar;
        }

        $fasilitas = explode(',',$request->fasilitas);
        $code_kamar = Kamar::find($id)->code_kamar;
        $kamar =  Kamar::where('code_kamar',$code_kamar)->get();
        
        foreach ($kamar as $key => $value) {
            $kamar_id[] = $value['id'];
            }
       $reservasi = Reservasi::whereIn('kamar_id',$kamar_id)->get();
       foreach ($reservasi as $key => $value) {
         $reservasi_kamar_id[] = $value['kamar_id'];
        }
        // return response()->json($reservasi->isEmpty());
        
        if ($reservasi->isEmpty()) {

            // return response()->json('trueh');

            $kamar_delete = Kamar::where('code_kamar',$code_kamar)->delete();
            $code = Str::random(6);
            foreach ($fasilitas as $key => $value) {
                 $kamar_update[] = Kamar::create([
                   'nama_kamar' => $request->nama_kamar,
                   'no_kamar' => $request->no_kamar,
                   'code_kamar' => $code,
                   'harga' => $request->harga,
                   'maks_orang' => $request->maks_orang,
                   'fasilitas_id' => $value,
                   'tipe_kamar_id' => intval($request->tipe_kamar),
                   'status' => 'unbooked',
                   'gambar' =>  $profilegambar,
                   'created_at' => Carbon::now()
               ]);
            }
        }else{
            // return response()->json($reservasi_kamar_id);
            
            $code = Str::random(6);
            foreach ($fasilitas as $key => $value) {
                 $kamar_update[] = Kamar::create([
                   'nama_kamar' => $request->nama_kamar,
                   'no_kamar' => $request->no_kamar,
                   'code_kamar' => $code,
                   'harga' => $request->harga,
                   'maks_orang' => $request->maks_orang,
                   'fasilitas_id' => $value,
                   'tipe_kamar_id' => intval($request->tipe_kamar),
                   'status' => 'process',
                   'gambar' =>  $profilegambar,
                   'created_at' => Carbon::now()
                ]);
            }
                Reservasi::where('kamar_id',$reservasi_kamar_id)->update([
                    'kamar_id' => $kamar_update[0]->id
                ]);

          $kamar_delete = Kamar::where('code_kamar',$code_kamar)->delete();
         
        }

  

        if ($kamar_delete) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Update Data Kamar';
        }else{
            $res['success'] = false;
            $res['msg'] = 'Gagal Update Data Kamar';
        }
    
        return response()->json($res);

        
    }
    public function kamar_delete($id)
    {
        $code_kamar = Kamar::find($id)->code_kamar;

        $kamar =  Kamar::where('code_kamar',$code_kamar)->get();
        
        foreach ($kamar as $key => $value) {
            $kamar_id[] = $value['id'];
            }
            
            $reservasi = Reservasi::whereIn('kamar_id',$kamar_id)->get();
            // return response()->json($reservasi[0]['kamar_id']);
       if ($reservasi->isEmpty()) {
            // return response()->json('true');
            $kamar = Kamar::where('code_kamar',$code_kamar)->delete();
        }else{
            // return response()->json($reservasi,$kamar);
            if(File::exists(public_path('kamar_image/'.Kamar::where('id',$id)->first()->gambar))){
                File::delete(public_path('kamar_image/'.Kamar::where('id',$id)->first()->gambar));
            }
            if(File::exists(public_path('pdf/'.Reservasi::where('kamar_id',$reservasi[0]['kamar_id'])->first()->bukti_reservasi))){
                File::delete(public_path('pdf/'.Reservasi::where('kamar_id',$reservasi[0]['kamar_id'])->first()->bukti_reservasi));
            }
            Reservasi::where('kamar_id',$reservasi[0]['kamar_id'])->delete();
            $kamar = Kamar::where('code_kamar',$code_kamar)->delete();
        }


        if ($kamar) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Hapus Data Kamarr';
        }else{
            $res['success'] = true;
            $res['msg'] = 'Gagal! Hapus Data  Kamar';
        }
        return response()->json($res);
        
    }
    public function reservasi_index()
    {
        return view('admin.reservasi.index');
      
    }
    public function reservasi_ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = Reservasi::all()->unique('code_reservasi');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if ($row->status == "waiting") {
                        return '<span class="btn btn-warning"> Proses</span>';
                    }else if($row->status == "check_in"){
                        return '<span class="btn btn-primary">Booked</span>';
                    }else{
                        return '<span class="btn btn-dark">Checkout</span>';
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }
    public function referral_store(Request $request)
    {
        $referral =   ReferralCode::create([
            'nama' => $request->nama,
            'code' => Str::upper(Str::random(5)),
            'disc' => $request->disc,
            'created_at' => Carbon::now()
        ]);

        
      
     
        if (!isset($referral->id)) {
            $res['success'] = false;
            $res['msg'] = 'Gagal Menambah Data Referral';
        }
        $res['success'] = true;
        $res['msg'] = 'Berhasil Menambah Data Referral';
        return response()->json($res);
       
    }
    public function referral_index()
    {
        return view('admin.referral_code.index');

    }
    public function referral_ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = ReferralCode::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button  id="edit_referral" data-id='.$row->id.' class="edit btn btn-success btn-sm">Edit</button> <button id="delete_referral" data-id='.$row->id.' class="delete btn btn-danger btn-sm">Delete</button>';
                    return $actionBtn;
                })
                ->addColumn('disc', function($row){
                return  "$row->disc %";
                })
             
                ->rawColumns(['action'])
                ->make(true);
        }
    }
     public function referral_edit($id)
    {
            $referral = ReferralCode::find($id);
        return view('admin.referral_code.modal.edit',compact('referral'));

    }
    public function referral_update(Request $request,$id)
    {
        $referral =   ReferralCode::where('id',$id)->update([
            'nama' => $request->nama,
            'disc' => $request->disc
        ]);

        if ($referral) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Update Data Referral';
        }else{
            $res['success'] = false;
            $res['msg'] = 'Gagal Update Data Referral';
        }
        return response()->json($res);
    }
    public function referral_delete($id)
    {
        $referral =   ReferralCode::find($id);
        if ($referral->delete()) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Hapus Data Referral';
        }else{
            $res['success'] = true;
            $res['msg'] = 'Gagal! Hapus Data Referral';
        }
        return response()->json($res);
    }
    public function tipe_kamar_index()
    {
        return view('admin.tipe_kamar.index');
       
    }
    public function tipe_kamar_ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = TipeKamar::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $actionBtn = '<button id="edit_tipe_kamar" data-id='.$row->id.' class="edit btn btn-success btn-sm">Edit</button> <button id="delete_tipe_kamar" data-id='.$row->id.' class="delete btn btn-danger btn-sm">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function tipe_kamar_store(Request $request)
    {
        
        $tipe_kamar =   TipeKamar::create([
            'nama_tipe' => $request->nama_tipe,
            'luas' => $request->luas,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now()
        ]);


        if (!isset($tipe_kamar->id)) {
            $res['success'] = false;
            $res['msg'] = 'Gagal Menambah Data Tipe Kamar';
        }
        $res['success'] = true;
        $res['msg'] = 'Berhasil Menambah Data Tipe Kamar';
        return response()->json($res);


    }
    public function tipe_kamar_edit($id)
    {
        $tipe_kamar = TipeKamar::find($id);
        return view('admin.tipe_kamar.modal.edit',compact('tipe_kamar'));
    }
    public function tipe_kamar_update(Request $request,$id)
    {
          
        $tipe_kamar =   TipeKamar::where('id',$id)->update([
            'nama_tipe' => $request->nama_tipe,
            'luas' => $request->luas,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now()
        ]);

        if ($tipe_kamar) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Update Data Tipe Kamar';
        }else{
            $res['success'] = false;
            $res['msg'] = 'Gagal Update Data Tipe Kamar';
        }
        return response()->json($res);


    }
    public function tipe_kamar_delete($id)
    {
        $tipe_kamar = TipeKamar::find($id);
       $kamar = Kamar::where('tipe_kamar_id',$id)->get();
       foreach ($kamar as $key => $value) {
           $kamar_id[] = $value['id'];
        }
        $reservasi = Reservasi::whereIn('kamar_id',$kamar_id)->get();
        foreach ($reservasi as $key => $value) {
            $reservasi_kamar_id[] = $value['kamar_id'];
           }
        if ($reservasi->isEmpty()) {
            // return response()->json('trueh');
             Kamar::where('tipe_kamar_id',$id)->delete();
        }else{
            // return response()->json($kamar);
             Reservasi::whereIn('kamar_id',$reservasi_kamar_id)->delete();
             Kamar::where('tipe_kamar_id',$id)->delete();
        }

        if ($tipe_kamar->delete()) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Hapus Data Tipe Kamar';
        }else{
            $res['success'] = true;
            $res['msg'] = 'Gagal! Hapus Data Tipe Kamar';
        }
        return response()->json($res);

    }



    function removeElementWithValue($array, $key, $value){
        foreach($array as $subKey => $subArray){
            for ($i=0; $i < count($subArray) ; $i++) { 
                 if($subArray[$key] == $value){
                      unset($array[$subKey]);
                 }

            }
        }
        return $array;
   }
   
    public function test()
    {
      
    
     
        // dd($fasilitas);
    }
}
