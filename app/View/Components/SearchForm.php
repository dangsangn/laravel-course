<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action = '/cars/search',
        public string $method = 'GET',
        public $makers = null,
        public $models = null,
        public $carTypes = null,
        public $fuelTypes = null,
        public $states = null,
        public $cities = null,
    )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // If no data is provided, fetch from database
        if (!$this->makers) {
            $this->makers = \App\Models\Maker::orderBy('name')->get();
        }
        if (!$this->models) {
            $this->models = \App\Models\Model::with('maker')->orderBy('name')->get();
        }
        if (!$this->carTypes) {
            $this->carTypes = \App\Models\CarType::orderBy('name')->get();
        }
        if (!$this->fuelTypes) {
            $this->fuelTypes = \App\Models\FuelType::orderBy('name')->get();
        }
        if (!$this->states) {
            $this->states = \App\Models\State::orderBy('name')->get();
        }
        if (!$this->cities) {
            $this->cities = \App\Models\City::with('state')->orderBy('name')->get();
        }

        return view('components.search-form', [
            'action' => $this->action,
            'method' => $this->method,
            'makers' => $this->makers,
            'models' => $this->models,
            'carTypes' => $this->carTypes,
            'fuelTypes' => $this->fuelTypes,
            'states' => $this->states,
            'cities' => $this->cities,
        ]);
    }
}
