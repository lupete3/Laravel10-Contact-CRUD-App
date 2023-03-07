<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $contacts = Contact::latest()->paginate(5);

        return view('contacts.index',compact('contacts'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => 'required',
            'telephone' => 'required',
        ]);

        Contact::create($request->all());
         
        return redirect()->route('contacts.index')
                        ->with('success','Contact créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): View
    {
        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): View
    {
        return view('contacts.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $request->validate([
            'nom' => 'required',
            'telephone' => 'required',
        ]);
        
        $contact->update($request->all());
        
        return redirect()->route('contacts.index')
                        ->with('success','Contact modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
         
        return redirect()->route('contacts.index')
                        ->with('success','Contact supprimé avec succès ');
    }
}
