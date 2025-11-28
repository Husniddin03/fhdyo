<?php

namespace App\View\Components\Admin;

use App\Models\Question;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Main extends Component
{

    public function __construct(
        public string $page,
        public string $title
    ) {}

    public function render(): View
    {
        return view('components.admin.main');
    }
}
