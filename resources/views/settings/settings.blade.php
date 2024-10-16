@extends('layouts.layouts')

@section('title', 'Pengaturan')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Pengaturan</h5>
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="feeds_per_row">Jumlah Post per Baris</label>
                <input type="number" class="form-control" name="feeds_per_row" id="feeds_per_row" 
                       value="{{ $settings->feeds_per_row ?? 1 }}" required min="1" max="4">
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Pengaturan</button>
        </form>
    </div>
</div>
@endsection
