<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $query = Note::where('user_id', $user->id)
            ->with('category')
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at');

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'title':
                    $query->orderBy('title');
                    break;
                case 'oldest':
                    $query->orderBy('created_at');
                    break;
            }
        }

        $notes = $query->paginate(12);
        $categories = Category::where('user_id', $user->id)->get();

        return view('dashboard', compact('notes', 'categories'));
    }
}