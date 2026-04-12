<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-gray-900 overflow-hidden shadow-md sm:rounded-lg p-6">

                {{-- Header --}}
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-start gap-3">
                        <a href="{{ route('product.index') }}"
                           class="mt-1 text-gray-400 hover:text-gray-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>

                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                                Product Detail
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Viewing product #{{ $product->id }}
                            </p>
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="flex items-center gap-2">
                                <a href="{{ route('product.edit', $product->id) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-amber-400 text-amber-600 hover:bg-amber-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-red-400 text-red-600 hover:bg-red-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 3h6a1 1 0 011 1v2H8V4a1 1 0 011-1z" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>

                {{-- Detail Card --}}
                <div class="rounded-lg border border-gray-200 divide-y divide-gray-100">

                    {{-- Name --}}
                    <div class="flex flex-col md:flex-row md:items-center px-5 py-4">
                        <div class="w-40 shrink-0 text-sm font-medium text-gray-500 mb-1 md:mb-0">
                            Product Name
                        </div>
                        <div class="text-sm md:text-base font-semibold text-gray-900">
                            {{ $product->name }}
                        </div>
                    </div>

                    {{-- Quantity --}}
                    <div class="flex flex-col md:flex-row md:items-center px-5 py-4">
                        <div class="w-40 shrink-0 text-sm font-medium text-gray-500 mb-1 md:mb-0">
                            Quantity
                        </div>
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                {{ $product->qty > 10
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ $product->qty }} {{ $product->qty > 10 ? 'In Stock' : 'Low Stock' }}
                            </span>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="flex flex-col md:flex-row md:items-center px-5 py-4">
                        <div class="w-40 shrink-0 text-sm font-medium text-gray-500 mb-1 md:mb-0">
                            Price
                        </div>
                        <div class="text-sm md:text-base font-semibold text-gray-900">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    {{-- Owner --}}
                    <div class="flex flex-col md:flex-row md:items-center px-5 py-4">
                        <div class="w-40 shrink-0 text-sm font-medium text-gray-500 mb-1 md:mb-0">
                            Owner
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs font-bold uppercase">
                                {{ substr($product->user->name ?? '?', 0, 1) }}
                            </div>
                            <span class="text-sm md:text-base text-gray-900">
                                {{ $product->user->name ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Created At --}}
                    <div class="flex flex-col md:flex-row md:items-center px-5 py-4">
                        <div class="w-40 shrink-0 text-sm font-medium text-gray-500 mb-1 md:mb-0">
                            Created At
                        </div>
                        <div class="text-sm text-gray-700">
                            {{ $product->created_at ? $product->created_at->format('d M Y, H:i') : '-' }}
                        </div>
                    </div>

                    {{-- Updated At --}}
                    <div class="flex flex-col md:flex-row md:items-center px-5 py-4">
                        <div class="w-40 shrink-0 text-sm font-medium text-gray-500 mb-1 md:mb-0">
                            Updated At
                        </div>
                        <div class="text-sm text-gray-700">
                            {{ $product->updated_at ? $product->updated_at->format('d M Y, H:i') : '-' }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>