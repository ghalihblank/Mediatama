@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Daftar Request Content</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('content.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Status</th>
            <th width="80px">Approve</th>
            <th width="80px">Decline</th>
            </tr>
            @foreach ($content2 as $s=>$x)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $x->nama_user }}</td>
                <td>{{ $x->status_request }}</td>
                <td>
                    <form action="{{ route('content.acc',$x->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('content.tolak',$x->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Decline</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </table>
    </div>
@endsection
