<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\Message;

class DashboardController extends Controller
{
    // # Tampilkan dashboard admin dengan statistik
    public function index()
    {
        $stats = [
            'total_users'   => User::where('role', 'user')->count(),
            'total_books'   => Book::count(),
            'total_orders'  => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'unread_messages' => Message::whereNull('reply')->count(),
            'revenue'       => Order::whereIn('status', ['delivered'])->sum('total_price'),
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
}
