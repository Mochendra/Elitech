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

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $posts = $query->get();

        if ($format === 'xlsx') {
            // Remove this line
            // return Excel::download(new PostsExport($posts), 'all_posts.xlsx');
            return $this->exportToExcel();
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.posts_pdf', compact('posts'));
            return $pdf->download('all_posts.pdf');
        } elseif ($format === 'zip') {
            $zip = new ZipArchive;
            $fileName = 'all_posts.zip';

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                foreach ($posts as $post) {
                    $pdf = PDF::loadView('exports.post_pdf', ['post' => $post]);
                    $zip->addFromString('post_' . $post->id . '.pdf', $pdf->output());
                }
                $zip->close();
            }

            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Invalid format selected.');
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

    public function exportToExcel()
{
    $data = Post::all(); // Ambil semua data dari model Post

    // Buat nama file untuk file XLSX
    $filename = "posts_" . date("Y-m-d_H-i-s") . ".xlsx";

    // Membuat writer untuk XLSX
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToBrowser($filename); // Output langsung ke browser untuk di-download

    // Membuat header untuk file Excel
    $headerRow = WriterEntityFactory::createRowFromArray(['Media Type', 'Date Posted', 'Caption']);
    $writer->addRow($headerRow); // Menambahkan header ke file XLSX

    // Periksa apakah data kosong
    if ($data->isEmpty()) {
        $emptyRow = WriterEntityFactory::createRowFromArray(['No data available']);
        $writer->addRow($emptyRow); // Jika data kosong, tambahkan pesan kosong
    } else {
        // Looping melalui data dan tambahkan ke Excel
        foreach ($data as $row) {
            $mediaType = $row->media_type;
            $mediaTitle = ''; // Inisialisasi judul media

            // Tentukan judul media berdasarkan tipe media
            if ($mediaType === 'image' && !empty($row->photo)) {
                $mediaTitle = $row->photo_title;
            } elseif ($mediaType === 'video' && !empty($row->video)) {
                $mediaTitle = $row->video_title;
            } else {
                $mediaTitle = 'No media available'; // Default jika tidak ada media
            }

            // Buat baris baru dengan tipe media, tanggal posting, dan caption
            $dataRow = WriterEntityFactory::createRowFromArray([
                $mediaType,
                date('Y-m-d', strtotime($row->created_at)),
                $row->content // Gunakan konten dari tabel post sebagai caption
            ]);

            $writer->addRow($dataRow); // Tambahkan baris ke file Excel
        }
    }

    // Tutup writer setelah selesai
    $writer->close();
}
}
