<?php

namespace App\View\Components\Tables;

use Illuminate\View\Component;

class Status extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $sts,$name;
    public function __construct($sts="",$name="status")
    {
        $this->sts=$sts;
        $this->name=$name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.status');
    }
}
