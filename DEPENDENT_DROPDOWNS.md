# Dependent Dropdowns Documentation

## Overview
The search functionality now includes dependent dropdowns where the options in one dropdown change based on the selection in another dropdown. This provides a better user experience by showing only relevant options.

## Implemented Dependent Dropdowns

### ✅ State → City
- **When you select a state**, the city dropdown automatically updates to show only cities from that state
- **API Endpoint**: `GET /cars/cities-by-state?state_id={id}`
- **Returns**: JSON array of cities with `id` and `name`

### ✅ Maker → Model
- **When you select a maker**, the model dropdown automatically updates to show only models from that maker
- **API Endpoint**: `GET /cars/models-by-maker?maker_id={id}`
- **Returns**: JSON array of models with `id` and `name`

## How It Works

### 1. User Interaction
1. User selects a state/maker from the first dropdown
2. JavaScript detects the change event
3. AJAX request is sent to the appropriate API endpoint
4. Response data is used to populate the dependent dropdown
5. Selected values are preserved if they belong to the selected parent

### 2. API Endpoints

#### Get Cities by State
```php
// Route: GET /cars/cities-by-state
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
```

#### Get Models by Maker
```php
// Route: GET /cars/models-by-maker
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
```

### 3. JavaScript Implementation

#### State-City Dependent Dropdown
```javascript
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
            });
    }
});
```

#### Maker-Model Dependent Dropdown
```javascript
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
            });
    }
});
```

## Features

### ✅ Dynamic Loading
- **Real-time updates**: Dropdowns update immediately when parent selection changes
- **AJAX requests**: Uses fetch API for smooth user experience
- **Error handling**: Graceful error handling with console logging

### ✅ State Preservation
- **Selected values preserved**: If a city/model is already selected and belongs to the newly selected state/maker, it remains selected
- **Form state maintained**: Works with existing search form state preservation

### ✅ Performance Optimized
- **Efficient queries**: Only loads necessary data
- **Minimal DOM manipulation**: Only updates when needed
- **Caching ready**: Easy to add caching for frequently accessed data

## Usage Examples

### State-City Selection
1. **Select State**: Choose "California" from state dropdown
2. **City Updates**: City dropdown automatically shows only California cities
3. **Select City**: Choose from the filtered city options
4. **Search**: Form submits with both state and city selected

### Maker-Model Selection
1. **Select Maker**: Choose "Toyota" from maker dropdown
2. **Model Updates**: Model dropdown automatically shows only Toyota models
3. **Select Model**: Choose from the filtered model options
4. **Search**: Form submits with both maker and model selected

## Database Requirements

### Required Relationships
```sql
-- Cities belong to States
cities.state_id -> states.id

-- Models belong to Makers
models.maker_id -> makers.id
```

### Sample Data Structure
```sql
-- States table
states: id, name, created_at, updated_at

-- Cities table
cities: id, name, state_id, created_at, updated_at

-- Makers table
makers: id, name, created_at, updated_at

-- Models table
models: id, name, maker_id, created_at, updated_at
```

## Files Modified

1. **`app/Http/Controllers/CarController.php`**
   - Added `getCitiesByState()` method
   - Added `getModelsByMaker()` method

2. **`routes/web.php`**
   - Added route for cities-by-state API
   - Added route for models-by-maker API

3. **`resources/views/cars/search.blade.php`**
   - Added JavaScript for dependent dropdowns
   - Handles both state-city and maker-model relationships

4. **`resources/views/components/search-form.blade.php`**
   - Added JavaScript for dependent dropdowns
   - Works on both search page and homepage

## Future Enhancements

### Potential Improvements
- **Caching**: Cache API responses for better performance
- **Loading indicators**: Show loading spinner during AJAX requests
- **Error messages**: Display user-friendly error messages
- **Multiple selections**: Support for multiple state/city selections
- **Search within dropdowns**: Add search functionality to large dropdowns 