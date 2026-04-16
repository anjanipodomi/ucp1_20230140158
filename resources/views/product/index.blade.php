<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white text-gray-900 overflow-hidden shadow-md sm:rounded-lg p-6">
                
                {{-- Header --}}
                <div class="flex items-start justify-between mb-6">
    
                    {{-- Kiri: Judul --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                            Product List
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Manage your product inventory
                        </p>
                    </div>

                    {{-- Kanan: Tombol --}}
                    <div class="flex items-center gap-2">

                        {{-- Tombol Export (pakai Gate) --}}
                        @can('export-product')
                            <a href="{{ route('product.export') }}"
                            class="px-4 py-2 bg-green-600 text-white rounded">
                                Export
                            </a>
                        @endcan

                        {{-- Tombol Add Product --}}
                        @auth
                            <a href="{{ route('product.create') }}"
                            class="px-4 py-2 bg-black text-white rounded">
                                Add Product
                            </a>
                        @endauth

                    </div>
                </div>

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
                                <th class="w-28 px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th class="w-32 px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Owner
                                </th>
                                <th class="w-28 px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition duration-100">
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $product->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $product->qty > 10
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-red-100 text-red-700' }}">
                                            {{ $product->qty }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $product->user->name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('product.show', $product->id) }}"
                                            class="text-gray-400 hover:text-indigo-500 transition"
                                            title="View">
                                                👁
                                            </a>

                                            @can('update', $product)
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                class="text-gray-400 hover:text-amber-500 transition"
                                                title="Edit">
                                                    ✏
                                                </a>
                                            @endcan

                                            @can('delete', $product)
                                                <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this product?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-gray-400 hover:text-red-500 transition"
                                                            title="Delete">
                                                        🗑
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                        No products found.
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