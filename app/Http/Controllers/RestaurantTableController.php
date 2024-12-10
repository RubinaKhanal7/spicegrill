<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTable;
use App\Models\BookTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RestaurantTableController extends Controller
{
    public function index()
    {
        $tables = RestaurantTable::all();
        return view('admin.restaurant_tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.restaurant_tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer|unique:restaurant_tables',
            'capacity' => 'nullable|integer|min:1',
        ]);

        RestaurantTable::create($request->all());

        return redirect()->route('RestaurantTables.index')->with('success', 'Table created successfully.');
    }

    public function edit(RestaurantTable $restaurantTable, $id)
    {
        $restaurantTable = RestaurantTable::findOrFail($id);
        return view('admin.restaurant_tables.update', compact('restaurantTable'));
    }

    public function update(Request $request, RestaurantTable $restaurantTable)
    {
        $validated = $request->validate([
            'table_number' => 'required|integer|unique:restaurant_tables,table_number,' . $restaurantTable->id,
            'capacity' => 'nullable|integer|min:1',
        ]);
        $restaurantTable->update([
            'table_number' => $validated['table_number'],
            'capacity' => $validated['capacity'],
        ]);
        return redirect()->route('RestaurantTables.index')->with('success', 'Table updated successfully.');
    }
    
    public function destroy($id)
    {
        $table = RestaurantTable::findOrFail($id);
        $table->delete();

        return redirect()->route('RestaurantTables.index')->with('success', 'Table deleted successfully.');
    }

    public function toggleTableStatus(Request $request, $id)
    {
        $table = RestaurantTable::findOrFail($id);
        $table->is_enabled = !$table->is_enabled;
        $table->save();

        return redirect()->route('RestaurantTables.index')->with('success', 'Table status updated successfully.');
    }
    public function updateSingleTableStatus($tableId)
    {
            $table = RestaurantTable::findOrFail($tableId);
            $table->is_enabled = !$table->is_enabled;
            $table->save();
    
            return redirect()->route('RestaurantTables.index')->with('success', 'Table status updated successfully.');
    }
    
    public function updateAllTablesStatus()
{
        $updated = RestaurantTable::where('is_enabled', false)->update(['is_enabled' => true]);

        return redirect()->route('RestaurantTables.index')->with('success', 'Table status updated successfully.');
    
}

    public function getAvailableTables(Request $request)
    {
        $request->validate([
            'booking_start_time' => 'required|date_format:Y-m-d H:i:s',
            'no_of_people' => 'required|integer|min:1',
        ]);

        $startTime = $request->input('booking_start_time');
        $noOfPeople = $request->input('no_of_people');
        $endTime = date('Y-m-d H:i:s', strtotime($startTime));

        $availableTables = RestaurantTable::where('is_enabled', true)
            ->whereDoesntHave('bookings', function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->whereBetween('booking_start_time', [$startTime, $endTime])
                      ->orWhereBetween('booking_end_time', [$startTime, $endTime])
                      ->orWhere(function ($q) use ($startTime, $endTime) {
                          $q->where('booking_start_time', '<=', $startTime)
                            ->where('booking_end_time', '>=', $endTime);
                      });
                });
            })
            ->get();

        return response()->json($availableTables);
    }
}
