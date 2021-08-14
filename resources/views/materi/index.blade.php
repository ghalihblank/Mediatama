@extends('layouts.app')

@section('content')
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table id="tbl-materi" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Materi</th>
                <th>Status</th>
                <th>Durasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materi as $x)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><a href= "{{Route('materi.show', $x->id)}}">{{ $x->nama }}</a></td>
                    <td>{{ $x->status }}</td>
                    <td>{{ $x->durasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection