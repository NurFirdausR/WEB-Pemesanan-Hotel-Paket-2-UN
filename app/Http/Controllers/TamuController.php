<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\Reservasi;
use App\Models\TipeKamar;
use Illuminate\Support\Collection;
use App\Models\Kamar;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use PDF;
use Response;
use Storage;
use Str;
use Illuminate\Support\Facades\Session;
class TamuController extends Controller
{
    public function home()
    {
   
        $kamar = Kamar::all()->unique('code_kamar')->take(3);
        return view('guest/home',compact('kamar'));
    }
    public function kamar()
    {
        $tipe_kamar = TipeKamar::all();
        // foreach ($tipe_kamar as $key ) {
            $tipe = Kamar::all()->unique('tipe_kamar_id');
        // }
        // dd($tipe);


        return view('guest/kamar',compact('tipe'));
    }
    public function detail_kamar($id)
    {
        $kamar = Kamar::where('tipe_kamar_id',$id)->get()->unique('code_kamar');
        // dd($kamar);

        return view('guest/kamar_all',compact('kamar'));
    }
    public function fasilitas()
    {
        $fasilitas = Fasilitas::all();
        return view('guest/fasilitas',compact('fasilitas'));
    }
    public function contact()
    {
        return view('guest/contact');
    }


    public function pesan_store(Request $request)
    {   
        // dd($request);
     

        $request->session()->put('range', $request->range != null ? $request->range : '');
        $request->session()->put('jumlah_tamu', $request->jumlah_tamu  != null ? $request->jumlah_tamu : '');
        return response()->json(['msg' => 'success']);
    }

    public function pemesanan_step_one(Request $request)
    {
        // dd($request->session()->get('range'));
        // $request->session()->flush();

        if (empty($request->session()->get('range')) &&  empty($request->session()->get('jumlah_tamu')) && empty($request->session()->get('tipe_kamar'))) {
            $check_in = '';
            $check_out = '';
            $jumlah_tamu = '';
            $tipe_kamar = '';
        }else{
            $arr        =  explode(' - ',$request->session()->get('range'));
            $check_in = Carbon::parse($arr[0])->format('Y-m-d');
            $check_out = Carbon::parse($arr[1])->format('Y-m-d');

            $jumlah_tamu = $request->session()->get('jumlah_tamu');
            $tipe_kamar = $request->session()->get('tipe_kamar');
        }
        $tipe_kamar_all = TipeKamar::all();
     
          // $request->session()->forget('range','jumlah_tamu','jumlah_malam','tipe_kamar','cart_kamar');
  
      
        return view('guest/pemesanan_step_one',compact('check_in','check_out','jumlah_tamu','tipe_kamar','tipe_kamar_all'));

    }
    

    public function pemesanan_step_one_store(Request $request)
    {
                // $request->session()->put('jumlah_tamu', $request->jumlah_tamu );

                $request->session()->put('range', $request->range);
                $request->session()->put('jumlah_tamu', $request->jumlah_tamu );
                $request->session()->put('jumlah_malam', $request->jumlah_malam);
                $request->session()->put('tipe_kamar', $request->tipe_kamar);

         


        return response()->json('success');


    }

  
    public function pemesanan_step_two(Request $request)
    {
        // dd($request->session()->all());
        // dd(empty($request->session()->get('jumlah_tamu')));

   

     if(empty($request->session()->get('range')) && empty($request->session()->get('jumlah_tamu')) && empty($request->session()->get('jumlah_malam')) && empty($request->session()->get('tipe_kamar'))){
        $check_in = '';
        $check_out = '';
        $jumlah_tamu  =  '';
        $jumlah_malam  =  '';
        $tipe_kamar  =  '';
       
        $kamar_get = Kamar::where('status','unbooked')->whereOr('maks_orang','>=',$jumlah_tamu)->where('tipe_kamar_id',$tipe_kamar)->get();
        $kamar = $kamar_get->collect()->unique('nama_kamar');
     }  else{
        $arr        =  explode(' - ',$request->session()->get('range'));
        $check_in = Carbon::parse($arr[0])->format('Y-m-d');
        $check_out = Carbon::parse($arr[1])->format('Y-m-d');
        $jumlah_tamu  =  $request->session()->get('jumlah_tamu');
        $jumlah_malam  =  $request->session()->get('jumlah_malam');
        $tipe_kamar  =  $request->session()->get('tipe_kamar');

        $kamar_get = Kamar::where('status','unbooked')->where('maks_orang','>=',$jumlah_tamu)->where('tipe_kamar_id',$tipe_kamar)->get();
        $kamar = $kamar_get->collect()->unique('code_kamar');

     }
    
    return view('guest/pemesanan_step_two',compact('check_in','check_out','jumlah_tamu','jumlah_malam','kamar'));


    }
    public function pemesanan_step_two_store(Request $request)
    {
        $code_kamar = Kamar::find($request->kamar_id)->code_kamar;
        Kamar::where('code_kamar',$code_kamar)->update([
            'status' => 'process'
        ]);
        
        if (empty($request->session()->get('cart_kamar'))) {
                $request->session()->put('cart_kamar', []);
                  $request->session()->push('cart_kamar', $request->kamar_id);
            }else{
                $request->session()->push('cart_kamar', $request->kamar_id);

            }
            return response()->json('success');
        
       

    }
    public function pemesanan_step_three(Request $request)
    {
        // dd($request->session()->all());
     
        if(empty($request->session()->get('range')) && empty($request->session()->get('jumlah_tamu')) && empty($request->session()->get('jumlah_malam')) && empty($request->session()->get('tipe_kamar')) && empty($request->session()->get('cart_kamar'))){
            $check_in = '';
            $check_out = '';
            $jumlah_tamu  =  '';
            $jumlah_malam  =  '';
            $cart_kamar  =  [];
            $tipe_kamar  =  '';
           
            $kamar_get = Kamar::where('status','unbooked')->whereOr('maks_orang','>=',$jumlah_tamu)->where('tipe_kamar_id',$tipe_kamar)->get();
            $kamar = $kamar_get->collect()->unique('nama_kamar');
         }  else{
            $arr        =  explode(' - ',$request->session()->get('range'));
            $check_in = Carbon::parse($arr[0])->format('Y-m-d');
            $check_out = Carbon::parse($arr[1])->format('Y-m-d');
            $jumlah_tamu  =  $request->session()->get('jumlah_tamu');
            $jumlah_malam  =  $request->session()->get('jumlah_malam');
            $cart_kamar  =  $request->session()->get('cart_kamar');
            $tipe_kamar  =  $request->session()->get('tipe_kamar');
            
            if (!$cart_kamar) {
                # code...
                $kamar = '';
            }else{
                $kamar = Kamar::whereIn('id',$cart_kamar)->get();

            }
            // $kamar_ = Kamar::where('status','unbooked')->whereOr('maks_orang','>=',$jumlah_tamu)->where('tipe_kamar_id',$tipe_kamar)->get();
    
         }
        //  dd(session()->get('cart_kamar'));
        
        return view('guest/pemesanan_step_three',compact('check_in','check_out','jumlah_tamu','jumlah_malam','kamar','cart_kamar'));
    
    
        // dd($request->session()->all());
        


    }
    public function pemesanan_step_three_store(Request $request)
    {
        $arr        =  explode(' - ',$request->session()->get('range'));
        $kamar = $request->session()->get('cart_kamar');
        $check_in = Carbon::parse($arr[0])->format('Y-m-d');
        $check_out = Carbon::parse($arr[1])->format('Y-m-d');
        $request->session()->put('total_harga', $request->total_harga);
       
        $code = Str::random(5);

        foreach ($kamar as $key => $value) {
            $reservasi = Reservasi::create([
             'nama_pemesan' => $request->nama_pemesan,
             'email' => $request->email,
             'no_telpon' => $request->no_telp,
             'code_reservasi' => $code,
             'check_in' => $check_in,
             'check_out' => $check_out,
             'status' => 'waiting',
             'kamar_id' => $value
             ]);
        }
        
        // $pdf =  PDF::loadView('reservasi');
        // $path = public_path('pdf/');
        // $fileName =  time().'|'.$reservasi->id.'.'. 'pdf' ;
        // $pdf->save($path . '/' . $fileName);

        // $pdf = PDF::loadView('pdf.orderConfirmationPdf', $data)->save(''.$path.'/'.$filename.'.pdf');
        return response()->json([
            'data' => $reservasi->code_reservasi,
            'msg' => 'success'
      ]);


      


    }

   public function download_pdf($id)
   {
    $reservasi = Reservasi::where('code_reservasi',$id)->get();
    // $kamar_cart = explode(',',$reservasi->kamar_id);
    foreach ($reservasi as $key ) {
        $kamar_id[] = $key->kamar_id; 
    }
    $kamars = Kamar::whereIn('id',$kamar_id)->get();

  $total_harga =   session()->get('total_harga');


    $pdf =  PDF::loadView('reservasi',compact('reservasi','kamars','total_harga'));
    $path = public_path('pdf/');
    $fileName =  time().'.'. 'pdf' ;
    
    $pdf->save($path . '/' . $fileName);
    
    $pathToFile = $path . '/' . $fileName;
    $reservasi = Reservasi::where('code_reservasi',$id)->update([
        'bukti_reservasi' => $fileName
    ]);
    session()->flush();
  
    return Response::make(file_get_contents($pathToFile), 200, [
      'Content-Type' => 'application/pdf',
      'Content-Disposition' => 'inline; filename="'.$fileName.'"'
    ]);
   }

}
