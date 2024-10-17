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
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="media" id="media" accept=".jpg,.jpeg,.png,.mp4,.mov" required>
                    <label class="custom-file-label" for="media">Choose file</label>
                </div>
                <small class="form-text text-muted">Format: JPG/PNG/JPEG/MP4/MOV, Max: 150 MB</small>
                <div id="preview-container" class="mt-3"></div>
            </div>
            <button type="submit" class="btn btn-success btn-block">Unggah</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('media').addEventListener('change', function() {
        const file = this.files[0];
        const previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = ''; 

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const mediaType = file.type.split('/')[0]; 
                let mediaElement;

                if (mediaType === 'image') {
                    mediaElement = document.createElement('img');
                    mediaElement.src = e.target.result;
                    mediaElement.classList.add('img-fluid'); 
                    mediaElement.style.maxWidth = '100%'; 
                } else if (mediaType === 'video') {
                    mediaElement = document.createElement('video');
                    mediaElement.src = e.target.result;
                    mediaElement.controls = true; 
                    mediaElement.classList.add('img-fluid');
                    mediaElement.style.maxWidth = '100%';
                }

                previewContainer.appendChild(mediaElement);
            }
            reader.readAsDataURL(file); 
        }
    });
</script>
@endsection