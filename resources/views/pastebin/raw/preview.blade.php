<x-layouts.app :title="$title">
    <div class="w-full my-10 rounded-lg p-6 ">
        <h2 class="text-2xl font-bold mb-4 text-white text-center">Raw Content</h2>
        <div class="mb-4 text-center">
        </div>
        <div class="overflow-x-auto">
            @if ($highlighted)
                <pre class="bg-[#282c34] text-[#abb2bf] shadow-3xl text-sm relative overflow-hidden max-w-full tab-size h-full p-5"><code class="language-{{ $highlighted->language ?? '' }}">{!! $highlighted->value !!}</code></pre>
            @else
                <pre class="bg-[#282c34] text-[#abb2bf] shadow-3xl text-sm relative overflow-hidden max-w-full tab-size h-full p-5">{{ $highlighted }}</pre>
            @endif
        </div>
    </div>
</x-layouts.app>
