<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ChangeCollection;
use App\Contact;
use Intervention\Image\Facades\Image;
use App\Change;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $contact = new Contact();

        $contact->fill($request->all());
        $contact->save();

        return response()->json('successfully added');
    }

    public function index()
    {
        $contacts = Contact::all();
        return new ContactCollection($contacts);
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        return response()->json($contact);
    }

    public function update($id, Request $request)
    {
        $contact = Contact::find($id);

        $contact->fill($request->all());

        $contact->save();

        return response()->json('successfully updated');
    }

    public function delete($id)
    {
        Contact::destroy($id);

        return response()->json('successfully deleted');
    }
}
