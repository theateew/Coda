<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', auth()->id())
            ->with('category')
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at')
            ->get();
        
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('notes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $note = Note::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Catatan berhasil dibuat!');
    }

    public function show(Note $note)
    {
        $this->authorize('view', $note);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        $categories = Category::where('user_id', auth()->id())->get();
        return view('notes.edit', compact('note', 'categories'));
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $note->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        $note->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Catatan berhasil dihapus!');
    }

    public function togglePin(Note $note)
    {
        $this->authorize('update', $note);
        $note->update(['is_pinned' => !$note->is_pinned]);

        return back()->with('success', $note->is_pinned ? 'Catatan di-pin!' : 'Catatan di-unpin!');
    }
}