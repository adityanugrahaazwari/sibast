@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex items-center mb-6">
        <a href="{{ route('berita-acara.index') }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-900">Buat Berita Acara & Daftar Barang</h2>
    </div>

    @if($errors->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ $errors->first('error') }}
        </div>
    @endif

    <form action="{{ route('berita-acara.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Dokumen</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">File Lampiran (PDF/Gambar)</label>
                <input type="file" name="file" id="file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @error('file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Barang</h3>
                <button type="button" id="add-item" class="bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition">+ Tambah Barang</button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border" id="items-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-20">Jumlah</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-24">Satuan</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase w-16">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="items-body">
                        <tr class="item-row">
                            <td class="p-2">
                                <input type="text" name="items[0][nama_barang]" required class="w-full rounded-md border-gray-300 p-1 border text-sm">
                            </td>
                            <td class="p-2">
                                <input type="number" name="items[0][jumlah]" required min="1" class="w-full rounded-md border-gray-300 p-1 border text-sm">
                            </td>
                            <td class="p-2">
                                <input type="text" name="items[0][satuan]" placeholder="Pcs/Unit" required class="w-full rounded-md border-gray-300 p-1 border text-sm">
                            </td>
                            <td class="p-2">
                                <input type="number" name="items[0][harga_satuan]" required min="0" class="w-full rounded-md border-gray-300 p-1 border text-sm">
                            </td>
                            <td class="p-2 text-center">
                                <button type="button" class="text-red-500 hover:text-red-700 remove-item">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @error('items')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 font-bold">Simpan Berita Acara & Barang</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const body = document.getElementById('items-body');
        const addButton = document.getElementById('add-item');
        let rowIdx = 1;

        addButton.addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.className = 'item-row';
            newRow.innerHTML = `
                <td class="p-2">
                    <input type="text" name="items[${rowIdx}][nama_barang]" required class="w-full rounded-md border-gray-300 p-1 border text-sm">
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIdx}][jumlah]" required min="1" class="w-full rounded-md border-gray-300 p-1 border text-sm">
                </td>
                <td class="p-2">
                    <input type="text" name="items[${rowIdx}][satuan]" placeholder="Pcs/Unit" required class="w-full rounded-md border-gray-300 p-1 border text-sm">
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIdx}][harga_satuan]" required min="0" class="w-full rounded-md border-gray-300 p-1 border text-sm">
                </td>
                <td class="p-2 text-center">
                    <button type="button" class="text-red-500 hover:text-red-700 remove-item">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </td>
            `;
            body.appendChild(newRow);
            rowIdx++;
        });

        body.addEventListener('click', function(e) {
            if (e.target.closest('.remove-item')) {
                const rows = body.querySelectorAll('.item-row');
                if (rows.length > 1) {
                    e.target.closest('.item-row').remove();
                } else {
                    alert('Minimal harus ada satu barang.');
                }
            }
        });
    });
</script>
@endsection
