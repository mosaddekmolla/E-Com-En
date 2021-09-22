<?php

namespace App\View\Components;

use Illuminate\View\Component;

class test2 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public function __construct($data)
    {   
        //
        $this->title = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.test2');
    }
}
