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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       

        $result = $this->galenApiService->login($request->email, $request->password);

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
