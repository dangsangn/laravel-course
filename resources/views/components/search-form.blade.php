<section class="find-a-car">
    <div class="container">
        <form action={{ route('cars.search') }} method={{ $method }} class="find-a-car-form card flex p-medium">
            <div class="find-a-car-inputs">
                <div>
                    <select id="makerSelect" name="maker_id">
                        <option value="">Maker</option>
                        @foreach ($makers as $maker)
                            <option value="{{ $maker->id }}"
                                {{ request('maker_id') == $maker->id ? 'selected' : '' }}>
                                {{ $maker->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="modelSelect" name="model_id">
                        <option value="" style="display: block">Model</option>
                        @foreach ($models as $model)
                            <option value="{{ $model->id }}" data-parent="{{ $model->maker_id }}"
                                style="display: none" {{ request('model_id') == $model->id ? 'selected' : '' }}>
                                {{ $model->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="car_type_id">
                        <option value="">Type</option>
                        @foreach ($carTypes as $carType)
                            <option value="{{ $carType->id }}"
                                {{ request('car_type_id') == $carType->id ? 'selected' : '' }}>
                                {{ $carType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="number" placeholder="Year From" name="year_from"
                        value="{{ request('year_from') }}" />
                </div>
                <div>
                    <input type="number" placeholder="Year To" name="year_to" value="{{ request('year_to') }}" />
                </div>
                <div>
                    <input type="number" placeholder="Price From" name="price_from"
                        value="{{ request('price_from') }}" />
                </div>
                <div>
                    <input type="number" placeholder="Price To" name="price_to"
                        value="{{ request('price_to') }}" />
                </div>
                <div>
                    <select name="fuel_type_id">
                        <option value="">Fuel Type</option>
                        @foreach ($fuelTypes as $fuelType)
                            <option value="{{ $fuelType->id }}"
                                {{ request('fuel_type_id') == $fuelType->id ? 'selected' : '' }}>
                                {{ $fuelType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="stateSelect" name="state_id">
                        <option value="">State/Region</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ request('state_id') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select id="citySelect" name="city_id">
                        <option value="" style="display: block">City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" data-parent="{{ $city->state_id }}" style="display: none" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-find-a-car-reset">
                    Reset
                </button>
                <button class="btn btn-primary btn-find-a-car-submit">
                    Search
                </button>
            </div>
        </form>
    </div>

    <script>
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
</section>
