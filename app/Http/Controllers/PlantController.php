<?php

namespace App\Http\Controllers;

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
        $plants = Plant::paginate(7);

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
    public function store(Request $request)
    {
        $request->validate([
           
            'name' => ['required'],
            'species' => ['required'],
            'watering' => ['required', 'integer', 'between:0,5'],
            'datePlanted' => ['required', 'date', 'before_or_equal:today'],
            'soilType' => ['required'],
            'drainage' => ['required'],
            'fertilizer' => ['required'],
            'sunlight' => ['required' , 'integer' , 'between:0,5'],
            'humidity' => ['required'],
            'notes' => ['required']
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('plants');
            Plant::create([
                'name'=>$request->name,
            'image'=> $image
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
