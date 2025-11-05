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
    <form method="POST" action="{{ route('pastebin.comment') }}">
        @csrf
        <input type="hidden" name="uuid" value="{{ $uuid }}">
        <div class="mb-4">
            <textarea name="msg" rows="4"
                class="w-full bg-gray-900 text-gray-100 border border-gray-700 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Write your comment here"></textarea>
        </div>
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 transition-colors text-white px-4 py-2 rounded">Submit</button>
    </form>
</body>

</html>
