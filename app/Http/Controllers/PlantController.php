<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Import the Redirect facade
use Inertia\Inertia;
use App\Models\Plant; // Make sure to import the Plant model if not already imported
use Illuminate\Support\Facades\Auth; // Import Auth facade


class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/PlantController.php

    public function index(Request $request)
    {
        $userId = Auth::id(); // Retrieve the authenticated user's ID
        $query = Plant::query();

        // Filter plants by authenticated user's ID
        $query->where('user_id', $userId);
    
        if ($request->has('searchTest')) {
            $search = $request->searchTest;
            $query->where('name', 'like', "%$search%");
        }
    
        if ($request->has('sortKey')) {
            $sortBy = $request->sortKey;
            $sortOrder = $request->sortOrder;

            $validSortColumns = [
                'name', 'species', 'watering', 'date_planted', 'soil_type', 
                'drainage', 'fertilizer', 'sunlight', 'humidity', 'notes'
            ];
            
            if (in_array($sortBy, $validSortColumns)) {
                $query->orderBy($sortBy, $sortOrder);
            }
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
        $imageName = null; // Initialize the $imageName variable to null
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;
        }

           
            Plant::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'image' => $imageName ? 'images/' . $imageName : null,
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
        $plant->user_id = Auth::user()->id;
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
