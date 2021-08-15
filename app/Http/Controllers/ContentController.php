<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Content;
use App\Models\Akses;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class ContentController extends Controller
{
    public function index(){
        $content = Content::latest()->paginate(5);


        $content2 = DB::table('Contents')
            ->leftjoin ('Akses', function($join){
                $join->on('Akses.video_id', '=', 'Contents.id');
                $join->where('Akses.status', '=', 'Request');
                })
            ->select('Contents.id', 
            'Contents.nama', 
            'Contents.video', 
            DB::raw('count(Akses.id) as req'))
            ->groupby('Contents.id', 
            'Contents.nama', 
            'Contents.video', ) 
            ->get();


        //dd($content2);
       return view('content.index', compact('content2'))
       ->with('i', (request()->input('page', 1) - 1) * 5);


    }    
 
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        return view('content.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {       
        $request->validate([
            'filename' => 'required',
        ]);
        if ($request->hasfile('filename')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('filename')->getClientOriginalName());
            $request->file('filename')->move('video/', $filename);
             Content::create(
                    [     
                        'nama' =>$request->nama,                   
                        'video' =>$filename
                    ]
                );
            return redirect()->route('content.index')
                ->with('success','Content upload successfully');
        }else{
            return redirect()->route('content.index')
                ->with('gagal','Content upload failed');
        }
        

       
    }
    

    /**
    * Display the specified resource.
    *
    * @param  \App\Content  $content
    * @return \Illuminate\Http\Response
    */
    public function approve(Request $request, $id){
        $content = Content::findorfail($id)
            ->leftjoin ('Akses', function($join) {
                $join->on('Akses.video_id', '=', 'Contents.id');
                })
            ->leftjoin ('Users', function($join) {
                $join->on('Akses.user_id', '=', 'Users.id');
                })
            ->where([
                ['Akses.status', '=', 'request'],
                ['Contents.id', '=', $id],
                ])
            ->select('Akses.id', 
                'Contents.nama', 
                'Contents.video', 
                'Users.name',
                'Akses.status',
                'Akses.durasi')
            ->get();
            //dd($content);

        DB::statement("CREATE TEMPORARY TABLE IF NOT EXISTS tmpContent (
            id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nama varchar(200),
            video varchar(200),
            nama_user varchar(60),
            status_request varchar(50),
            durasi integer
            )");

        foreach($content as $a => $s)
        {
            DB::insert(DB::raw("INSERT INTO tmpContent
            (id, nama, video, nama_user, status_request, durasi)
            values (
                '".$s['id']."',
                '".$s['nama']."',
                '".$s['video']."',
                '".$s['name']."',
                '".$s['status']."',
                '".$s['durasi']."'
                )"
            ));
        }

        $content2 = DB::table('tmpContent')->get();
        //dd($content2);
        $i = 0;
        return view('content.show',compact('content2', 'i'));
        DB::unprepared( DB::raw( "DROP TEMPORARY TABLE tmpContent" ) );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Content  $content
    * @return \Illuminate\Http\Response
    */
    public function edit(Content $content){
        return view('content.edit',compact('content'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Content  $content
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Content $content){
        request()->validate([
        'nama' => 'required',
        'video' => 'required',
        ]);
        $content->update($request->all());
        return redirect()->route('content.index')
        ->with('success','Content updated successfully');
    }

    public function acc($id){
        $akses = Akses::find($id);
        $akses->status = 'Approve';
        $akses->save();

        return redirect()->route('content.index')
            ->with('success','Request approved successfully');
    }

    public function decline($id){
        $akses = Akses::find($id);
        $akses->status = 'Decline';
        $akses->save();

        return redirect()->route('content.index')
            ->with('success','Request declined successfully');
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Content  $content
    * @return \Illuminate\Http\Response
    */
    public function destroy($id){
        $content = Content::findorfail($id)->delete();
        return redirect()->route('content.index')
            ->with('success','Content deleted successfully');
    }
}
