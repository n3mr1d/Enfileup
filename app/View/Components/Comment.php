<?php

namespace App\View\Components;

use App\Models\CommentAnon;
use App\Models\Pastebin;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Comment extends Component
{

    public string $getComment = '';
    /**
     * Create a new component instance.
     */
    public function __construct($uuid, $type)
    {
        if ($type === 'pastebin') {
            $this->getComment = Pastebin::where('pastebin_id', $uuid)->first();

        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment');
    }
}
