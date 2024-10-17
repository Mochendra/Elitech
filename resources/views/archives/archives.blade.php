@extends('layouts.layouts')

@section('title', 'Arsip')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Arsip</h1>
    <p>*Pilih Tanggal dan Format terlebih dahulu ketika ingin mengunduh</p>

    <form action="{{ route('archives.downloadAll') }}" method="POST" class="mb-4" id="downloadForm">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="date" name="start_date" class="form-control" id="startDate" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4 mb-3">
                <input type="date" name="end_date" class="form-control" id="endDate" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 mb-4">
                <select name="format" class="form-control" id="format">
                    <option value="" disabled selected>Pilih</option>
                    <option value="xlsx">XLSX</option>
                    <option value="pdf">PDF</option>
                </select>
                <button type="submit" class="btn btn-success btn-block mt-2" id="downloadButton" disabled>Download dan Pilih Format</button>
            </div>
        </div>
    </form>
    
    <script>
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const formatSelect = document.getElementById('format');
        const downloadButton = document.getElementById('downloadButton');
    
        function validateForm() {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            const format = formatSelect.value;
    
    
            if (startDate && endDate && format) {
                downloadButton.disabled = false;
            } else {
                downloadButton.disabled = true;
            }
        }
    
       
        startDateInput.addEventListener('change', validateForm);
        endDateInput.addEventListener('change', validateForm);
        formatSelect.addEventListener('change', validateForm);
    </script>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
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
                                <span class="badge badge-info">Foto</span>
                            @elseif($post->media_type === 'video')
                                <span class="badge badge-warning">Video</span>
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>{{ $post->caption }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $posts->appends(request()->query())->links() }}
    </div>
</div>
@endsection