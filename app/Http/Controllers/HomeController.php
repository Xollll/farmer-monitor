<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    // Method to load the graph page with moisture data from ThingSpeak
    public function GraphPage()
    {
        // Define the ThingSpeak API endpoint
        $channelID = 2725233;
        $apiKey = 'RL4WQU642HO5I4WD';
        $url = "https://api.thingspeak.com/channels/{$channelID}/fields/1.json?api_key={$apiKey}&results=30";
        $url2 ="https://api.thingspeak.com/channels/{$channelID}/fields/2.json?api_key={$apiKey}&results=1"; // Fetch latest pH level

        // Fetch the data from ThingSpeak
        $response = Http::get($url);
        $response2 = Http::get($url2);

        $labels = [];
        $moistureData = [];
        $PHData = null;

        if ($response->successful()) {
            $data = $response->json();

            // Prepare labels and moisture data
            
        

            foreach ($data['feeds'] as $feed) {
                if (isset($feed['field1'])) {
                    $labels[] = $feed['created_at']; // Timestamps for labels
                    $moistureData[] = $feed['field1']; // Moisture level for the data
                }
            }
        }
        


        if ($response2->successful()) {
            $data2 = $response2->json();
            if (!empty($data2['feeds']) && isset($data2['feeds'][0]['field2'])) {
                $PHData = isset($data2['feeds'][0]['field2']) ? (float)$data2['feeds'][0]['field2'] : null;
            }
        }

       // Pass moisture and pH data to the view
    return view('home')->with('labels', $labels)->with('data', $moistureData)->with('PHData', $PHData);
    
    }

    public function getChartData()
    {
        try {
            // Define the ThingSpeak API endpoint
            $channelID = 2725233;
            $apiKey = 'RL4WQU642HO5I4WD';
            $url = "https://api.thingspeak.com/channels/{$channelID}/fields/1.json?api_key={$apiKey}&results=8"; // Limit to the last 8 data points

            // Fetch the data from ThingSpeak
            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();

                // Prepare labels and moisture data
                $labels = [];
                $moistureData = [];

                foreach ($data['feeds'] as $feed) {
                    if (isset($feed['field1'])) {
                        $labels[] = $feed['created_at']; // Timestamps for labels
                        $moistureData[] = $feed['field1']; // Moisture level for the data
                    }
                }

                // Return data as JSON response
                return response()->json([
                    'labels' => $labels,
                    'data' => $moistureData,
                ]);
            }

            return response()->json(['error' => 'Failed to retrieve data from ThingSpeak'], 500);
            
        } catch (\Exception $e) {
            // Log any exceptions that occur
            Log::error('Error in getChartData: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching chart data'], 500);
        }
    }

    public function getPHData()
{
    try {
        // Define the ThingSpeak API endpoint for pH data
        $channelID = 2725233;
        $apiKey = 'RL4WQU642HO5I4WD';
        $url = "https://api.thingspeak.com/channels/{$channelID}/fields/2.json?api_key={$apiKey}&results=1"; // Only latest pH data

        // Fetch the data from ThingSpeak
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            $phLevel = !empty($data['feeds']) && isset($data['feeds'][0]['field2']) ? (float)$data['feeds'][0]['field2'] : null;

            return response()->json([
                'PHData' => $phLevel,
            ]);
        }

        return response()->json(['error' => 'Failed to retrieve pH data from ThingSpeak'], 500);

    } catch (\Exception $e) {
        Log::error('Error in getPHData: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while fetching pH data'], 500);
    }
}
}
