<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class InputFileBlock extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $name = "image", public $label = "")
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-file-block');
    }
}
