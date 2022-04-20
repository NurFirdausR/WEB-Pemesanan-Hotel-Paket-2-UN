<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Kamar;
use Yajra\Datatables\Datatables;
use Response;
use Illuminate\Support\Facades\DB;
 
// use Illuminate\Http\Response;
class ResepsionisController extends Controller
{
    public function dashboard_index()
    {
        return view('resepsionis.dashboard');
        # code...
    }
    public function reservasi_ajax(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->start_date)) {
                $data  = Reservasi::whereBetween('check_in',[$request->start_date,$request->end_date])->get()->unique('code_reservasi');

                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if ($row->status == 'waiting') {
                        $actionBtn = '<button  id="checkin_reservasi" data-id='.$row->code_reservasi.' class="edit btn btn-success btn-sm ml-2">Check In</button>   <button id="download_pdf" href="/resepsionis/reservasi/download/'.$row->id.'" data-id='.$row->id.' class="download btn btn-danger btn-sm ml-2">PDF</button>';
                    }elseif($row->status == "check_in"){
                        $actionBtn = '<button  id="checkout_reservasi" data-id='.$row->code_reservasi.' class="edit btn btn-danger btn-sm ml-2">Check out</button>  <button id="download_pdf" data-id='.$row->id.' class="download btn btn-danger btn-sm ml-2">PDF</button>';
                    }else{
                        $actionBtn = '<button id="download_pdf" data-id='.$row->id.' class="download btn btn-danger btn-sm ml-2">PDF</button>';
                    }
                  
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == "waiting") {
                        return '<span class="btn btn-warning"> Proses</span>';
                    }else if($row->status == "check_in"){
                        return '<span class="btn btn-primary">Booked</span>';
                    }else{
                        return '<span class="btn btn-dark">Checkout</span>';
                    }
                })
                ->rawColumns(['action','status'])
                ->make(true);
            }else{
                $data = Reservasi::all()->unique('code_reservasi');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if ($row->status == 'waiting') {
                        $actionBtn = '<button  id="checkin_reservasi" data-id='.$row->code_reservasi.' class="edit btn btn-success btn-sm ml-2">Check In</button>   <button id="download_pdf" href="/resepsionis/reservasi/download/'.$row->id.'" data-id='.$row->id.' class="download btn btn-danger btn-sm ml-2">PDF</button>';
                    }elseif($row->status == "check_in"){
                        $actionBtn = '<button  id="checkout_reservasi" data-id='.$row->code_reservasi.' class="edit btn btn-danger btn-sm ml-2">Check out</button>  <button id="download_pdf" data-id='.$row->id.' class="download btn btn-danger btn-sm ml-2">PDF</button>';
                    }else{
                        $actionBtn = '<button id="download_pdf" data-id='.$row->id.' class="download btn btn-danger btn-sm ml-2">PDF</button>';
                    }
                  
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    if ($row->status == "waiting") {
                        return '<span class="btn btn-warning"> Proses</span>';
                    }else if($row->status == "check_in"){
                        return '<span class="btn btn-primary">Booked</span>';
                    }else{
                        return '<span class="btn btn-dark">Checkout</span>';
                    }
                })
                ->rawColumns(['action','status'])
                ->make(true);
            }
        }
    }
    public function reservasi_check_in(Request $request,$id)
    {

       

        $reservasi = Reservasi::where('code_reservasi',$id)->get();
        
        foreach ($reservasi as $key => $value) {
            $kamar_id[] = $value['kamar_id'];

        }
        $reservasi_status = Reservasi::where('code_reservasi',$id)->update([
            'status' => 'check_in'
        ]);
        $kamar_status =  Kamar::whereIn('id',$kamar_id)->update([
            'status' => 'booked'
        ]);



        
        if ($reservasi_status && $kamar_status) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Check in';
        }else{
            $res['success'] = false;
            $res['msg'] = 'Gagal Check in';
        }
        return response()->json($res);
        
    }

    public function reservasi_check_out(Request $request,$id)
    {

        
        // $code_reservasi =  Reservasi::where('id',$id)->first()->code_reservasi;
        $reservasi = Reservasi::where('code_reservasi',$id)->get();
        
        foreach ($reservasi as $key => $value) {
            $kamar_id[] = $value['kamar_id'];

        }
        $reservasi_status = Reservasi::where('code_reservasi',$id)->update([
            'status' => 'check_out'
        ]);
        $kamar_status =  Kamar::whereIn('id',$kamar_id)->update([
            'status' => 'unbooked'
        ]);




        if ($reservasi_status && $kamar_status) {
            $res['success'] = true;
            $res['msg'] = 'Berhasil Check in';
        }else{
            $res['success'] = false;
            $res['msg'] = 'Gagal Check in';
        }

        return response()->json($res);
        
        # code...
    }

    public function downloadfile($id)
    {   
        // session()->flush();
        $fileName = Reservasi::find($id)->bukti_reservasi;
        
        $path = public_path('pdf');
        $pathToFile = $path . '/' . $fileName;
      
        return Response::make(file_get_contents($pathToFile), 200, [
          'Content-Type' => 'application/pdf',
          'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ]);
    }





    public function kamar_ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = Kamar::latest()->get()->unique('code_kamar');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if ($row->status == "process") {
                        $actionBtn = '<button id="cancel" data-code='.$row->code_kamar.'  data-id='.$row->id.' class="btn btn-danger btn-sm ml-2">Cancel</button>';
                    }else{
                        $actionBtn = '';
                    }

                    return $actionBtn;
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
                ->addColumn('pemesan', function($row){
                    // return $row->reservasi->where('status','waiting');
                    if ($row->reservasi->where('status','waiting')->isEmpty()) {
                        # code...
                        return 'Belum Di Pesan';
                    }else{

                        return $row->reservasi->where('status','waiting')->first()->nama_pemesan;
                    }
                    // dd($row);
                })

               

               
                
                ->rawColumns(['action','status','gambar'])
                ->make(true);
        }
    }
    public function cancel_kamar(Request $request,$id)
    {



        $kamar = Kamar::where('id',$id);
        $kamar_code = Kamar::where('code_kamar',$request['kamar_code']);

        // dd();

        $reservasi_id = $kamar->first()->reservasi->where('status','waiting')->first();
        $reservasi = Reservasi::where('kamar_id',$id)->where('status','waiting')->get();
        // return response()->json();

        // if (!$reservasi_id) {
            
        //     return response()->json('tidak ada reservasi');
        
       

        // }else{
        //     return response()->json($reservasi_id->id);
        
        // }

        if (!$reservasi_id) {
            $kamar_code->update([
                'status' => 'unbooked'
            ]);
        }else{
            Reservasi::where('id',$reservasi_id->id)->delete();

            $kamar_code->update([
                'status' => 'unbooked'
            ]);
            
        }
        $res['success'] = true;
        $res['msg'] = 'Berhasil Cancel';
        return response()->json($res);
       
    }
    
}
