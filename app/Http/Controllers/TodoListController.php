<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $todo_list = TodoList::all();
        $title = 'Todo List';
        return view('todo_list', compact('todo_list', 'title'));
    }

    public function store(Request $request)
    {
        TodoList::create([
            'nama' => $request->nama,
            'prioritas' => $request->prioritas,
            'status' => 'belum selesai',
            'tgl_ditambahkan' => now(),
        ]);

        return redirect('/')->with('success', 'Todo list berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $todo_list = TodoList::findOrFail($id);

        $todo_list->update([
            'nama' => $request->nama,
            'prioritas' => $request->prioritas
        ]);

        return redirect('/')->with('success', 'Todo list berhasil diupdate');
    }

    public function Done($id)
    {
        $todo = TodoList::findOrFail($id);
        $todo->status = 'selesai';
        $todo->tgl_ditandai = now(); 
        $todo->save();

        return redirect()->back()->with('success', 'Todo berhasil diselesaikan!');
    }

    public function Undone($id)
    {
        $todo = TodoList::findOrFail($id);
        $todo->status = 'belum selesai';
        $todo->tgl_ditandai = null; 
        $todo->save();

        return redirect()->back()->with('success', 'Todo dikembalikan ke status belum selesai!');
    }

    public function destroy($id)
    {
        $todo_list = TodoList::findOrFail($id);
        $todo_list->delete();

        return redirect('/')->with('success', 'Todo list berhasil dihapus');
    }
}
