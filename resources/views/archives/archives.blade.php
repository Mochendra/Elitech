@extends('layouts.layouts')

@section('title', 'Arsip')

@section('content')
<div class="container">
    <h1>Archives</h1>

    <form action="{{ route('archives.archives') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Photo/Video</th>
                <th>Date Posted</th>
                <th>Caption</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>
                    @if ($post->media_type === 'image')
                    <img src="{{ asset('storage/' . $post->media_path) }}" class="img-fluid"
                        alt="Post Image">
                @elseif($post->media_type === 'video')
                    <video controls class="img-fluid">
                        <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                    </video>
                @endif
                </td>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                <td>{{ $post->caption }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $posts->links() }}

    <!-- Opsi Download -->
    <div class="mt-4">
        <form action="{{ route('archives.download') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="downloadFormat">Download Format:</label>
                    <select id="downloadFormat" name="format" class="form-control">
                        <option value="xlsx">XLSX</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success mt-4">Download Archive</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection