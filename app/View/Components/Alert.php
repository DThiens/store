<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $content;
    public $dataIcon;
    public function __construct($type, $content, $dataIcon) 
    {
        $this->type = $type;
        $this->content = $content;
        $this->dataIcon = $dataIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('Components.Alert');
    }
}
