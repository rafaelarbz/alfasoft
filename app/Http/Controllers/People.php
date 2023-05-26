<?php

namespace App\Http\Controllers;

use App\Facades\ApiRestCountries;
use App\Http\Requests\CreateUpdatePeopleFormRequest;
use App\Models\Contact;
use App\Models\People as ModelsPeople;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class People extends Controller
{
    protected $model;
    public function __construct(ModelsPeople $people) {
        $this->model = $people;
    }
    public function index() {
        $peoples = $this->model->getAllNotDeletedPeoples();
        return view('index', compact('peoples'));
    }
    public function new() {
        return view('new');
    }
    public function details($id, Request $request) {        
        $people = $this->model->getDetails($id);

        return view('details', compact('people'));
    }
    public function create(CreateUpdatePeopleFormRequest $request): RedirectResponse {
        $this->model->create($request->all());

        if (!$request->errorBag) {
            return response()->redirectToRoute('index')->with('success', 'People created!');
        }

        return response()->redirectToRoute('new')
        ->withErrors($request)
        ->withInput();
    }
    public function update($id, CreateUpdatePeopleFormRequest $request): RedirectResponse {
        if(!$people = $this->model->find($id)) {
            return response()->redirectToRoute('index')
            ->withErrors('Contact not found!');
        }

        $people->update($request->all());

        if (!$request->errorBag) {
            return response()->redirectToRoute('index')->with('success', 'People updated!');
        }

        return response()->redirectToRoute('edit', $id)
        ->withErrors($request)
        ->withInput();
    }
    public function delete($id) {
        $this->model->find($id)->delete();
        return response()->redirectToRoute('index')->with('success', 'People deleted!');
    }
}
