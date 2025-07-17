<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Helper;
use App\Models\Page;
use Carbon\Carbon;
use Livewire\Component;
use Storage;

class Edit extends Component
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
        if (!empty($this->image)) {
            $imageName = $this->page->replicate()->slug . '-' . Carbon::now()->timestamp;
            $imageName = Helper::store($this->image, 'pages', $imageName);
            Storage::delete('uploads/pages/' . $this->page->image);
            $this->page->image = $imageName;
        }
        $this->page->save();

        session()->flash('message', 'Page has been updated successfully!');
        //  cleanup
        return redirect()->route('admin.page.edit',$this->page);
    }


    public function mount($page)
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.admin.pages.edit');
    }
}
