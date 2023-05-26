<?php

namespace App\Http\Controllers;

use App\Facades\ApiRestCountries;
use App\Http\Requests\CreateUpdateContactFormResquest;
use App\Models\Contact as ModelsContact;
use App\Models\People;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Contact extends Controller
{
    protected $model;
    public function __construct(ModelsContact $contact) {
        $this->model = $contact;
    }
    public function new($peopleId, Request $request) {
        $people = People::find($peopleId);
        $request->search ? $countryCodes = $this->getCountryByName($request->search) : $countryCodes = $this->getAllCountries();
        return view('contact.new', compact('people', 'countryCodes'));
    }
    public function edit($id, Request $request) {
        $request->search ? $countryCodes = $this->getCountryByName($request->search) : $countryCodes = $this->getAllCountries();
        $contact = $this->model->find($id);
        return view('contact.edit', compact('contact', 'countryCodes'));
    }
    public function create($peopleId, CreateUpdateContactFormResquest $request): RedirectResponse {
   
        $this->model->create(['people_id' => $peopleId, 
                              'country_code' => $request->country_code,
                              'number' => $request->number]);

        if (!$request->errorBag) {
            return response()->redirectToRoute('details', $peopleId)->with('success', 'Contact created!');
        }

        return response()->redirectToRoute('details', $peopleId)
        ->withErrors($request)
        ->withInput();
    }
    public function update($id, CreateUpdateContactFormResquest $request): RedirectResponse {
        if(!$contact = $this->model->find($id)) {
            return response()->redirectToRoute('index')
            ->withErrors('Contact not found!');
        }

        $contact->update($request->all());

        if (!$request->errorBag) {
            return response()->redirectToRoute('details', $contact->people_id)->with('success', 'Contact updated!');
        }

        return response()->redirectToRoute('edit-contact', $id)
        ->withErrors($request)
        ->withInput();
    }
    public function delete($id) {
        $contact = $this->model->find($id);
        $peopleId = $contact->people_id;
        $contact->delete();
        return response()->redirectToRoute('details', $peopleId)->with('success', 'Contact deleted!');
    }
    public function getAllCountries() {
        return ApiRestCountries::get("/all", [])->json();
    }
    public function getCountryByName($name) {
        return ApiRestCountries::get("/name/{$name}", [])->json();
    }
}
