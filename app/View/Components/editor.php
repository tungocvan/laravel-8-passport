<?php

namespace App\View\Components;

use Illuminate\View\Component;

class editor extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $options;
    public function __construct($options =['id' => 'editor1', 'name' => 'editor1', 'rows' => 10, 'cols' => 80,'content' => 'CKEditor 4'])
    {
        //        
        if($options) $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.editor');
    }
}
