@extends('layouts.layouts')

@section('title', 'Arsip')

@section('content')
    <div class="container">
        <h1>Archives</h1>

        <form action="{{ route('archives.downloadAll') }}" method="POST" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4">
                    <select name="format" class="form-control">
                        <option value="xlsx">XLSX</option>
                        <option value="pdf">PDF</option>
                    </select>
                    <button type="submit" class="btn btn-success" style="margin-top:10%;">Download All</button>
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
                                Foto
                            @elseif($post->media_type === 'video')
                                Video
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>{{ $post->caption }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $posts->appends(request()->query())->links() }}
    </div>
@endsection