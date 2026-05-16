@extends('layouts.admin')

@section('title', 'Data User')
@section('page-title', 'Data User Terdaftar')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Total: <strong>{{ $users->total() }}</strong> user terdaftar</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">No</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Nama</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Username</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Email</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">No. HP</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Alamat</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $i => $user)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-2 text-gray-400">{{ $users->firstItem() + $i }}</td>
                    <td class="py-3 px-2 font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="py-3 px-2">
                        <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded text-xs font-mono">{{ $user->username }}</span>
                    </td>
                    <td class="py-3 px-2 text-gray-500">{{ $user->email ?? '-' }}</td>
                    <td class="py-3 px-2 text-gray-500">{{ $user->phone ?? '-' }}</td>
                    <td class="py-3 px-2 text-gray-500 max-w-xs truncate">{{ $user->address ?? '-' }}</td>
                    <td class="py-3 px-2 text-gray-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="py-10 text-center text-gray-400">Belum ada user terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
