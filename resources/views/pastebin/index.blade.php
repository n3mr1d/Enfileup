<x-layouts.app :title="$title">
    <h1>Pastebin Store</h1>
    <form action="{{ route('pastebin.store') }}" method="post" autocomplete="off">
        @csrf

        <div>
            <label>
                <input type="radio" name="support" value="md" checked>
                Markdown
            </label>
            <label>
                <input type="radio" name="support" value="html">
                HTML
            </label>

        </div>
        <div style="margin:10px 0"></div>
        <div>
            <input type="password" name="password" placeholder="Password (optional)" autocomplete="new-password"
                style="width:200px;">
        </div>
        <div style="margin:10px 0"></div>
        <div>
            <select name="expire_at" required>
                @foreach ($expire as $item)
                    <option value="{{ $item->value }}">{{ $item->label() }}</option>
                @endforeach
            </select>
        </div>
        <div style="margin:10px 0"></div>
        <div>
            <textarea name="content" placeholder="Paste your text here..." rows="10" style="width:100%;max-width:700px;"></textarea>
        </div>
        <div style="margin:10px 0"></div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</x-layouts.app>
