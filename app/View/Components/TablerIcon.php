<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TablerIcon extends Component
{
    public string $spriteUrl;
    public string $iconId;

    /**
     * Create a new component instance.
     *
     * @param string $icon Icon name (e.g., 'clock-hour-4')
     * @param string $class CSS class(es) for the svg element
     * @param string $sprite Sprite type: 'filled' or 'outline'
     */
    public function __construct(
        public string $icon,
        public string $class = 'icon',
        public string $sprite = 'filled'
    ) {
        // Determine sprite file
        $spriteFile = match($sprite) {
            'filled' => 'tabler-sprite-filled.svg',
            'outline' => 'tabler-sprite.svg',
            default => $sprite,
        };

        $this->spriteUrl = asset("tabler/icons-sprite/{$spriteFile}");

        // Auto-prefix icon id name if needed
        $this->iconId = $sprite === 'outline' ? "tabler-{$icon}" : "tabler-filled-{$icon}";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tabler-icon');
    }
}
