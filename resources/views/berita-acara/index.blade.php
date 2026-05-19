@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6 transition-colors">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('messages.bast_list') }}</h2>
        @if (Auth::user()->isAdmin())
            <a href="{{ route('berita-acara.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                {{ __('messages.add_bast') }}
            </a>
        @endif
    </div>

    <div class="space-y-6">
        @forelse ($beritaAcaras as $ba)
            <div class="border dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $ba->nama }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('messages.by') }}: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $ba->user->name }}</span> | 
                            {{ __('messages.upload_at') }}: {{ $ba->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ asset('storage/' . $ba->file_path) }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 text-sm font-medium border border-indigo-600 dark:border-indigo-500 px-3 py-1 rounded-md">
                            {{ __('messages.view_file') }}
                        </a>
                        @if (Auth::user()->isAdmin())
                            <form action="{{ route('berita-acara.destroy', $ba) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete_bast') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 text-sm font-medium border border-red-600 dark:border-red-500 px-3 py-1 rounded-md">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-md p-3">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('messages.item_list') }}:</h4>
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 dark:text-gray-400 border-b dark:border-gray-600">
                                <th class="pb-1 font-medium">{{ __('messages.item_name') }}</th>
                                <th class="pb-1 font-medium">{{ __('messages.quantity') }}</th>
                                <th class="pb-1 font-medium">{{ __('messages.unit') }}</th>
                                <th class="pb-1 font-medium">{{ __('messages.unit_price') }}</th>
                                <th class="pb-1 font-medium text-right">{{ __('messages.total') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-600">
                            @php $grandTotal = 0; @endphp
                            @foreach ($ba->items as $item)
                                @php 
                                    $total = $item->jumlah * $item->harga_satuan; 
                                    $grandTotal += $total;
                                @endphp
                                <tr>
                                    <td class="py-1 text-gray-800 dark:text-gray-200">{{ $item->nama_barang }}</td>
                                    <td class="py-1 text-gray-800 dark:text-gray-200">{{ $item->jumlah }}</td>
                                    <td class="py-1 text-gray-800 dark:text-gray-200">{{ $item->satuan }}</td>
                                    <td class="py-1 text-gray-800 dark:text-gray-200">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="py-1 text-right font-medium text-gray-900 dark:text-white">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t dark:border-gray-600 font-bold">
                                <td colspan="4" class="pt-2 text-right text-gray-700 dark:text-gray-300">{{ __('messages.grand_total') }}:</td>
                                <td class="pt-2 text-right text-indigo-700 dark:text-indigo-400 text-base">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-10 border-2 border-dashed dark:border-gray-700 rounded-lg text-gray-500 dark:text-gray-400">
                {{ __('messages.no_data') }}
            </div>
        @endforelse
    </div>
</div>
@endsection
