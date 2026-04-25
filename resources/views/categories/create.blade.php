<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white text-gray-900 overflow-hidden shadow-md sm:rounded-lg p-6">

                {{-- Header --}}
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Add Category
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Tambahkan data category baru
                    </p>
                </div>

                {{-- Form tambah category --}}
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    {{-- token keamanan Laravel agar form bisa dikirim --}}

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Category Name
                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Contoh: Electronic">

                        {{-- input untuk mengisi nama category --}}
                        @error('name')
                            <p class="text-sm text-red-600 mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                        {{-- menampilkan pesan error jika nama category kosong / duplikat --}}
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
                            Cancel
                        </a>
                        {{-- tombol kembali ke halaman list category --}}

                        <button type="submit"
                                class="px-4 py-2 bg-black text-white rounded">
                            Save Category
                        </button>
                        {{-- tombol untuk menyimpan data category --}}
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>