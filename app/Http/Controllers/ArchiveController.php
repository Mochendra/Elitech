<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostExport;
use PDF;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $posts = $query->paginate(10);

        return view('archives.archives', compact('posts'));
    }

    public function show($id)
    {
        // Mengambil semua post untuk user dengan ID tertentu
        $posts = Post::where('user_id', $id)->paginate(10);
        
        return view('archives.archives', compact('posts', 'id'));
    }

    public function download(Request $request)
    {
        $format = $request->input('format', 'xlsx');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Post::query();
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $posts = $query->get();

        if ($format === 'xlsx') {
            return Excel::download(new PostExport($posts), 'posts.xlsx');
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('archives.pdf', compact('posts'));
            return $pdf->download('posts.pdf');
        }

        return back()->with('error', 'Invalid format');
    }
}