@extends('layouts.layouts')

@section('title', 'Unggah Post')

@section('content')
<div class="card mx-auto" style="width: 400px;">
    <div class="card-body">
        <h5 class="card-title text-center">Unggah Post</h5>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="caption">Caption</label>
                <input type="text" class="form-control" name="caption" id="caption" required>
            </div>
            <div class="form-group">
                <label for="media">Upload Gambar/Video</label>
                <input type="file" class="form-control" name="media" id="media" accept=".jpg,.jpeg,.png,.mp4,.mov" required>
                <small class="form-text text-muted">Format: JPG/PNG/JPEG/MP4/MOV, Max: 150 MB</small>
            </div>
            <button type="submit" class="btn btn-success btn-block">Unggah</button>
        </form>
    </div>
</div>
@endsection
