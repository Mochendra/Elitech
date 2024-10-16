<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Archive</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Posts Archive</h1>
    <table>
        <thead>
            <tr>
                <th>Date Posted</th>
                <th>Caption</th>
                <th>Media Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                <td>{{ $post->caption }}</td>
                <td>{{ $post->media_type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>