<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_num' => 'required|regex:/(0)[0-9]{9}/',
            'address' => 'required|string'
        ]);
    }
/*
    protected function validator(Request $d)
    {
      $data = [
        "name" => $d->name,
        "email" => $d->email,
        "password" => $d->password,
        "phone_num" => $d->phone_num,
        "address" => $d->address
      ];

        $val = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|pattern:/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_num' => 'required|regex:/(0)[0-9]{9}/',
            'address' => 'required|string'
        ]);
        return response()->json($val);
    }
*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $data)
    {

      try{
          $arr['data'] = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_num' => $data['phone_num'],
            'address' => $data['address']
        ]);

        return response()->json($arr);
      }
      catch(QueryException $a){
        return response()->json(["Error" => "something missing"], 404);
      }

    }
}
