<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $title = "Daftar Event";
        $events = new Event;

        // Fitur Search
        if (isset($_GET['s']) && $_GET['s'] != '') {
            $events = $events->where('name', 'like', "%{$_GET['s']}%");
        }
        
        // Fitur Filter
        if (isset($_GET['id_category']) && $_GET['id_category'] != '') {
            $events = $events->where('id_category', $_GET['id_category']);
        }

        $events = $events->paginate(5);
        $categories = Category::all();

        return view('admin.daftarevent', compact('title', 'events', 'categories'));
    }

    // FUNGSI BARU UNTUK MENAMPILKAN PER KATEGORI
    public function category($id)
    {
        $category = Category::where('id_category', $id)->first();
        $title = 'Kategori ' . $category->name;
        
        // Mengambil event berdasarkan relasi hasMany
        $events = $category->events; 
        
        $categories = Category::all();

        return view('admin.daftarevent', compact('title', 'events', 'categories'));
    }

    public function create()
    {
        $title = "Input Event";
        $categories = Category::all();
        return view('admin.inputevent', compact('title', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_category' => 'required',
            'location' => 'required',
            'event_date' => 'required|date',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        Event::create($request->all());
        return redirect('events')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show($id) { }

    public function edit($id)
    {
        $title = "Edit Event";
        $event = Event::find($id);
        $categories = Category::all();
        return view('admin.inputevent', compact('title', 'event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'id_category' => 'required',
            'location' => 'required',
            'event_date' => 'required|date',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $event = Event::find($id);
        $event->update($request->all());
        return redirect('events')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect('events')->with('success', 'Event berhasil dihapus!');
    }
}