<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController {
    public function index() {
        return response()->json(Pengumuman::all());
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('public/pengumuman') : null;

        Pengumuman::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
        ]);

        return response()->json(['message' => 'Pengumuman berhasil dibuat']);
    }
    public function update(Request $request, $id) {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update($request->only(['title', 'content']));
        return response()->json(['message' => 'Pengumuman diperbarui']);
    }
    public function destroy($id) {
        Pengumuman::destroy($id);
        return response()->json(['message' => 'Pengumuman dihapus']);
    }
}