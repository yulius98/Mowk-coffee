<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBarLogin extends Component
{
    /**
     * Create a new component instance.
     */
public function __construct(public $pendingCount = null, public $title = null, public $user = null)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar-login');
    }
}