<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Tag;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\BusinessImport;
use App\Exports\BusinessExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BusinessController extends Controller
{
    // Show businesses with filters
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = $request->input('search');
        $cityFilter = $request->input('city');
        $categoryFilter = $request->input('category');

        // Fetch only businesses belonging to the logged-in user
        $businesses = Business::where('user_id', $user->id);

        // Apply search filters
        if ($query) {
            $businesses->where('business_name', 'like', "{$query}%");
        }
        if ($cityFilter) {
            $businesses->whereHas('city', function ($q) use ($cityFilter) {
                $q->where('ville', $cityFilter);
            });
        }
        if ($categoryFilter) {
            $businesses->where('category', 'like', "%{$categoryFilter}%");
        }

        // Paginate results
        $businesses = $businesses->paginate(10);
        $cities = City::pluck('ville', 'ville');

        return view('business.index', compact('businesses', 'cities'));
    }

    // Show form to create a business
    public function create()
    {
        $cities = City::all();
        $tags = Tag::all();
        return view('business.create', compact('cities', 'tags'));
    }

    // Store a new business
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name'  => 'required|string|max:255|unique:businesses,business_name',
            'contact_email'  => 'required|email|max:255|unique:businesses,contact_email',
            'city_id'        => 'nullable|exists:cities,id',
            'location'       => 'nullable|string|max:255|unique:businesses,location',
            'website'        => 'nullable|url|max:255|unique:businesses,website',
            'category'       => 'nullable|string|max:255'
        ]);

        // Assign business to logged-in user
        $validated['user_id'] = Auth::id();

        $business = Business::create($validated);
        $business->tags()->attach($request->input('tags', []));

        return redirect()->route('business.index')->with('success', 'Business created successfully.');
    }

    // Show business details
    public function show($id)
    {
        $business = Business::where('id', $id)->where('user_id', Auth::id())->with('tasks')->first();

        if (!$business) {
            abort(403); // Prevent unauthorized access
        }

        return view('business.detail', compact('business'));
    }

    // Show form to edit a business
    public function edit(Business $business)
    {
        if ($business->user_id !== Auth::id()) {
            abort(403);
        }

        $cities = City::all();
        $tags = Tag::all();
        return view('business.edit', compact('business', 'cities', 'tags'));
    }

    // Update business details
    public function update(Request $request, Business $business)
    {
        if ($business->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'business_name'  => 'required|string|max:255|unique:businesses,business_name,' . $business->id,
            'contact_email'  => 'required|email|max:255|unique:businesses,contact_email,' . $business->id,
            'city_id'        => 'nullable|exists:cities,id',
            'location'       => 'nullable|string|max:255|unique:businesses,location,' . $business->id,
            'website'        => 'nullable|url|max:255|unique:businesses,website,' . $business->id,
            'category'       => 'nullable|string|max:255'
        ]);

        $business->update($validated);
        $business->tags()->sync($request->input('tags', []));

        return redirect()->route('business.index')->with('success', 'Business updated successfully.');
    }

    // Delete a business
    public function destroy($id)
    {
        $business = Business::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$business) {
            abort(403); // Prevent unauthorized deletion
        }

        $business->delete();
        return redirect()->route('business.index')->with('success', 'Business deleted successfully.');
    }

    // Export businesses to CSV
    public function export()
    {
        return Excel::download(new BusinessExport(), 'businesses.csv');
    }

    // Import businesses from CSV
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv',
        ]);

        $file = $request->file('file');
        Excel::import(new BusinessImport, $file);

        return redirect()->back();
    }

    // Generate PDF for business details
    public function generatePdf($id)
    {
        $business = Business::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$business) {
            abort(403);
        }

        $data = [
            'title'          => "Business Details",
            'Business_Name'  => $business->business_name,
            'Contact_Email'  => $business->contact_email,
            'Category'       => $business->category,
            'Website'        => $business->website,
            'City'           => $business->city->ville,
            'Location'       => $business->location,
        ];

        $pdf = PDF::loadView('business.detailpdf', $data);
        return $pdf->download('business-detail.pdf');
    }
}
