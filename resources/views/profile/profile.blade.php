@extends('layouts.layouts')

@section('title', 'Profile')

@section('content')
    <div class="row" style="width:100%">

        
        <div>
            <div>
                <div class="card-body">
                    @if (auth()->check())
                        <h5 class="card-title text-center">Profil Pengguna</h5>

                        <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('path/to/default/profile_picture.jpg') }}"
                        alt="Profile Picture" class="rounded-circle mx-auto d-block" style="width: 100px; height: 100px;">

                        <h6 class="text-center">{{ auth()->user()->name }}</h6>
                        <p class="text-center">{{ auth()->user()->bio ?? 'Bio tidak tersedia.' }}</p>

                 
                        <button class="btn btn-primary d-block mx-auto mb-3" data-toggle="modal"
                            data-target="#editProfileModal">Edit Profil</button>

                        <h6>Postingan Anda:</h6>

                        @if (isset($posts))
                            <p>Jumlah postingan: {{ $posts->count() }}</p>

                          
                            @php
                                $feeds_per_row = auth()->user()->setting->feeds_per_row ?? 3; 
                            @endphp

                            <div class="row">
                                @forelse($posts as $post)
                                    <div class="col-md-{{ 12 / $feeds_per_row }} mb-3"> 
                                        <div class="card">
                                            <div class="card-body">
                                                @if ($post->media_type === 'image')
                                                    <img src="{{ asset('storage/' . $post->media_path) }}" class="img-fluid"
                                                        alt="Post Image">
                                                @elseif($post->media_type === 'video')
                                                    <video controls class="img-fluid">
                                                        <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                                    </video>
                                                @endif
                                                <p class="card-text">Caption :{{ $post->caption }}</p>
                                              
                                                 <p class="card-text">Likes: {{ $post->likes_count }}</p>
                                                <p class="card-text"><small class="text-muted">Di upload
                                                        {{ $post->created_at->format('M d, Y') }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>Tidak ada postingan.</p>
                                @endforelse
                            </div>
                        @else
                            <p>Variabel $posts tidak tersedia</p>
                        @endif
                    @else
                        <p>Pengguna tidak ditemukan atau Anda belum login.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
            
            <div class="form-group">
              <label for="profile_image">Foto Profil</label>
              <input type="file" class="form-control-file" id="profile_image" name="profile_image">
            </div>
  
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
            </div>
  
            <div class="form-group">
              <label for="bio">Bio</label>
              <textarea class="form-control" id="bio" name="bio" rows="3">{{ Auth::user()->bio }}</textarea>
            </div>
  
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
