<?php

namespace App\Http\Controllers;

use App\Contacts;

class ContactsController extends Controller
{
    public function index()
    {
        $messages = Contacts::latest()->get();

        return view('admin.feedback', compact('messages'));
    }

    public function create()
    {
        return view('contacts');
    }

    public function store()
    {
        Contacts::create(
            $this->validate(request(), [
                'email' => 'required|email:rfc,dns',
                'message' => 'required',
            ])
        );
        flash('Ваше сообщение успешно отправлено!');

        return redirect()->route('contacts.create');
    }
}
