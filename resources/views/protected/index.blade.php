<x-layouts.app title="Protected File">
    <div class="min-h-sm max-w-md mx-auto mt-10 rounded p-6">
        <h1 class="text-xl font-semibold mb-4">{{ $pastebin->title ?? 'Protected Paste' }}</h1>
        <p class="mb-4 text-gray-700">This paste is protected. Please enter the password to access the file.</p>

        <form action="{{ route('validate.pastebin.protected') }}" method="post" class="space-y-4">
            @csrf
            <input type="hidden" name="uuid" value="{{ $pastebin->pastebin_id }}">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Password" required>

            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Submit
            </button>
        </form>
    </div>
</x-layouts.app>
