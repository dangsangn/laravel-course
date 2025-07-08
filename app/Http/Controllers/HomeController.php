<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeature;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use App\Models\CarImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // Maker::factory()->count(1)->hasModels(3)->create();
        // User::factory()->count(10)->unverified()->create();
        // State::factory()->count(1)->has(City::factory()->count(2))->create();
        // FuelType::factory()->count(5)->create();
        // CarType::factory()->count(5)->create();
        // City::factory()->count(10)->create();
        // CarFeature::factory()->count(1)->create();
        // User::factory()
        //     ->has(Car::factory()->count(10), 'favoriteCars')->create();

        // CarFeature::factory()->count(15)->create();

        CarImage::factory()->count(10)->has(Car::factory()->count(1))->create();
        $cars = Car::where('published_at', '<', now())
            ->with('primaryImage', 'model', 'maker', 'carType', 'fuelType', 'city')
            ->orderBy('published_at', 'desc')
            ->limit(30)
            ->get();

        // Get dynamic data for search form
        $makers = Maker::orderBy('name')->get();
        $models = Model::with('maker')->orderBy('name')->get();
        $carTypes = CarType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::with('state')->orderBy('name')->get();

        return view('home.index', compact('cars', 'makers', 'models', 'carTypes', 'fuelTypes', 'states', 'cities'));
    }
}
