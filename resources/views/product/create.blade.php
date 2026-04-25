<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white text-gray-900 shadow-md rounded-xl p-8">
                
                {{-- Header --}}
                <div class="flex items-start gap-3 mb-8">
                    <a href="{{ route('product.index') }}"
                       class="mt-1 text-gray-400 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>

                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">
                            Add Product
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Fill in the details to add a new product
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('product.store') }}" method="POST" class="space-y-5">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Product Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Product Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Wireless Headphones"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        >
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            {{-- pilihan awal sebelum user memilih kategori --}}

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                {{-- menampilkan nama kategori dari database --}}
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        {{-- menampilkan pesan error jika kategori belum dipilih --}}
                    </div>

                    {{-- Quantity & Price --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="qty" class="block text-sm font-medium text-gray-700 mb-2">
                                Quantity
                            </label>
                            <input
                                type="number"
                                id="qty"
                                name="qty"
                                value="{{ old('qty') }}"
                                placeholder="0"
                                min="0"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            >
                            @error('qty')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Price (Rp)
                            </label>
                            <input
                                type="number"
                                id="price"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="0"
                                min="0"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black focus:border-black"
                            >
                            @error('price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Owner --}}
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            
                    {{-- Actions --}}
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('product.index') }}"
                           class="px-5 py-2.5 border border-black text-black text-sm font-medium rounded-lg hover:bg-gray-100 transition">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-5 py-2.5 bg-black text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition">
                            Save Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>