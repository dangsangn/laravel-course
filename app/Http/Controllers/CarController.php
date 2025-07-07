<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(1);

        if ($user) {
            $cars = $user->cars()->with('primaryImage', 'model', 'maker',)->orderBy('created_at', 'desc')->get();
        } else {
            $cars = [];
        }
        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('cars.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return view('cars.edit', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = Car::where('published_at', '<', now())->with('primaryImage', 'model', 'maker', 'carType', 'fuelType', 'city')->orderBy('published_at', 'desc');

        $cars = $query->paginate(5);

        return view('cars.search', ['cars' => $cars]);
    }

    public function watchedList()
    {
        $user = User::find(1);
        if ($user) {
            $cars = $user->favoriteCars()->with('primaryImage', 'model', 'maker', 'carType', 'fuelType', 'city')->get();
        } else {
            $cars = [];
        }
        return view('cars.watched-list', ['cars' => $cars]);
    }
}
