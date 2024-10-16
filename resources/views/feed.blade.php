@extends('layouts.layouts')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2"> <!-- Membuat konten utama lebih lebar -->
                @foreach ($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->user->name }}</h5> <!-- Nama Pengguna -->


                            <div class="media-container">
                                @if ($post->media_type === 'image')
                                    <img src="{{ asset('storage/' . $post->media_path) }}" class="img-fluid" alt="Post Image">
                                @elseif($post->media_type === 'video')
                                    <video controls class="img-fluid">
                                        <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            <p class="card-text">{{ $post->content }}</p> <!-- Caption -->
                            <button class="btn btn-primary mt-2" onclick="likePost({{ $post->id }})">Like</button>
                            <span class="ml-2" id="likes-count-{{ $post->id }}">{{ $post->likes_count }} Likes</span>

                            <!-- Tampilkan komentar -->
                            <h6>Komentar:</h6>
                            @foreach ($post->comments as $comment)
                                <div class="mb-2">
                                    <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                                </div>
                            @endforeach

                            <!-- Form untuk menambah komentar -->
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
                    console.log(data); // Tambahkan ini untuk debugging
                    const likesCountElement = document.getElementById(`likes-count-${postId}`);
                    if (likesCountElement) {
                        likesCountElement.textContent = `${data.likes_count} Likes`;
                    }

                    // Optional: Update button text based on action
                    const likeButton = document.querySelector(`button[onclick="likePost(${postId})"]`);
                    if (likeButton) {
                        likeButton.textContent = data.action === 'liked' ? 'Unlike' : 'Like';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
