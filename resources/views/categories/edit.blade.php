<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white text-gray-900 overflow-hidden shadow-md sm:rounded-lg p-6">

                {{-- Header --}}
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Edit Category
                    </h2>
                </div>

                {{-- Form edit --}}
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- method PUT untuk update data --}}

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $category->name) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm">

                        {{-- menampilkan data lama category --}}

                        @error('name')
                            <p class="text-sm text-red-600 mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-black text-white rounded">
                            Update
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>