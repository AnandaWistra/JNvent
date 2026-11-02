<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Fungsi untuk menampilkan semua data event (GET)
    public function index()
    {
        // Mengambil semua data event beserta relasi kategorinya
        $events = Event::with('category')->get(); 
        
        // Mereturn data dalam bentuk JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar Event',
            'data'    => $events
        ], 200);
    }

    // Fungsi untuk menyimpan data baru (POST)
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required',
            'id_category' => 'required',
            'location' => 'required',
            'event_date' => 'required|date',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Simpan ke database
        $event = Event::create($validated);

        // Return response sukses
        return response()->json([
            'success' => true,
            'message' => 'Event berhasil ditambahkan via API',
            'data'    => $event
        ], 201);
    }
}