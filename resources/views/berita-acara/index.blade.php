@extends('layouts.app')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Daftar Berita Acara Serah Terima</h2>
        @if (Auth::user()->isAdmin())
            <a href="{{ route('berita-acara.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                Tambah Berita Acara
            </a>
        @endif
    </div>

    <div class="space-y-6">
        @forelse ($beritaAcaras as $ba)
            <div class="border rounded-lg p-4 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">{{ $ba->nama }}</h3>
                        <p class="text-sm text-gray-500">
                            Oleh: <span class="font-medium text-gray-700">{{ $ba->user->name }}</span> | 
                            Diupload pada: {{ $ba->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ asset('storage/' . $ba->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium border border-indigo-600 px-3 py-1 rounded-md">
                            Lihat File
                        </a>
                        @if (Auth::user()->isAdmin())
                            <form action="{{ route('berita-acara.destroy', $ba) }}" method="POST" onsubmit="return confirm('Hapus berita acara ini beserta daftar barangnya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium border border-red-600 px-3 py-1 rounded-md">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 rounded-md p-3">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Daftar Barang:</h4>
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="pb-1 font-medium">Nama Barang</th>
                                <th class="pb-1 font-medium">Jumlah</th>
                                <th class="pb-1 font-medium">Satuan</th>
                                <th class="pb-1 font-medium">Harga Satuan</th>
                                <th class="pb-1 font-medium text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @php $grandTotal = 0; @endphp
                            @foreach ($ba->items as $item)
                                @php 
                                    $total = $item->jumlah * $item->harga_satuan; 
                                    $grandTotal += $total;
                                @endphp
                                <tr>
                                    <td class="py-1">{{ $item->nama_barang }}</td>
                                    <td class="py-1">{{ $item->jumlah }}</td>
                                    <td class="py-1">{{ $item->satuan }}</td>
                                    <td class="py-1">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="py-1 text-right font-medium">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t font-bold">
                                <td colspan="4" class="pt-2 text-right">Total Keseluruhan:</td>
                                <td class="pt-2 text-right text-indigo-700 text-base">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-10 border-2 border-dashed rounded-lg text-gray-500">
                Belum ada data Berita Acara.
            </div>
        @endforelse
    </div>
</div>
@endsection
