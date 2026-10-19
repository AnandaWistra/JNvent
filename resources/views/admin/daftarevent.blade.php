<x-admin-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
        {{ $title }}
    </h2>

    <div class="shadow px-6 py-4 bg-white rounded">
        <!-- PENCARIAN & FILTER -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <a href="{{ route('events.create') }}" class="px-4 py-2 text-sm rounded text-white bg-purple-600 font-semibold hover:bg-purple-700">
                    + Tambah Event
                </a>
            </div>
            <div>
                <form action="{{ route('events.index') }}" method="GET" class="flex gap-2">
                    <!-- DROPDOWN AUTO-SUBMIT -->
                    <select name="id_category" onchange="this.form.submit()" class="w-1/2 py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id_category }}" 
                                {{ (request('id_category') == $cat->id_category || (isset($selected_category) && $selected_category == $cat->id_category)) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <!-- KOLOM PENCARIAN TEXT -->
                    <input type="text" name="s" value="{{ request('s') }}" placeholder="Cari event..." class="w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Cari</button>
                </form>
            </div>
        </div>

        <!-- TABEL DATA -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($events as $item)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                            <div class="text-sm text-gray-500">{{ $item->event_date }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $item->location }}</td>
                        
                        <!-- KATEGORI BISA DIKLIK -->
                        <td class="px-6 py-4 text-sm text-blue-600 hover:underline font-medium">
                            <a href="{{ route('events.category', $item->category->id_category) }}">
                                {{ $item->category->name }}
                            </a>
                        </td>

                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <form action="{{ route('events.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <a href="{{ route('events.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                <button class="text-red-600 hover:text-red-900" onclick="return confirm('Anda Yakin?')" type="submit">Del</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- PAGINATION BERSYARAT (Sesuai Modul) -->
        <?php if (Request::path() == 'events') { ?>
            <div class="m-4">
                {{ $events->appends(request()->query())->links() }}
            </div>
        <?php } ?>
    </div>
</x-admin-layout>