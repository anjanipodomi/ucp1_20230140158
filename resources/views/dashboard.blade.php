<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    Role: {{ ucfirst(auth()->user()->role) }}
                    {{-- menampilkan role user yang sedang login, misalnya Admin atau User --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>