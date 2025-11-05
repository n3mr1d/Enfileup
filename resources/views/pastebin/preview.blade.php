<x-layouts.app :title="$pastebin->title">
    <div class="min-h-screen bg-gray-900 py-10">
        <h1 class="text-3xl font-bold text-white text-center mb-8 drop-shadow-lg">Pastebin Preview</h1>

        {{-- Iframe Preview --}}
        <div class="flex w-full justify-center mb-6">
            <iframe width="800" height="500" style="background:white;"
                src="{{ route('fullpage.pastebin', ['uuid' => $pastebin->pastebin_id]) }}"></iframe>
        </div>

        {{-- Comment Section --}}
        <div class="max-w-xl mx-auto mt-8 bg-gray-800/70 rounded-lg shadow-lg p-8">
            <h2 class="text-lg font-semibold mb-4 text-white">Komentar</h2>

            {{-- Comment Form --}}
            <div class="mb-6">
                <iframe src="{{ route('controller.pastebin', ['uuid' => $pastebin->pastebin_id]) }}" width="100%"
                    height="240" frameborder="0"
                    style="background-color: transparent; width:100%; min-height:140px; border-radius: 8px;">
                </iframe>
            </div>

            {{-- Comments View --}}
            <div>
                <iframe src="{{ route('view.comment.pastebin', ['uuid' => $pastebin->pastebin_id]) }}" width="100%"
                    height="300" frameborder="0"
                    style="background-color: transparent; width:100%; min-height:300px;"></iframe>
            </div>
        </div>
    </div>
</x-layouts.app>
