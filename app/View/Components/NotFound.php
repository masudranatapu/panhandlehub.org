<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotFound extends Component
{
    public $word, $route, $method;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $word = 'User', string $route = 'admin.dashboard', $method = "GET")
    {
        $this->word = $word;
        $this->route = $route;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.not-found');
    }
}
