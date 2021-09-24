<?php

namespace App\View\Components\Sidebar;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $active,$href;
    public function __construct($active=false,$href="")
    {
        $this->active=$active;
        $this->href=$href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.menu');
    }
}
