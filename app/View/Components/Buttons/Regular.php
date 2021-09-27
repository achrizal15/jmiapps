<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class Regular extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $color, $name, $type;
    public function __construct($color = "green", $type = "button", $name = "Buttons")
    {
        $this->name = $name;
        $this->color = $color;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.regular');
    }
}
