<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GalenApiService;

class GalenController extends Controller
{
    protected $galenApiService;

    public function __construct(GalenApiService $galenApiService)
    {
        $this->galenApiService = $galenApiService;
    }

    public function login(Request $request)
    {
        // Validate the JSON input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Extract email and password from the validated data
        $email = $validatedData['email'];
        $password = $validatedData['password'];

        // Call the Galen API service with the extracted data
        $result = $this->galenApiService->login($email, $password);

        // Return the result as a JSON response
        if ($result) {
            return response()->json($result);
        } else {
            return response()->json(['error' => 'Login failed'], 401);
        }
    }


    public function helloworld(Request $request)
    {
      return  $this->galenApiService->helloworld();
    }
}
?>
