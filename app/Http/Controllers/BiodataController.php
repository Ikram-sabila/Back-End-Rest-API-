<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;

class BiodataController extends Controller
{
    public function index()
    {
        $biodata = Biodata::all();
        return view('biodata.index', compact('biodata'));
    }

    public function show($id)
    {
        $biodata = Biodata::with(['kuliah', 'pengalaman'])->findOrFail($id);

        return response()->json([
            'biodata' => $biodata,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_biodata', 'public');
        }

        $biodata = Biodata::create($validated);

        return response()->json([
            'message' => 'Biodata berhasil ditambahkan.',
            'data' => $biodata,
        ], 201);
    }
}
