<form action="{{ $url }}" method="POST"
      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-red-400 text-red-600 hover:bg-red-50 transition">
        Delete
    </button>
</form>