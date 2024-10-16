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
            return Excel::download(new PostsExport($posts), 'all_posts.xlsx');
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('exports.posts_pdf', compact('posts'));
            return $pdf->download('all_posts.pdf');
        } elseif ($format === 'zip') {
            $zip = new ZipArchive;
            $fileName = 'all_posts.zip';
            
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                foreach ($posts as $post) {
                    $pdf = PDF::loadView('exports.post_pdf', ['post' => $post]);
                    $zip->addFromString('post_'.$post->id.'.pdf', $pdf->output());
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
    


}

 
    

