<x-admin-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">{{ $title }}</h2>
    
    <div class="shadow px-6 py-4 bg-white rounded">
        <form action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}" method="POST">
            @csrf
            @if(isset($event)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Event</label>
                    <input type="text" name="name" value="{{ isset($event) ? $event->name : old('name') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="id_category" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id_category }}" {{ (isset($event) && $event->id_category == $cat->id_category) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="location" value="{{ isset($event) ? $event->location : old('location') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Event</label>
                    <input type="date" name="event_date" value="{{ isset($event) ? $event->event_date : old('event_date') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga Tiket (Rp)</label>
                    <input type="number" name="price" value="{{ isset($event) ? $event->price : old('price') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok Tiket</label>
                    <input type="number" name="stock" value="{{ isset($event) ? $event->stock : old('stock') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Save</button>
            </div>
        </form>
    </div>
</x-admin-layout>