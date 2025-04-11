<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\tblpesertaEvent;

class EventController extends Controller
{
    public function ShowEvent()
    {
        $data_event = DB::table('tblevents')
                    ->orderByDesc('date_event')
                    ->get();
                    
        return view('Event',['data_event' => $data_event]);
    }

    public function Detail_Event($id)
    {
        $data_event = DB::table('tblevents')
                    ->where('id', $id)
                    ->first();
                    
        return view('Detail_Event',['data_event' => $data_event]);
    }

    public function Joint_Event($id){
    
        $data_event = DB::table('tblevents')
                    ->where('id', $id)
                    ->first();
        //dd($data_event);            
        return view('Joint_Event',['data_event' => $data_event]);
    }

    public function Save_Joint_Event(request $request){
        //dd($request);
        $save_joint_event = new tblpesertaEvent();
        $save_joint_event->name_event=$request->name_event;
        $save_joint_event->nama_peserta =$request->nama_peserta ;
        $save_joint_event->email_peserta=$request->email_peserta;
        $save_joint_event->no_HP=$request->no_HP;
        $save_joint_event->alamat_peserta=$request->alamat_peserta;
        $save_joint_event->status_pembanyaran=$request->tiket;
        $save_joint_event->save();

        return redirect('/Event')->with('success', 'Berhasil Mendaftar Event');
    }
}