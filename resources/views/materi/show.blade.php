@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lihat Materi</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('materi.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h4><strong>{{ $materi->nama }}</strong><h4>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                    {{ $materi->status }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Durasi:</strong>
                    {{ $materi->status }}
            </div>
        </div>

    @if ($materi->status=="") 
        <div class="col">
            <h3>Anda Tidak dapat melihat kontent ini, </br>
                silakan klik tombol request untuk mengajukan request melihat materi<h3>
            <div>
                <form action="{{ route('materi.request',$materi->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                            <button type="submit" class="btn btn-info">Request Lihat Materi</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>       
    @endif
    </div>
@endsection