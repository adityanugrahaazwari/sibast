@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md transition-colors">
    <div class="flex items-center mb-6">
        <a href="{{ route('berita-acara.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('messages.create_bast_title') }}</h2>
    </div>

    @if($errors->has('error'))
        <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded relative mb-4">
            {{ $errors->first('error') }}
        </div>
    @endif

    <form action="{{ route('berita-acara.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="nomor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor</label>
                <input type="text" name="nomor" id="nomor" value="{{ old('nomor') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                @error('nomor')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.document_name') }}</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama_ppk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pejabat Pembuat Komitmen</label>
                <input type="text" name="nama_ppk" id="nama_ppk" value="{{ old('nama_ppk') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                @error('nama_ppk')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama_pejabat_pengadaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pejabat Pengadaan</label>
                <input type="text" name="nama_pejabat_pengadaan" id="nama_pejabat_pengadaan" value="{{ old('nama_pejabat_pengadaan') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                @error('nama_pejabat_pengadaan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="informasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Informasi</label>
                <textarea name="informasi" id="informasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">{{ old('informasi') }}</textarea>
                @error('informasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.file_hint') }}</label>
                <input type="file" name="file" id="file" required class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50">
                @error('file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('messages.item_list') }}</h3>
                <button type="button" id="add-item" class="bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition">+ {{ __('messages.add_item') }}</button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border dark:border-gray-700" id="items-table">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">{{ __('messages.item_name') }}</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase w-20">{{ __('messages.quantity') }}</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase w-24">{{ __('messages.unit') }}</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">{{ __('messages.unit_price') }}</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase w-16">{{ __('messages.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700" id="items-body">
                        <tr class="item-row">
                            <td class="p-2">
                                <input type="text" name="items[0][nama_barang]" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
                            </td>
                            <td class="p-2">
                                <input type="number" name="items[0][jumlah]" required min="1" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
                            </td>
                            <td class="p-2">
                                <input type="text" name="items[0][satuan]" placeholder="Pcs/Unit" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
                            </td>
                            <td class="p-2">
                                <input type="number" name="items[0][harga_satuan]" required min="0" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
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

        <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 font-bold transition">{{ __('messages.save_bast') }}</button>
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
                    <input type="text" name="items[\${rowIdx}][nama_barang]" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
                </td>
                <td class="p-2">
                    <input type="number" name="items[\${rowIdx}][jumlah]" required min="1" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
                </td>
                <td class="p-2">
                    <input type="text" name="items[\${rowIdx}][satuan]" placeholder="Pcs/Unit" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
                </td>
                <td class="p-2">
                    <input type="number" name="items[\${rowIdx}][harga_satuan]" required min="0" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-1 border text-sm">
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
