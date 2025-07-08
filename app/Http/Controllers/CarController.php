<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
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
            $cars = $user->cars()->with('primaryImage', 'model', 'maker',)->orderBy('created_at', 'desc')->simplePaginate(2);
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
        $query = Car::where('published_at', '<', now())
            ->with('primaryImage', 'model', 'maker', 'carType', 'fuelType', 'city')
            ->orderBy('published_at', 'desc');

        // Filter by maker
        if ($request->filled('maker_id')) {
            $query->where('maker_id', $request->maker_id);
        }

        // Filter by model
        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }

        // Filter by car type
        if ($request->filled('car_type_id')) {
            $query->where('car_type_id', $request->car_type_id);
        }

        // Filter by fuel type
        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }

        // Filter by year range
        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }
        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        // Filter by price range
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Filter by mileage
        if ($request->filled('mileage')) {
            $query->where('mileage', '<=', $request->mileage);
        }

        // Filter by state
        if ($request->filled('state_id')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('state_id', $request->state_id);
            });
        }

        // Filter by city
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Handle sorting
        $sortBy = $request->get('sort', 'published_at');
        $sortOrder = $request->get('order', 'desc');

        if ($sortBy === 'price') {
            $query->orderBy('price', $sortOrder);
        } else {
            $query->orderBy('published_at', 'desc');
        }

        $cars = $query->paginate(12)->withQueryString();

        // Get dynamic data for search form
        $makers = Maker::orderBy('name')->get();
        $models = Model::with('maker')->orderBy('name')->get();
        $carTypes = CarType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::with('state')->orderBy('name')->get();

        return view('cars.search', compact('cars', 'makers', 'models', 'carTypes', 'fuelTypes', 'states', 'cities'));
    }

    public function watchedList()
    {
        $user = User::find(1);
        if ($user) {
            $cars = $user->favoriteCars()->with('primaryImage', 'model', 'maker', 'carType', 'fuelType', 'city')->paginate(2);
        } else {
            $cars = [];
        }
        return view('cars.watched-list', ['cars' => $cars]);
    }

    public function getCitiesByState(Request $request)
    {
        $stateId = $request->get('state_id');

        if (!$stateId) {
            return response()->json([]);
        }

        $cities = City::where('state_id', $stateId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($cities);
    }

    public function getModelsByMaker(Request $request)
    {
        $makerId = $request->get('maker_id');

        if (!$makerId) {
            return response()->json([]);
        }

        $models = Model::where('maker_id', $makerId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($models);
    }
}
