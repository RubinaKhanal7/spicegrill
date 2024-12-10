<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookTable;
use App\Models\RestaurantTable;
use Illuminate\Support\Facades\Log;

class BookTableController extends Controller
{
    public function index()
    {
        $booktables = BookTable::all();
        return view('admin.booktable.index', ['booktables' => $booktables, 'page_title' => 'Book Table']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15',
            'no_of_people' => 'required|integer',
            'booking_start_time' => 'required|date',
            'table_number' => 'required|integer',
            'booking_end_time' => 'nullable|date|after:booking_start_time',
        ]);

        $isAvailable = $this->checkTableAvailability(
            $request->input('table_number'),
            $request->input('booking_start_time'),
            $request->input('booking_end_time')
        );

        if (!$isAvailable) {
            $alternativeTables = $this->getAlternativeTables(
                $request->input('no_of_people'),
                $request->input('booking_start_time'),
                $request->input('booking_end_time')
            );

            if ($alternativeTables->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This table is booked for this slot and no alternative tables are available.'
                ], 400);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'This table is booked for this slot. Please choose an alternative table.',
                    'alternativeTables' => $alternativeTables
                ], 400);
            }
        }

        $bookingData = $request->only([
            'fullname', 'phone_no', 'no_of_people', 'booking_start_time', 'table_number'
        ]);

        if ($request->filled('booking_end_time')) {
            $bookingData['booking_end_time'] = $request->input('booking_end_time');
        }

        BookTable::create($bookingData);

        return response()->json([
            'success' => true,
            'message' => 'Your table has been booked successfully!'
        ]);
    }

    private function checkTableAvailability($tableNumber, $startTime, $endTime)
    {
        $query = BookTable::where('table_number', $tableNumber)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('booking_start_time', '<', $endTime ?? $startTime)
                      ->where('booking_start_time', '>=', $startTime);
                })->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('booking_start_time', '<', $startTime)
                      ->where(function ($q) use ($startTime) {
                          $q->whereNull('booking_end_time')
                            ->orWhere('booking_end_time', '>', $startTime);
                      });
                });
            });

        return !$query->exists();
    }

    private function getAlternativeTables($noOfPeople, $startTime, $endTime)
    {
        $bookedTables = BookTable::where(function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->where('booking_start_time', '<', $endTime ?? $startTime)
                  ->where('booking_start_time', '>=', $startTime);
            })->orWhere(function ($q) use ($startTime, $endTime) {
                $q->where('booking_start_time', '<', $startTime)
                  ->where(function ($q) use ($startTime) {
                      $q->whereNull('booking_end_time')
                        ->orWhere('booking_end_time', '>', $startTime);
                  });
            });
        })->pluck('table_number')->toArray();

        return RestaurantTable::whereNotIn('table_number', $bookedTables)
            ->get();
    }

    public function getAvailableTables(Request $request)
    {
        $startTime = $request->input('booking_start_time');
        $noOfPeople = $request->input('no_of_people');

        // Get all enabled tables
        $allTables = RestaurantTable::where('is_enabled', true)
                                    ->get();

        // Get booked tables for the given time slot
        $bookedTables = BookTable::where(function($query) use ($startTime) {
            $query->where('booking_start_time', '<=', $startTime)
                  ->where(function($q) use ($startTime) {
                      $q->whereNull('booking_end_time')
                        ->orWhere('booking_end_time', '>', $startTime);
                  });
        })->pluck('table_number')->toArray();

        // Filter out booked tables
        $availableTables = $allTables->filter(function($table) use ($bookedTables) {
            return !in_array($table->table_number, $bookedTables);
        })->values();

        return response()->json($availableTables);
    }

    public function destroy($id)
    {
        $booktable = BookTable::find($id);

        if (!$booktable) {
            return redirect('admin/booktables/index')->with(['errorMessage' => 'Record not found.']);
        }

        $booktable->delete();
        return redirect('admin/booktables/index')->with(['successMessage' => 'Success!! Deleted']);
    }
}