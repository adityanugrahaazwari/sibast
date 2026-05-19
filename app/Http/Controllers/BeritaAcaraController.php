<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\BeritaAcaraItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        // Admin dan User bisa melihat semua berita acara
        $beritaAcaras = BeritaAcara::with('items', 'user')->latest()->get();
        return view('berita-acara.index', compact('beritaAcaras'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Hanya Admin yang dapat membuat Berita Acara.');
        }
        return view('berita-acara.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'nomor' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'nama_ppk' => 'nullable|string|max:255',
            'nama_pejabat_pengadaan' => 'nullable|string|max:255',
            'informasi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'items' => 'required|array|min:1',
            'items.*.nama_barang' => 'required|string|max:255',
            'items.*.jumlah' => 'required|numeric|min:1',
            'items.*.satuan' => 'required|string|max:50',
            'items.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $path = $request->file('file')->store('berita-acara', 'public');

            $beritaAcara = BeritaAcara::create([
                'user_id' => Auth::id(),
                'nomor' => $request->nomor,
                'nama' => $request->nama,
                'nama_ppk' => $request->nama_ppk,
                'nama_pejabat_pengadaan' => $request->nama_pejabat_pengadaan,
                'informasi' => $request->informasi,
                'file_path' => $path,
            ]);

            foreach ($request->items as $item) {
                BeritaAcaraItem::create([
                    'berita_acara_id' => $beritaAcara->id,
                    'nama_barang' => $item['nama_barang'],
                    'jumlah' => $item['jumlah'],
                    'satuan' => $item['satuan'],
                    'harga_satuan' => $item['harga_satuan'],
                ]);
            }

            DB::commit();

            return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($path)) Storage::disk('public')->delete($path);
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(BeritaAcara $beritaAcara)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Hanya Admin yang dapat menghapus Berita Acara.');
        }

        Storage::disk('public')->delete($beritaAcara->file_path);
        $beritaAcara->delete();

        return back()->with('success', 'Berita Acara berhasil dihapus!');
    }
}
