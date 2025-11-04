<x-layouts.app :title="$pastebin->title">
    <div class="min-h-screen bg-gray-900  py-10">
        <h1 class="text-3xl font-bold text-white text-center mb-8 drop-shadow-lg">Pastebin Preview</h1>

        {{-- Iframe Preview --}}
        <div class="flex w-full justify-center mb-6">
            <x-iframe :width="800" :height="500" :uuid="$pastebin->pastebin_id" :title="$pastebin->title" :src="route('fullpage.pastebin', ['uuid' => $pastebin->pastebin_id])" />
        </div>

        {{-- Comment Section --}}
        <div class="max-w-xl mx-auto mt-8 bg-gray-800/70 rounded-lg shadow-lg p-8">
            <h2 class="text-lg font-semibold mb-4 text-white">Komentar</h2>
            {{-- Comment Form --}}
            <form method="POST" action="{{ route('pastebin.comment') }}">
                @csrf
                <input type="hidden" name="uuid" value="{{ $pastebin->pastebin_id }}">
                <div class="mb-4">
                    <textarea name="msg" rows="4"
                        class="w-full bg-gray-900 text-gray-100 border border-gray-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Write your comment here"></textarea>
                </div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-4 py-2 rounded">Submit</button>
            </form>

            {{-- Comment List Example (Dummy Data) --}}
            <div class="mt-6">
                <div class="border-b border-gray-700 pb-3 mb-3">
                    <div class="font-medium text-blue-400">User123</div>
                    <div class="text-gray-400 text-sm mb-1">2 jam yang lalu</div>
                    <div class="text-gray-100">Keren banget filenya, terima kasih sudah berbagi!</div>
                </div>
                <div class="border-b border-gray-700 pb-3 mb-3">
                    <div class="font-medium text-blue-300">Anonim</div>
                    <div class="text-gray-400 text-sm mb-1">45 menit yang lalu</div>
                    <div class="text-gray-100">Bisa share versi markdown-nya?</div>
                </div>
            </div>
            {{-- /Comment List --}}
        </div>
    </div>
</x-layouts.app>
