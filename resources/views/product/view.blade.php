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
                                <x-edit-button :url="route('product.edit', $product->id)" />
                                <x-delete-button :url="route('product.destroy', $product->id)" />
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