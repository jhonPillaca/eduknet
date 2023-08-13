<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BookDialog extends Component
{
    public $title;

  

    public function render(){
        $this->title="Add New Book";
        return view('components.book-dialog')->with('title', $this->title);
    }
}