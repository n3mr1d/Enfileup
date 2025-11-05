<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5">
    <title>View Comment</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-transparent">
    <div class="max-w-xl mx-auto">

        @if ($comment->total() != 0)
            {{ $comment->links() }}
            @foreach ($comment as $item)
                <div class="border-b border-gray-700 pb-3 mb-3 px-3 pt-3">
                    <div class="font-medium text-blue-400">
                        {{ $item->username ?? 'Anonymous' }}
                    </div>
                    <div class="text-gray-400 text-xs mb-1">
                        {{ $item->created_at?->diffForHumans() ?? '-' }}
                    </div>
                    <div class="text-gray-100 break-words">
                        {{ $item->content ?? '' }}
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center italic text-gray-300">Comment not found.</div>
        @endif
    </div>
</body>

</html>
