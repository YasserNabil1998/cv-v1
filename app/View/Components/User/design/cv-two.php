<?php

namespace App\View\Components\User\design;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CvTwo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // يمكن إضافة كود هنا
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.user.design.cv-two');  // التأكد من أن القوس مغلق هنا
    }
}
