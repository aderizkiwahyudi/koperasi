<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $lastTitle;
    public function __construct($title = null, $lastTitle = 'Sistem Informasi Peminjaman Pada Koperasi Karyawan Amsata')
    {
        $this->title = $title . (is_null($title) ? '' : ' - ') . $lastTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('template.app');
    }
}
