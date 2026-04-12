<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white text-gray-900 overflow-hidden shadow-md sm:rounded-lg p-6">
                
                {{-- Header --}}
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                            Product List
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Manage your product inventory
                        </p>
                    </div>

                    @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('product.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-black hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition duration-150 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Product
                        </a>
                    @endif
                @endauth
                </div>

                {{-- Flash Message --}}
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
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

                                            @auth
                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                    class="text-gray-400 hover:text-amber-500 transition"
                                                    title="Edit">
                                                        ✏
                                                    </a>

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
                                                @endif
                                            @endauth
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