<?php

namespace App\View\Components\Tables;

use Illuminate\View\Component;

class Thead extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $thItem,$end;
    public function __construct($thItem = "")
    {
        $thItem = explode(",", strtolower($thItem) );
        $this->thItem = $thItem;
        $this->end=end($thItem);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.thead');
    }
}
