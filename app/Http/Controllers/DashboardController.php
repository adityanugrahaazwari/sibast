<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\BeritaAcaraItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Stats for Admin (System-wide)
            $stats = [
                'total_users' => User::count(),
                'total_bast' => BeritaAcara::count(),
                'total_items' => BeritaAcaraItem::count(),
                'total_value' => BeritaAcaraItem::selectRaw('SUM(jumlah * harga_satuan) as total')->value('total') ?? 0,
            ];
            
            // Recent BAST for Admin
            $recentBast = BeritaAcara::with('user')->latest()->take(5)->get();
        } else {
            // Stats for Regular User (Own data)
            $stats = [
                'total_bast' => BeritaAcara::where('user_id', $user->id)->count(),
                'total_items' => BeritaAcaraItem::whereHas('beritaAcara', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->count(),
                'total_value' => BeritaAcaraItem::whereHas('beritaAcara', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->selectRaw('SUM(jumlah * harga_satuan) as total')->value('total') ?? 0,
            ];
            
            // Recent BAST for User
            $recentBast = BeritaAcara::where('user_id', $user->id)->latest()->take(5)->get();
        }

        return view('dashboard', compact('user', 'stats', 'recentBast'));
    }
}
