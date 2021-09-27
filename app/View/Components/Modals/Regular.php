<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class Regular extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
  public  $title,$id;
    public function __construct($title="Modals",$id="regular-modal")
    {
        $this->title=$title;
        $this->id=$id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.regular');
    }
}
