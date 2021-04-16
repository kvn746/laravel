<?php

namespace App\Http\Controllers;

use App\Contacts;

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

    }

    public function store()
    {
        Contacts::create(
            $this->validate(request(), [
                'email' => 'required|email:rfc,dns',
                'message' => 'required',
            ])
        );

        return redirect()->route('contacts.index');
    }

    public function edit(Contacts $contact)
    {

    }

    public function update(Contacts $contact)
    {

    }

    public function destroy(Contacts $contact)
    {

    }
}
