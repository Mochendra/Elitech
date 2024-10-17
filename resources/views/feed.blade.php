@extends('layouts.layouts')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2"> 
                @foreach ($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <h5 class="card-title mb-0">{{ $post->user->name }}</h5>
                            </div>

                            <div class="media-container mb-3">
                                @if ($post->media_type === 'image')
                                    <img src="{{ asset('storage/' . $post->media_path) }}" class="img-fluid" alt="Post Image">
                                @elseif($post->media_type === 'video')
                                    <video controls class="img-fluid">
                                        <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            <p class="card-text">{{ $post->content }}</p>
                          
                            <button class="btn p-0" onclick="likePost({{ $post->id }})" style="background: none; border: none; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 24 24" id="like-icon-{{ $post->id }}">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" class="like-path"/>
                                </svg>
                            </button>
                            <span class="ml-2" id="likes-count-{{ $post->id }}">{{ $post->likes_count }} Likes</span>

                      
                            <h6 class="mt-3">Komentar:</h6>
                            @foreach ($post->comments as $comment)
                                <div class="mb-2">
                                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                                </div>
                            @endforeach

                           
                            <form action="{{ route('comments.store', $post) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" rows="2" placeholder="Tambahkan komentar..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Kirim Komentar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
       <script>
    function likePost(postId) {
        fetch(`/posts/${postId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const likesCountElement = document.getElementById(`likes-count-${postId}`);
            const likeIconElement = document.getElementById(`like-icon-${postId}`);
            
            if (likesCountElement) {
                likesCountElement.textContent = `${data.likes_count} Likes`;
            }

            // Ubah warna ikon berdasarkan status like
            if (likeIconElement) {
                if (data.action === 'liked') {
                    likeIconElement.querySelector('.like-path').setAttribute('fill', 'red'); // Ubah warna menjadi merah saat liked
                } else {
                    likeIconElement.querySelector('.like-path').setAttribute('fill', 'currentColor'); // Kembalikan ke warna default
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endsection