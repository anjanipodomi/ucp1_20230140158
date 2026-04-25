<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white text-gray-900 overflow-hidden shadow-md sm:rounded-lg p-6">

                {{-- Header --}}
                <div class="flex items-start justify-between mb-6">

                    {{-- Kiri: Judul --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                            Category List
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Manage your category
                        </p>
                    </div>

                    {{-- Kanan: Tombol Add Category --}}
                    <div>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('categories.create') }}"
                                class="px-4 py-2 bg-black text-white rounded">
                                    + Add Category
                                </a>
                                {{-- tombol tambah category hanya muncul untuk admin --}}
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-sm table-auto">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="w-12 px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="w-40 px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Total Product
                                </th>
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <th class="w-32 px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                        {{-- kolom action hanya muncul untuk admin --}}
                                    @endif
                                @endauth
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($categories as $category)
                                <tr class="hover:bg-gray-50 transition duration-100">

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $loop->iteration }}
                                    </td>
                                    {{-- menampilkan nomor urut data category --}}

                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $category->name }}
                                    </td>
                                    {{-- menampilkan nama category --}}

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $category->products_count }}
                                    </td>
                                    {{-- menampilkan total product yang memakai category ini --}}

                                    @auth
                                        @if(auth()->user()->role === 'admin')
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center gap-3">

                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="text-gray-400 hover:text-indigo-500 transition"
                                                    title="Edit">
                                                        ✏️
                                                    </a>
                                                    {{-- tombol edit hanya muncul untuk admin --}}

                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus category ini?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="text-gray-400 hover:text-red-500 transition"
                                                                title="Delete">
                                                            🗑️
                                                        </button>
                                                    </form>
                                                    {{-- tombol hapus hanya muncul untuk admin --}}

                                                </div>
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        No categories found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>