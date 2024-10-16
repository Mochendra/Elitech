<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;
use PDF;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class ArchiveController extends Controller
{

    public function show($id)
    {
        // Mengambil semua post untuk user dengan ID tertentu
        $posts = Post::where('user_id', $id)->paginate(10);

        return view('archives.archives', compact('posts', 'id'));
    }

    public function archives(Request $request)
{
    $query = Post::query();

    // Debug untuk mengecek input tanggal
    dd($request->start_date, $request->end_date);

    if ($request->has('start_date') && $request->has('end_date')) {
        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    }

    $posts = $query->paginate(10);

    return view('archives.index', compact('posts'));
}


public function downloadAll(Request $request)
{
    $format = $request->input('format', 'xlsx');
    $query = Post::query();

    // Check if both start_date and end_date are provided
    if ($request->has('start_date') && $request->has('end_date')) {
        // Use whereDate to filter posts based on the start and end date
        $query->whereDate('created_at', '>=', $request->start_date)
              ->whereDate('created_at', '<=', $request->end_date);
    }

    $posts = $query->get(); // Fetch posts based on the date range

    // Handle the export based on the selected format
    if ($format === 'xlsx') {
        return $this->exportToExcel($posts); // Pass the filtered posts to the export function
    } elseif ($format === 'pdf') {
        $pdf = PDF::loadView('exports.posts_pdf', compact('posts'));
        return $pdf->download('all_posts.pdf');
    } elseif ($format === 'zip') {
        return $this->exportToZip($posts); // New method to handle ZIP export
    }

    return back()->with('error', 'Invalid format selected.');
}

// Modify the exportToExcel method to accept filtered posts
public function exportToExcel($posts)
{
    $filename = "posts_" . date("Y-m-d_H-i-s") . ".xlsx";
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToBrowser($filename);

    $headerRow = WriterEntityFactory::createRowFromArray(['Media Type', 'Date Posted', 'Caption']);
    $writer->addRow($headerRow);

    if ($posts->isEmpty()) {
        $emptyRow = WriterEntityFactory::createRowFromArray(['No data available']);
        $writer->addRow($emptyRow);
    } else {
        foreach ($posts as $row) {
            $mediaType = $row->media_type;
            $mediaTitle = $mediaType === 'image' && !empty($row->photo) ? $row->photo_title : 
                          ($mediaType === 'video' && !empty($row->video) ? $row->video_title : 'No media available');

            $dataRow = WriterEntityFactory::createRowFromArray([
                $mediaType,
                date('Y-m-d', strtotime($row->created_at)),
                $row->content
            ]);

            $writer->addRow($dataRow);
        }
    }

    $writer->close();
}

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $posts = $query->paginate(10); // Pastikan ini adalah instance dari LengthAwarePaginator

        dd($posts); // Debugging untuk melihat isi posts

        return view('archives.archives', compact('posts'));
    }

}
