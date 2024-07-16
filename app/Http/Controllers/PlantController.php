<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Import the Redirect facade
use Inertia\Inertia;
use App\Models\Plant; // Make sure to import the Plant model if not already imported


class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/PlantController.php

    public function index(Request $request)
    {
        $query = Plant::query();

        if ($request->has('searchTest')) {
            $search = $request->searchTest;
            $query->where('name', 'like', "%$search%");
        }

        $plants = $query->paginate(7);

        return Inertia::render('Home', [
            'plants' => $plants,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Plants/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantsRequest $request)
    {
        $user = $request->user();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;

            Plant::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'image' => 'images/' . $imageName,
            'species' => $request->species,
            'watering' => $request->watering,
            'date_planted' => $request->date_planted,
            'soil_type' => $request->soil_type,
            'drainage' => $request->drainage,
            'fertilizer' => $request->fertilizer,
            'sunlight' => $request->sunlight,
            'humidity' => $request->humidity,
            'notes' => $request->notes,
        ]);

            return Redirect::route('plants.index');
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePlantsRequest $request, string $id)
    {

        // Find the plant by ID
        $plant = Plant::findOrFail($id);

        // Update the plant's attributes
        $plant->name = $request->input('name');
        $plant->species = $request->input('species');
        $plant->watering = $request->input('watering');
        $plant->date_planted = $request->input('date_planted');
        $plant->soil_type = $request->input('soil_type');
        $plant->drainage = $request->input('drainage');
        $plant->fertilizer = $request->input('fertilizer');
        $plant->sunlight = $request->input('sunlight');
        $plant->humidity = $request->input('humidity');
        $plant->notes = $request->input('notes');

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image= $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $plant->image = 'images/' . $imageName;
        }

        // Save the updated plant
        $plant->save();

        // Return a response, redirect to index or other view
        return redirect()->route('plants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
