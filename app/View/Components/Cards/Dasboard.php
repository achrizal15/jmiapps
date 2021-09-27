<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class Dasboard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $subtitle, $percentase, $icon, $footer, $upper;
    public function __construct($title = "Cart", $subtitle = "2313", $icon = "fas fa-diagram", $percentase = "12,3%", $upper = false, $footer = "Since last month")
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->percentase = $percentase;
        $this->icon = $icon;
        $this->footer = $footer;
        $this->upper = $upper;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cards.dasboard');
    }
}
