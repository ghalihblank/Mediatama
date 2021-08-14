@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Content</h2>
</div>
<div class="pull-right">
<a class="btn btn-success" href="{{ route('content.create') }}"> Create New Content</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>No</th>
<th>Nama</th>
<th>Video</th>
<th width="80px">Request</th>
<th width="80px">Action</th>
</tr>
@foreach ($content2 as $x)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $x->nama }}</td>
    <td>{{ $x->video }}</td>
    <td>
        <form action="{{ route('content.approve',$x->id) }}" method="GET">
        <button type="submit" class="btn btn-warning">{{ $x->req }}</button>
        </form>
    </td>
    <td>
        <form action="{{ route('content.destroy',$x->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

@endsection