<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::latest()->filter($request->toArray())->paginate(20);

        return view('listings.index', ['listings' => $listings]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $details = $request->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'website' => 'required',
            'location' => 'required',
            'email' => ['required', 'email']
        ]);

        if($request->hasFile('logo')) {

            $details['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $details['user_id'] = auth()->id();

        if(Listing::create($details)) {

            return redirect('/')->with('message', 'job created successfully!');
        }
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing'=> $listing]);
    }

    public function update(Request $request, Listing $listing)
    {
        $details = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'website' => 'required',
            'location' => 'required',
            'email' => ['required', 'email']
        ]);

        if($request->hasFile('logo')) {

            $details['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if($listing->update($details)) {
            return redirect('/listings/manage')->with('message', 'list updated successfully!');
        }
    }

    public function destroy(Listing $listing)
    {
        if($listing->delete()) {

            return redirect('/listings/manage')->with('message', 'job deleted successfully!');
        }
    }

    public function manage()
    {
        $listings = auth()->user()->listings()->paginate(12);

        return view('listings.manage', ['listings' => $listings]);
    }
}

