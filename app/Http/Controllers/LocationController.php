<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Exception;

class LocationController extends Controller
{
    public function saveLocation(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        try {
            $location = new Location();
            $location->lat = $request->lat;
            $location->lon = $request->lon;
            $location->user_id = $request->user()->id;
            $location->save();

            return response()->json(['message' => 'Location saved successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to save location', 'error' => $e->getMessage()], 500);
        }
    }

    public function getUserLocations(Request $request)
    {
        try {
            $user = $request->user();
            $locations = Location::where('user_id', $user->id)->get();

            return response()->json($locations, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to fetch locations', 'error' => $e->getMessage()], 500);
        }
    }

    public function deleteLocation(Request $request, $id)
    {
        try {
            $user = $request->user();
            $location = Location::where('id', $id)->where('user_id', $user->id)->first();

            if (!$location) {
                return response()->json(['message' => 'Location not found or not authorized'], 404);
            }

            $location->delete();

            return response()->json(['message' => 'Location deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to delete location', 'error' => $e->getMessage()], 500);
        }
    }
}