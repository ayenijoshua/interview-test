<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Traits\HelpsResponse;

class LoginController extends Controller
{
    use HelpsResponse;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){ 
        try{
            $v = validator($request->all(),[
                'email'=>'bail|required|exists:users,email',
                'password'=>'required'
            ]);
            if($v->fails()){
                return $this->validationErrorResponse($v);
            }
            $status = 401;
            $response = ['error'=>'Unauthorized'];
            if(Auth::attempt($request->only(['email','password']))){
                $status = 200;
                $response = [
                    'user'=>Auth::user(),
                    'token'=>Auth::user()->createToken('test')->accessToken,
                    'success'=>true
                ];
            }else{
                $response = [
                    'success'=>false,
                    'message'=>'Invalid login details'
                ];
            }
        return response()->json($response,$status);
        }catch(\Exception $e){
            return $this->exceptionErrorResponse($e);
        }
        
    }

    public function register(Request $request){
        $validator = validator($request->all(),[
            'first_name' => 'required',
            'last_name'=>'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return $this->validationErrorResponse($v);
        }
        $data = $request->only(['name','email','password']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        \Illuminate\Support\Facades\Log::info($user);
        $user->is_admin = 0;
        return response()->json([
            'user'=>$user,
            'token'=> $user->createToken('bigStore')->accessToken
        ]);
    }
}
