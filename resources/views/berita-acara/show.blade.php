@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md transition-colors">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('berita-acara.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Berita Acara</h2>
        </div>
        <div class="flex space-x-2">
            <a href="{{ asset('storage/' . $beritaAcara->file_path) }}" target="_blank" class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 px-4 py-2 rounded-md hover:bg-indigo-200 dark:hover:bg-indigo-900/50 transition text-sm font-semibold">
                {{ __('messages.view_file') }}
            </a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('berita-acara.edit', $beritaAcara) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition text-sm font-semibold">
                    {{ __('messages.edit') }}
                </a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-gray-50 dark:bg-gray-700/30 p-6 rounded-xl border dark:border-gray-700">
        <div>
            <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Nomor Dokumen</span>
            <p class="text-gray-900 dark:text-white font-medium">{{ $beritaAcara->nomor ?? '-' }}</p>
        </div>
        <div>
            <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Nama Dokumen</span>
            <p class="text-gray-900 dark:text-white font-medium">{{ $beritaAcara->nama }}</p>
        </div>
        <div>
            <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Pejabat Pembuat Komitmen</span>
            <p class="text-gray-900 dark:text-white font-medium">{{ $beritaAcara->nama_ppk ?? '-' }}</p>
        </div>
        <div>
            <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Pejabat Pengadaan</span>
            <p class="text-gray-900 dark:text-white font-medium">{{ $beritaAcara->nama_pejabat_pengadaan ?? '-' }}</p>
        </div>
        <div class="md:col-span-2">
            <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Informasi Tambahan</span>
            <p class="text-gray-800 dark:text-gray-200 italic">{{ $beritaAcara->informasi ?? '-' }}</p>
        </div>
        <div class="md:col-span-2 pt-2 border-t dark:border-gray-600">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Diunggah oleh <span class="font-semibold">{{ $beritaAcara->user->name }}</span> pada {{ $beritaAcara->created_at->format('d F Y, H:i') }}
            </p>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            {{ __('messages.item_list') }}
        </h3>
        <div class="overflow-hidden border dark:border-gray-700 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.item_name') }}</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.quantity') }}</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.unit') }}</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.unit_price') }}</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('messages.total') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @php $grandTotal = 0; @endphp
                    @foreach($beritaAcara->items as $item)
                        @php 
                            $total = $item->jumlah * $item->harga_satuan;
                            $grandTotal += $total;
                        @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $item->nama_barang }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">{{ $item->jumlah }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">{{ $item->satuan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500 dark:text-gray-400">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-gray-900 dark:text-white">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-right text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{ __('messages.grand_total') }}</td>
                        <td class="px-6 py-4 text-right text-lg font-extrabold text-indigo-600 dark:text-indigo-400 italic">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
