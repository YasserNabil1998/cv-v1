<?php

namespace App\View\Components\User\Design;

use App\Models\Template;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Closure;
use Illuminate\Support\Facades\Log;

class CvOne extends Component
{
    public $templates;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->templates = Template::where('template_name', 'cvDesign-cv-one')->first();

        if (is_null($this->templates)) {
            Log::warning('Template cvDesign-cv-one not found.');
        } else {
            Log::info('Template found: ', ['template' => $this->templates]);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        Log::info('Rendering CvOne component', ['templates' => $this->templates]);

        if ($this->templates) {
            // إذا كان هناك قالب، استمر في إرساله
            return view('components.user.design.cv-one', [
                'templates' => $this->templates
            ]);
        } else {
            // إذا لم يكن هناك قالب، يمكنك التعامل مع الحالة هنا
            return view('components.user.design.cv-one', [
                'templates' => null
            ]);
        }
    }
}
