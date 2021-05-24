<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\RequestValidators\AuthLoginRequest;
use App\Http\RequestValidators\AuthRegisterRequest;
use App\Interfaces\AuthProcessImplementationInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthenticationController extends Controller
{

    /**
     * @var AuthProcessImplementationInterface
     */
    private $auth_process;

    public function __construct(AuthProcessImplementationInterface $auth_process)
    {
        $this->auth_process = $auth_process;
    }

    /**
     * Login view
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Registration view
     */
    public function registration()
    {
        return view('auth.register');
    }

    /**
     * Do login process
     */
    public function process_login(AuthLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Process registration flow
     */
    public function process_registration(AuthRegisterRequest $request)
    {
        $data = $request->all();
        $this->auth_process->create_user($data);
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    /**
     * Show Dashboard
     */
    public function dashboard()
    {
        return view('dashboard', ['user' => auth()->user()]);
    }

    /**
     * Do logout
     */
    public function logout()
    {
        session()->flush();
        Auth::logout();

        return Redirect('login');

    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        setcookie("jwt_token", $token);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
