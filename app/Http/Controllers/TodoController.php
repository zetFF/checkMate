<?php
// Mendefinisikan namespace untuk controller ini
namespace App\Http\Controllers;

// Mengimpor model Todo dan Request dari Laravel
use App\Models\Todo;
use Illuminate\Http\Request;

// Mendefinisikan class TodoController yang meng-extend Controller
class TodoController extends Controller
{
    // Method untuk menampilkan daftar todo dengan fitur pencarian
    public function index(Request $request)
    {
        // Membuat query builder untuk model Todo
        $query = Todo::query();
        
        // Jika ada parameter search, tambahkan kondisi pencarian
        if ($request->has('search')) {
            $search = $request->search;
            // Mencari todo berdasarkan nama atau deskripsi
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
        }
        
        // Mengambil data todo terbaru dan mengirim ke view
        $todos = $query->latest()->get();
        return view('todos.index', compact('todos'));
    }

    // Method untuk menyimpan todo baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        // Membuat todo baru dan redirect ke halaman index
        Todo::create($request->all());
        return redirect()->route('todos.index')->with('success', 'Todo berhasil ditambahkan!');
    }

    // Method untuk mengupdate todo yang ada
    public function update(Request $request, Todo $todo)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        // Update todo dan redirect ke halaman index
        $todo->update($request->all());
        return redirect()->route('todos.index')->with('success', 'Todo berhasil diperbarui!');
    }

    // Method untuk menghapus todo
    public function destroy(Todo $todo)
    {
        // Menghapus todo dan redirect ke halaman index
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Todo berhasil dihapus!');
    }

    // Method untuk toggle status complete todo
    public function toggleComplete(Todo $todo)
    {
        // Mengubah status is_completed menjadi kebalikannya
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);
        return response()->json(['success' => true]);
    }
}