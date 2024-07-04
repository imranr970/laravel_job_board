<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name = null,
        public ?array $options = [],
        public ?bool $default = true,
        public ?string $value = null,
    )
    {
        //
    }

    public function options_with_labels() 
    {
        return array_is_list($this->options) 
            ? array_combine(array_map('strtolower', $this->options), array_map('ucfirst', $this->options))
            : $this->options;   
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
