@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Content</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('content.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('content.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="nama" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>
            <div class="col-md-6">
                <input type="file" class="form-control" name="filename" required>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Upload') }}
                </button>
            </div>
        </div>
    </form>

@endsection