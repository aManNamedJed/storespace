<?php

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Create a new customer
 *
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @return string JSON
 */
Route::post('/customers', function (Request $request) {
    try {
        $customer = App\Customer::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
        ]);
    } catch (QueryException $e) {
        // Missing some data
        if( 1048 === $e->errorInfo[1] ) {
            return response()->json(['error' => $e->errorInfo[2]], 400);
        }
        // Duplicate Entry
        if( 1062 === $e->errorInfo[1] ) {
            return response()->json(['error' => $e->errorInfo[2]], 400);
        }
    }

    return response()->json([
        'created' => true,
        'customer' => $customer,
    ], 200);
});


/**
 * Search customers by name, phone, or email
 *
 * @param  mixed  $request Instance of Illuminate\Http\Request
 * @return string  JSON
 */
Route::get('/customers/search', function (Request $request) {
    try {
        $query = $request->input('query');
        $results = App\Customer::where('first_name', 'like', "%$query%")
                           ->orWhere('last_name', 'like', "%$query%")
                           ->orWhere('phone', 'like', "%$query%")
                           ->orWhere('email', 'like', "%$query%")
                           ->get();
    } catch (QueryException $e) {
        // Missing some data
        if( 1048 === $e->errorInfo[1] ) {
            return response()->json(['error' => $e->errorInfo[2]], 400);
        }
    }

    if(!$results->count()) {
        return response()->json([], 204);
    }

    return response()->json($results, 200);
});

/**
 * Get an existing customer
 *
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @param  int $id The ID of the customer
 * @return string JSON
 */
Route::get('/customers/{id}', function (Request $request, int $id) {
    try {
        $customer = App\Customer::where('id', $id)->with('vehicles')->with('appointments')->firstOrFail();
    } catch (ModelNotFoundException $e) {
        return response()->json([], 204);
    }

    return response()->json($customer, 200);
});

/**
 * Get an existing customer's vehicles
 *
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @param  int $id The ID of the customer
 * @return string JSON
 */
Route::get('/customers/{customer_id}/vehicles', function (Request $request, int $customer_id) {
    try {
        $customer = App\Customer::findOrFail($customer_id);
    } catch (ModelNotFoundException $e) {
        return response()->json([], 204);
    }

    if( !$customer->vehicles()->count() ) {
        return response()->json([], 204);
    }

    return response()->json($customer->vehicles()->get(), 200);
});

/**
 * Create a new vehicle
 *
 * @param  int $customer_id The vehicle's customer ID
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @return string JSON
 */
Route::post('/customers/{customer_id}/vehicles', function (Request $request, int $customer_id) {
    try {
        $vehicle = App\Vehicle::create([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'color' => $request->input('color'),
            'customer_id' => $customer_id,
            'description' => $request->input('description'),
        ]);
    } catch (QueryException $e) {
        // Missing some data
        if( 1048 === $e->errorInfo[1] ) {
            return response()->json(['error' => $e->errorInfo[2]], 400);
        }
    }

    return response()->json([
        'created' => true,
        'vehicle' => $vehicle,
    ], 200);
});

/**
 * Get an existing vehicle.
 * Returns with the vehicle's Customer information.
 *
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @param  int $id The ID of the vehicle
 * @return string JSON
 */
Route::get('/vehicles/{vehicle_id}', function (Request $request, int $vehicle_id) {
    try {
        $vehicle = App\Vehicle::where('id', $vehicle_id)->with('customer')->firstOrFail();
    } catch (ModelNotFoundException $e ) {
        return response()->json([], 204);
    }

    return response()->json($vehicle, 200);
});

/**
 * Create a new appointment
 *
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @return string JSON
 */
Route::post('/appointments', function (Request $request) {
    try {
        $appointment = App\Appointment::create([
            'customer_id' => $request->input('customer_id'),
            'vehicle_id' => $request->input('vehicle_id'),
            'date_dropoff' => $request->input('date_dropoff'),
            'date_pickup' => $request->input('date_pickup'),
            'type' => $request->input('type'),
        ]);
    } catch (QueryException $e) {
        // Missing some data
        if( 1048 === $e->errorInfo[1] ) {
            return response()->json(['error' => $e->errorInfo[2]], 400);
        }
    }

    if(!$appointment) {
        return response()->json(['error' => 'There was an issue creating the appointment.'], 500);
    }

    return response()->json([
        'created' => true,
        'appointment' => $appointment,
    ], 200);
});

/**
 * Create a new mechanic
 *
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @return string JSON
 */
Route::post('/mechanics', function (Request $request) {
    try {
        $mechanic = App\Mechanic::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
        ]);
    } catch (QueryException $e) {
        // Missing some data
        if( 1048 === $e->errorInfo[1] ) {
            return response()->json(['error' => $e->errorInfo[2]], 400);
        }
        // Duplicate Entry
        if( 1062 === $e->errorInfo[1] ) {
            return response()->json(['error' => $e->errorInfo[2]], 400);
        }
    }

    if(!$mechanic) {
        return response()->json(['error' => 'There was an issue creating the mechanic.'], 500);
    }

    return response()->json([
        'created' => true,
        'mechanic' => $mechanic,
    ], 200);
});

/**
 * Get an existing mechanic
 *
 * @param  mixed $request Instance of Illuminate\Http\Request
 * @param  int $id The ID of the mechanic
 * @return string JSON
 */
Route::get('/mechanics/{id}', function (Request $request, int $id) {
    try {
        $mechanic = App\Mechanic::where('id', $id)->firstOrFail();
    } catch (ModelNotFoundException $e) {
        return response()->json([], 204);
    }

    return response()->json($mechanic, 200);
});

