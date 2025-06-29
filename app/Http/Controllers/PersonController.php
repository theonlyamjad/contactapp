<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Tag;
use App\Models\City;
use Illuminate\Http\Request;
use App\Exports\PersonExport;
use App\Imports\PersonImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Retrieve search filters
        $query = $request->input('search');
        $gender = $request->input('sex');
        $city = $request->input('city');
        $age = $request->input('age');
        $activity = $request->input('activity');

        // Fetch only people belonging to the logged-in user
        $persons = Person::where('user_id', $user->id);

        // Apply filters
        if ($query) {
            $persons->where(function ($q) use ($query) {
                $q->where('firstname', 'like', "{$query}%")
                  ->orWhere('lastname', 'like', "{$query}%");
            });
        }
        if ($gender && $gender !== 'both') {
            $persons->where('gender', $gender);
        } elseif ($gender === 'both') {
            $persons->whereIn('gender', ['male', 'female']);
        }
        if ($city) {
            $persons->where('city', $city);
        }
        if ($age) {
            $persons->where('age', $age);
        }
        if ($activity) {
            $persons->where('activity', $activity);
        }

        // Paginate results
        $persons = $persons->paginate(10);
        $cities = City::pluck('ville', 'ville');

        return view('person.index', compact('persons', 'cities'));
    }

    public function create()
    {
        $cities = City::all();
        $tags = Tag::all();
        return view('person.create', compact('cities', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'nullable|email|unique:people,email',
            'phone' => 'nullable|unique:people,phone',
            'business_name' => 'nullable|string|max:255',
            'activity' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'age' => 'nullable|integer|min:1|max:100',
        ]);

        $person = new Person($validated);
        $person->user_id = Auth::id();
        $person->save();

        $person->tags()->sync($request->input('tags'));

        return redirect(route('person.index'));
    }

    public function show(Person $person)
    {
        return view('person.detail', compact('person'));
    }

    public function edit(Person $person)
    {
        if ($person->user_id !== Auth::id()) {
            abort(403);
        }

        $cities = City::all();
        $tags = Tag::all();
        return view('person.edit', compact('person', 'cities', 'tags'));
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'nullable|email|unique:people,email,' . $person->id,
            'phone' => 'nullable|unique:people,phone,' . $person->id,
            'business_name' => 'nullable|string|max:255',
            'activity' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'age' => 'nullable|integer|min:1|max:100',
        ]);

        $person->update($validated);
        $person->tags()->sync($request->input('tags'));

        return redirect(route('person.index'));
    }

    public function destroy($id)
    {
        $person = Person::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $person->delete();
        return redirect()->route('person.index')->with('success', 'Personne supprimée avec succès');
    }

    public function export()
    {
        return Excel::download(new PersonExport, 'persons.csv');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv']);
        Excel::import(new PersonImport, $request->file('file'));
        return redirect()->back();
    }

    public function generatePdf($id)
    {
        $person = Person::findOrFail($id);

        $data = [
            'title' => "Détails de la personne",
            'firstname' => $person->firstname,
            'lastname' => $person->lastname,
            'age' => $person->age,
            'gender' => $person->gender,
            'email' => $person->email,
            'phone' => $person->phone,
            'business_name' => $person->business_name,
            'city' => $person->city,
            'activity' => $person->activity,
        ];

        $pdf = PDF::loadView('person.detailpdf', $data);
        return $pdf->download('details-personne.pdf');
    }
}
