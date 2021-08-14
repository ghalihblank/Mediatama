<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Content;
use App\Models\Akses;
use DB;

class MateriController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user_id = $user->id;
        $materi = DB::table('Contents')
            ->leftjoin ('Akses', function($join)use ($user_id) {
                $join->on('Akses.video_id', '=', 'Contents.id');
                $join->where('Akses.user_id', '=', $user_id);
                })
            ->select('Contents.id', 
            'Contents.nama', 
            'Contents.video',
            'Akses.status',
            DB::raw('sum(Akses.durasi) as durasi'))
            ->groupby('Contents.id', 
            'Contents.nama', 
            'Contents.video' ,
            'Akses.status',) 
            ->get();


        //dd($content2);
       return view('materi.index', compact('materi'))
       ->with('i', (request()->input('page', 1) - 1) * 5);
    } 
    

    public function show($id){
        $user = Auth::user();
        $user_id = $user->id;
        $materi= Content::leftjoin ('Akses', function($join)use ($user_id) {
            $join->on('Akses.video_id', '=', 'Contents.id');
            $join->where('Akses.user_id', '=', $user_id);
            })
            ->where('Contents.id','=',$id)
            ->select('Contents.id', 
                'Contents.nama', 
                'Contents.video',
                'Akses.status',
                DB::raw('sum(Akses.durasi) as durasi'))
            ->groupby('Contents.id', 
                'Contents.nama', 
                'Contents.video' ,
                'Akses.status',)
            ->first();
        
        //dd($materi);
        //$nama = $materi->nama;
        //dd($nama);

        return view('materi.show', compact('materi','user'));
    }


    public function request($id){
        $user = Auth::user();
        $user_id = $user->id;

        $akses = Akses::create([
            'user_id' => $user_id,
            'video_id' => $id,
            'status' => 'Request'
            ]);

        $akses->save();


        return redirect()->route('materi.index')
        ->with('success','Permintaan berhasil dibuat, silakan tunggu Approval Admin, terimakasih');  
    } 
}
