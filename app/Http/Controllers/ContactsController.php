<?php

namespace App\Http\Controllers;

use App\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function show()
    {
        $messages = Contacts::latest()->get();

        return view('admin.feedback', compact('messages'));
    }

    public function create()
    {
        Contacts::create(
            $this->validate(request(), [
                'email' => 'required|email:rfc,dns',
                'message' => 'required',
            ])
        );

        return redirect()->route('contacts');
    }
}
