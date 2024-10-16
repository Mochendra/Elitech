<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;
use PDF;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Post::query();

    //     if ($request->filled('start_date') && $request->filled('end_date')) {
    //         $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    //     }

    //     $posts = $query->paginate(10);

    //     return view('archives.archives', compact('posts'));
    // }

    public function show($id)
    {
        // Mengambil semua post untuk user dengan ID tertentu
        $posts = Post::where('user_id', $id)->paginate(10);

        return view('archives.archives', compact('posts', 'id'));
    }

    public function archives(Request $request)
    {
        $query = Post::query();

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
        $data = Post::all(); // Replace with your model
    
        $filename = "posts_" . date("Y-m-d_H-i-s") . ".xlsx";
    
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    
        // Create a new PhpSpreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    
        // Set the worksheet
        $worksheet = $spreadsheet->getActiveSheet();
    
        // Set the header row
        $worksheet->setCellValue('A1', 'Media Type');
        $worksheet->setCellValue('B1', 'Date Posted');
        $worksheet->setCellValue('C1', 'Caption');
    
        // Check if $data is empty
        if ($data->isEmpty()) {
            echo "Data is empty!";
            exit;
        }
    
        // Loop through the data
        $rowIndex = 2; // Start from row 2, since row 1 is the header
        foreach ($data as $row) {
            $mediaType = $row->media_type; // Get media type directly from the database
            $mediaTitle = ''; // Initialize media title
    
            // Determine the media title based on media type
            if ($mediaType === 'image' && !empty($row->photo)) {
                $mediaTitle = $row->photo_title; // Assuming the title is stored in $row->photo_title
            } elseif ($mediaType === 'video' && !empty($row->video)) {
                $mediaTitle = $row->video_title; // Assuming the title is stored in $row->video_title
            } else {
                $mediaTitle = 'No media available'; // Fallback if no media found
            }
    
            // Write the data row with the media type, date, and content as caption
            $worksheet->setCellValue('A' . $rowIndex, $mediaType);
            $worksheet->setCellValue('B' . $rowIndex, date('Y-m-d', strtotime($row->created_at)));
            $worksheet->setCellValue('C' . $rowIndex, $row->content); // Use content from posts table as caption
    
            $rowIndex++; // Increment the row index
        }
    
        // Write the XLSX file to the output stream
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    
        exit; // Ensure the script stops after outputting the XLSX
    }
}
