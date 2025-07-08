@props(['cars', 'makers', 'models', 'carTypes', 'fuelTypes', 'states', 'cities'])

<x-app-layout title="Search Cars">
     <main>
    <!-- Found Cars -->
    <section>
      <div class="container">
        <div class="sm:flex items-center justify-between mb-medium">
          <div class="flex items-center">
            <button class="show-filters-button flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" style="width: 20px">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
              </svg>
              Filters
            </button>
            <h2>Define your search criteria</h2>
          </div>

          <select class="sort-dropdown" onchange="updateSort(this.value)">
            <option value="">Order By</option>
            <option value="price" {{ request('sort') == 'price' && request('order') == 'asc' ? 'selected' : '' }}>Price Asc</option>
            <option value="-price" {{ request('sort') == 'price' && request('order') == 'desc' ? 'selected' : '' }}>Price Desc</option>
          </select>
        </div>
        <div class="search-car-results-wrapper">
          <div class="search-cars-sidebar">
            <div class="card card-found-cars">
              <p class="m-0">Found <strong>{{$cars->total()}}</strong> cars</p>

              <button class="close-filters-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px">
                  <path fill-rule="evenodd"
                    d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
                </svg>
              </button>
            </div>

            <!-- Find a car form -->
            <section class="find-a-car">
              <form action="{{ route('cars.search') }}" method="GET" class="find-a-car-form card flex p-medium">
                <div class="find-a-car-inputs">
                  <div class="form-group">
                    <label class="mb-medium">Maker</label>
                    <select id="makerSelect" name="maker_id">
                      <option value="">Maker</option>
                      @foreach($makers as $maker)
                        <option value="{{ $maker->id }}" {{ request('maker_id') == $maker->id ? 'selected' : '' }}>
                          {{ $maker->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">Model</label>
                    <select id="modelSelect" name="model_id">
                      <option value="" style="display: block" {{ request('model_id') == '' ? 'selected' : '' }}>Model</option>
                      @foreach($models as $model)
                        <option value="{{ $model->id }}" data-parent="{{ $model->maker_id }}" style="display: none" {{ request('model_id') == $model->id ? 'selected' : '' }}>
                          {{ $model->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">Type</label>
                    <select name="car_type_id">
                      <option value="">Type</option>
                      @foreach($carTypes as $carType)
                        <option value="{{ $carType->id }}" {{ request('car_type_id') == $carType->id ? 'selected' : '' }}>
                          {{ $carType->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">Year</label>
                    <div class="flex gap-1">
                      <input type="number" placeholder="Year From" name="year_from" value="{{ request('year_from') }}" />
                      <input type="number" placeholder="Year To" name="year_to" value="{{ request('year_to') }}" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">Price</label>
                    <div class="flex gap-1">
                      <input type="number" placeholder="Price From" name="price_from" value="{{ request('price_from') }}" />
                      <input type="number" placeholder="Price To" name="price_to" value="{{ request('price_to') }}" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">Mileage</label>
                    <div class="flex gap-1">
                      <select name="mileage">
                        <option value="">Any Mileage</option>
                        <option value="10000" {{ request('mileage') == '10000' ? 'selected' : '' }}>10,000 or less</option>
                        <option value="20000" {{ request('mileage') == '20000' ? 'selected' : '' }}>20,000 or less</option>
                        <option value="30000" {{ request('mileage') == '30000' ? 'selected' : '' }}>30,000 or less</option>
                        <option value="40000" {{ request('mileage') == '40000' ? 'selected' : '' }}>40,000 or less</option>
                        <option value="50000" {{ request('mileage') == '50000' ? 'selected' : '' }}>50,000 or less</option>
                        <option value="60000" {{ request('mileage') == '60000' ? 'selected' : '' }}>60,000 or less</option>
                        <option value="70000" {{ request('mileage') == '70000' ? 'selected' : '' }}>70,000 or less</option>
                        <option value="80000" {{ request('mileage') == '80000' ? 'selected' : '' }}>80,000 or less</option>
                        <option value="90000" {{ request('mileage') == '90000' ? 'selected' : '' }}>90,000 or less</option>
                        <option value="100000" {{ request('mileage') == '100000' ? 'selected' : '' }}>100,000 or less</option>
                        <option value="150000" {{ request('mileage') == '150000' ? 'selected' : '' }}>150,000 or less</option>
                        <option value="200000" {{ request('mileage') == '200000' ? 'selected' : '' }}>200,000 or less</option>
                        <option value="250000" {{ request('mileage') == '250000' ? 'selected' : '' }}>250,000 or less</option>
                        <option value="300000" {{ request('mileage') == '300000' ? 'selected' : '' }}>300,000 or less</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">State</label>
                    <select id="stateSelect" name="state_id">
                      <option value="">State/Region</option>
                      @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
                          {{ $state->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">City</label>
                    <select id="citySelect" name="city_id">
                      <option value="" style="display: block">City</option>
                      @foreach($cities as $city)
                        <option value="{{ $city->id }}" data-parent="{{ $city->state_id }}" style="display: none" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                          {{ $city->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="mb-medium">Fuel Type</label>
                    <select name="fuel_type_id">
                      <option value="">Fuel Type</option>
                      @foreach($fuelTypes as $fuelType)
                        <option value="{{ $fuelType->id }}" {{ request('fuel_type_id') == $fuelType->id ? 'selected' : '' }}>
                          {{ $fuelType->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="flex">
                  <button type="button" class="btn btn-find-a-car-reset">
                    Reset
                  </button>
                  <button class="btn btn-primary btn-find-a-car-submit">
                    Search
                  </button>
                </div>
              </form>
            </section>
            <!--/ Find a car form -->
          </div>

          <div class="search-cars-results">
            <div class="car-items-listing">
              @forelse ($cars as $car)
                <x-car-item :$car />
              @empty
                <p>No cars found.</p>
              @endforelse
            </div>
            {{ $cars->onEachSide(1)->links() }}
          </div>
        </div>
      </div>
    </section>
    <!--/ Found Cars -->
  </main>

  <script>
    function updateSort(value) {
      const url = new URL(window.location);
      if (value === '') {
        url.searchParams.delete('sort');
        url.searchParams.delete('order');
      } else if (value === 'price') {
        url.searchParams.set('sort', 'price');
        url.searchParams.set('order', 'asc');
      } else if (value === '-price') {
        url.searchParams.set('sort', 'price');
        url.searchParams.set('order', 'desc');
      }
      window.location.href = url.toString();
    }

    // Handle dependent dropdowns for state and city
    document.addEventListener('DOMContentLoaded', function() {
      const stateSelect = document.getElementById('stateSelect');
      const citySelect = document.getElementById('citySelect');
      const makerSelect = document.getElementById('makerSelect');
      const modelSelect = document.getElementById('modelSelect');
      
      // Handle state-city dependent dropdowns
      if (stateSelect && citySelect) {
        stateSelect.addEventListener('change', function() {
          const stateId = this.value;
          const cityId = '{{ request("city_id") }}';
          
          // Clear city options
          citySelect.innerHTML = '<option value="" style="display: block">City</option>';
          
          if (stateId) {
            // Fetch cities for selected state
            fetch(`{{ route('cars.cities-by-state') }}?state_id=${stateId}`)
              .then(response => response.json())
              .then(cities => {
                cities.forEach(city => {
                  const option = document.createElement('option');
                  option.value = city.id;
                  option.textContent = city.name;
                  option.style.display = 'none';
                  option.setAttribute('data-parent', stateId);
                  
                  // Preserve selected city if it belongs to the selected state
                  if (cityId == city.id) {
                    option.selected = true;
                  }
                  
                  citySelect.appendChild(option);
                });
              })
              .catch(error => {
                console.error('Error fetching cities:', error);
              });
          }
        });

        // Trigger change event if state is pre-selected
        if (stateSelect.value) {
          stateSelect.dispatchEvent(new Event('change'));
        }
      }

      // Handle maker-model dependent dropdowns
      if (makerSelect && modelSelect) {
        makerSelect.addEventListener('change', function() {
          const makerId = this.value;
          const modelId = '{{ request("model_id") }}';
          
          // Clear model options
          modelSelect.innerHTML = '<option value="" style="display: block">Model</option>';
          
          if (makerId) {
            // Fetch models for selected maker
            fetch(`{{ route('cars.models-by-maker') }}?maker_id=${makerId}`)
              .then(response => response.json())
              .then(models => {
                models.forEach(model => {
                  const option = document.createElement('option');
                  option.value = model.id;
                  option.textContent = model.name;
                  option.style.display = 'none';
                  option.setAttribute('data-parent', makerId);
                  
                  // Preserve selected model if it belongs to the selected maker
                  if (modelId == model.id) {
                    option.selected = true;
                  }
                  
                  modelSelect.appendChild(option);
                });
              })
              .catch(error => {
                console.error('Error fetching models:', error);
              });
          }
        });

        // Trigger change event if maker is pre-selected
        if (makerSelect.value) {
          makerSelect.dispatchEvent(new Event('change'));
        }
      }
    });
  </script>
</x-app-layout>
