<?php

namespace App\Http\Livewire\Customer\Inquiry;

use App\Models\Review as ModelsReview;
use Livewire\Component;

class Review extends Component
{
    public $inquiryreviews;
    public $title;
    public $message;
    public $ratingValue;
    public $editMode = false; // Add a flag to toggle edit mode

    protected $rules = [
        'ratingValue' => 'required|integer',
        'title' => 'required|max:255',
        'message' => 'required',
    ];

    public function mount($inquiryreviews)
    {
        $this->inquiryreviews = $inquiryreviews;
        $myreviews = ModelsReview::where('inquiry_id',$this->inquiryreviews->id)->first();
        if ($myreviews) { // If we have reviews, we're in edit mode
            $this->editMode = true;
            $this->title = $myreviews->title;
            $this->message = $myreviews->message;
            $this->ratingValue = $myreviews->rating;
        }
    }

    public function ratingSelected($value)
    {
        $this->ratingValue = $value;
    }

    public function submitReview()
    {
        $validatedData = $this->validate();

        if ($this->editMode) { // If we're in edit mode, update the existing review
            $review = ModelsReview::where('inquiry_id',$this->inquiryreviews->id)->first();
            $review->rating = $validatedData['ratingValue'];
            $review->title = $validatedData['title'];
            $review->message = $validatedData['message'];
            $review->save();

            session()->flash('message', 'Your review has been updated.');
        } else { // Otherwise, create a new review
            $review = new ModelsReview();
            $review->inquiry_id = $this->inquiryreviews->id;
            $review->rating = $validatedData['ratingValue'];
            $review->title = $validatedData['title'];
            $review->message = $validatedData['message'];
            $review->save();

            session()->flash('message', 'Thank you for your review!');
        }
    }



    public function render()
    {
        return view('livewire.customer.inquiry.review');
    }
}
