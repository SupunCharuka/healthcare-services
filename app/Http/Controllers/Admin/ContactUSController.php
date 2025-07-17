<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUSController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::all();
        return view('backend.admin.contact-us.index',compact('contacts'));
    }
}
