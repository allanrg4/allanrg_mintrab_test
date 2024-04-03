<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Inertia\Response
    {
        $user = $request->user();
        $people = $user->hasRole('technical') ? Person::all() : $user->people;

        return Inertia::render('People/Index', [
            'people' => $people,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('People/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request): RedirectResponse
    {
        Person::create($request->all());

        return redirect(route('people.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Person $person): \Inertia\Response
    {
        return Inertia::render('People/Show', [
            'person' => $person,
            'document_url' => Storage::url($person->document),
            'is_technical' => $request->user()->hasRole('technical'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person): \Inertia\Response
    {
        return Inertia::render('People/Edit', [
            'person' => $person,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person): RedirectResponse
    {
        $person->update($request->all());

        return redirect(route('people.show', $person));
    }

    /**
     * Approve the specified resource from storage.
     */
    public function approve(Person $person): RedirectResponse
    {
        $person->status = 'APPROVED';
        $person->save();

        return redirect(route('people.show', $person));
    }

    /**
     * Approve the specified resource from storage.
     */
    public function reject(Person $person): RedirectResponse
    {
        $person->status = 'REJECTED';
        $person->save();

        return redirect(route('people.show', $person));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person): RedirectResponse
    {
        Storage::delete($person->document);
        $person->delete();

        return redirect(route('people.index'));
    }
}
