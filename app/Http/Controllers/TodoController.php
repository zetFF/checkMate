<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Todo::query();
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        }
        
        $todos = $query->latest()->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        Todo::create($request->all());
        return redirect()->route('todos.index')->with('success', 'Todo berhasil ditambahkan!');
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        $todo->update($request->all());
        return redirect()->route('todos.index')->with('success', 'Todo berhasil diperbarui!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Todo berhasil dihapus!');
    }

    public function toggleComplete(Todo $todo)
    {
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);
        return response()->json(['success' => true]);
    }
} 