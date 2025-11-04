<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Iframe extends Component
{
    public string $title = '';
    public string $src = '';
    public string $width = '';
    public string $height = '';
    public string $uuid = '';
    /**
     * Create a new component instance.
     */
    public function __construct($title, $src, $uuid, $width, $height)
    {
        $this->title = $title;
        $this->uuid = $uuid;
        $this->src = $src;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.iframe');
    }
}
