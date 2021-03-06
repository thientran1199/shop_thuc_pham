<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\Request;
use App\Models\Khachhang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' =>'required|unique:users,name',
            'email' =>'required|unique:users,email|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})^',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' =>'required|same:password',
            'txtname' =>'required|unique:khachhang,khachhang_ten',
            'txtphone' =>'required',
            'txtadr' =>'required'
        ];

        $messages = [
            'required'=> 'Vui l??ng kh??ng ????? tr???ng tr?????ng n??y!',
            'name.unique'   =>'D??? li???u n??y ???? t???n t???i!',
            'txtname.unique'   =>'D??? li???u n??y ???? t???n t???i!',
            'email.unique'  =>'D??? li???u n??y ???? t???n t???i!',
            'email.regex'  =>'Email kh??ng ????ng ?????nh d???ng!',
            'password_confirmation.same' =>'M???t kh???u kh??ng tr??ng kh???p!'
        ];

        return Validator::make($data,$rules,$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'loainguoidung_id' => 2,
        ]);
        // $id = DB::table('users')->select('id')->where('email',$data['email'])->first();
        // print_r($id);
        Khachhang::create([
            'khachhang_ten' => $data['txtname'],
            'khachhang_email' => $data['email'],
            'khachhang_sdt' => $data['txtphone'],
            'khachhang_dia_chi' => $data['txtadr'],
            'user_id' => $user->id,
        ]);
        return $user;
        // return view('backend.dashboard');
    }

    public function getLogin()
    {
        return view('backend.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password, 'loainguoidung_id'=>2])) {
            // Authentication passed...
            return redirect()->route('admin.index');
        }
        else {
            return redirect()->back();
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
        // $data = Auth::user()->loainguoidung_id;
        // if ($data == 2) {
        //     Auth::logout();
        //     return redirect('/');
        // } else {
        //     Auth::logout();
        //     return redirect()->route('admin.login.getLogin');
        // }
    }

}
