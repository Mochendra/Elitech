<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Post::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Media Type',
            'Date Posted',
            'Caption',
        ];
    }

    public function map($post): array
    {
        return [
            $post->id,
            $post->media_type,
            $post->created_at->format('Y-m-d'),
            $post->caption,
        ];
    }
}