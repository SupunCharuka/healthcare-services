<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Helper;
use App\Models\Page;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    public Page $page;

    public ?string $image = null;

    protected $rules = [
        'page.title' => 'required',
        'image' => 'sometimes|base64image',
        'page.content' => 'required'
    ];

    public function updated()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();

        //  save
        $imageName = $this->page->replicate()->slug . '-' . Carbon::now()->timestamp;
        $imageName = Helper::store($this->image, 'pages', $imageName);

        $this->page->image = $imageName;
        $this->page->save();


        session()->flash('message', 'Page has been created successfully!');

        return redirect()->route('admin.pages');
    }

    public function mount()
    {
        $this->page = new Page;
    }

    public function render()
    {
        return view('livewire.admin.pages.create');
    }
}
