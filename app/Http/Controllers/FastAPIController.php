<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FastAPIController extends Controller
{
    public function getDataFromFastAPI()
    {
        // Create a Guzzle HTTP client
        $client = new Client();

        // Send a GET request to the FastAPI endpoint
        $response = $client->get('http://127.0.0.1:8001/data');

        // Get the body of the response
        $data = json_decode($response->getBody(), true);

        // Return or use the data Laravel app
        return view('data', ['data' => $data]);
    }

    public function createUserInFastAPI()
    {
        $client = new Client();
        
        // Define the FastAPI endpoint and the data to send
        $url = 'http://127.0.0.1:8001/users';
        $data = [
            'name' => 'Alice',
            'age' => 30
        ];
        
        // Send the POST request
        $response = $client->post($url, [
            'json' => $data
        ]);

        // Decode and use the response data
        $responseData = json_decode($response->getBody(), true);

        return view('user', ['data' => $responseData]);
    }
    
    public function showUser()
    {
        $client = new Client();
        $url = 'http://127.0.0.1:8001/users'; // Make sure this is the correct FastAPI endpoint

        $response = $client->get($url);
        $userData = json_decode($response->getBody(), true);

        // Pass the user data to the view
        return view('user', ['user' => $userData]);
    }

}