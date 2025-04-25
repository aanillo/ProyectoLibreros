<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function showRegister(){
        return view('register');
    }


    
    public function doRegister(Request $request){
        $validator = Validator::make($request->all(), [
            "nombre" => "required|regex:/^[\pL\s]+$/u|max:30",
            "apellidos" => "required|regex:/^[\pL\s]+$/u|max:50",
            "username" => "required|regex:/^[\pL\s0-9]+$/u|min:4|max:20|unique:users,username",
            "email" => "required|email:rfc,dns|unique:users,email",
            "fecha_nacimiento" => "required|date|before_or_equal:" . now()->subYears(13)->format('Y-m-d'),
            "localidad" => "required|string|max:50",
            "password" => "required|min:8|max:20|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "password_repeat" => "required|same:password"
        ], [
            "nombre.required" => "El campo nombre es obligatorio.",
            "nombre.regex" => "El nombre solo puede contener letras y espacios.",
            "nombre.max" => "El nombre no debe superar los 30 caracteres.",
            "apellidos.required" => "El campo apellidos es obligatorio.",
            "apellidos.regex" => "Los apellidos solo pueden contener letras y espacios.",
            "apellidos.max" => "Los apellidos no deben superar los 50 caracteres.",
            "username.required" => "El username es obligatorio.",
            "username.alpha_num" => "El username solo puede contener letras, espacios y números.",
            "username.min" => "El username debe tener al menos 4 caracteres.",
            "username.max" => "El username no debe superar los 20 caracteres.",
            "username.unique" => "Este username ya está registrado.",
            "email.required" => "El campo de correo electrónico es obligatorio.",
            "email.email" => "Por favor, introduce un correo electrónico válido.",
            "email.unique" => "Este correo ya está registrado.",
            "fecha_nacimiento.required" => "Debes ingresar tu fecha de nacimiento.",
            "fecha_nacimiento.date" => "La fecha de nacimiento no es válida.",
            "fecha_nacimiento.before_or_equal" => "Debes tener al menos 13 años para registrarte.",
            "localidad.required" => "El campo localidad es obligatorio.",
            "localidad.max" => "La localidad no debe superar los 50 caracteres.",
            "password.required" => "La contraseña es obligatoria.",
            "password.min" => "La contraseña debe contener al menos 8 caracteres.",
            "password.max" => "La contraseña no debe superar los 20 caracteres.",
            "password.regex" => "La contraseña debe contener al menos una letra minúscula, una mayúscula y un dígito.",
            "password_repeat.required" => "Debes confirmar tu contraseña.",
            "password_repeat.same" => "Las contraseñas no coinciden.",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->localidad = $request->localidad;
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('login.show');
    }
    


    public function showLogin() {
        return view('login');
    }


    
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email:rfc,dns|exists:users,email",
            "password" => "required",
        ], [
            "email.required" => "El campo de correo electrónico es obligatorio.",
            "email.email" => "Por favor, introduce un correo electrónico válido.",
            "email.exists" => "El correo electrónico no está registrado.",
            "password.required" => "El campo de contraseña es obligatorio.",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
    
        if ($user) {
            
            if ($user->rol === 'admin' && $credentials['password'] === 'Admin+123') {  // Aquí puedes ajustar la contraseña si es admin
                Auth::login($user);
                return redirect()->route('admin'); 
            }
    
            
            if (Auth::attempt($credentials)) {
                return redirect()->intended('/home'); 
            }
        }
    
        return redirect()->route('login')->withErrors(['credentials' => 'Credenciales incorrectas'])->withInput();
    }
    


public function logout(){
    Auth::logout(); 
    $randomBooks = Book::all()->shuffle()->take(7);
    $randomWriters = Writer::all()->shuffle()->take(9);
    return view('home', compact('randomBooks', 'randomWriters'));
}

public function mostrarViewLogout() {
    return view('confirmLogout');
}


public function deleteUser(Request $request){
    $user = Auth::user();

    if ($user) {
        $user->delete();
        Auth::logout();
        return redirect()->route('login')->with('status', 'Tu cuenta ha sido eliminada con éxito.');
    }

    return redirect()->route('login')->withErrors(['error' => 'No se pudo eliminar tu cuenta.']);
}


public function indexUsers()
    {
        $users = User::all();
        return view('usersAdminView', compact('users'));
    }


    public function showInsert(){
        return view('insertUserView');
    }


    
    public function doInsert(Request $request){
        $validator = Validator::make($request->all(), [
            "nombre" => "required|regex:/^[\pL\s]+$/u|max:30",
            "apellidos" => "required|regex:/^[\pL\s]+$/u|max:50",
            "username" => "required|regex:/^[\pL\s0-9]+$/u|min:4|max:20|unique:users,username",
            "email" => "required|email:rfc,dns|unique:users,email",
            "fecha_nacimiento" => "required|date|before_or_equal:" . now()->subYears(13)->format('Y-m-d'),
            "localidad" => "required|string|max:50",
            "password" => "required|min:8|max:20|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "password_repeat" => "required|same:password"
        ], [
            "nombre.required" => "El campo nombre es obligatorio.",
            "nombre.regex" => "El nombre solo puede contener letras y espacios.",
            "nombre.max" => "El nombre no debe superar los 30 caracteres.",
            "apellidos.required" => "El campo apellidos es obligatorio.",
            "apellidos.regex" => "Los apellidos solo pueden contener letras y espacios.",
            "apellidos.max" => "Los apellidos no deben superar los 50 caracteres.",
            "username.required" => "El username es obligatorio.",
            "username.alpha_num" => "El username solo puede contener letras, espacios y números.",
            "username.min" => "El username debe tener al menos 4 caracteres.",
            "username.max" => "El username no debe superar los 20 caracteres.",
            "username.unique" => "Este username ya está registrado.",
            "email.required" => "El campo de correo electrónico es obligatorio.",
            "email.email" => "Por favor, introduce un correo electrónico válido.",
            "email.unique" => "Este correo ya está registrado.",
            "fecha_nacimiento.required" => "Debes ingresar tu fecha de nacimiento.",
            "fecha_nacimiento.date" => "La fecha de nacimiento no es válida.",
            "fecha_nacimiento.before_or_equal" => "Debes tener al menos 13 años para registrarte.",
            "localidad.required" => "El campo localidad es obligatorio.",
            "localidad.max" => "La localidad no debe superar los 50 caracteres.",
            "password.required" => "La contraseña es obligatoria.",
            "password.min" => "La contraseña debe contener al menos 8 caracteres.",
            "password.max" => "La contraseña no debe superar los 20 caracteres.",
            "password.regex" => "La contraseña debe contener al menos una letra minúscula, una mayúscula y un dígito.",
            "password_repeat.required" => "Debes confirmar tu contraseña.",
            "password_repeat.same" => "Las contraseñas no coinciden.",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = new User();
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->localidad = $request->localidad;
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('admin.users')->with('success', 'El usuario ha sido registrado correctamente');
    }


    public function edit($id) {
        $user = User::findOrFail($id);
        return view('editUser', compact('user'));
    }

    
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            "nombre" => "required|regex:/^[\pL\s]+$/u|max:30",
            "apellidos" => "required|regex:/^[\pL\s]+$/u|max:50",
            "username" => "required|regex:/^[\pL\s0-9]+$/u|min:4|max:20",
            "email" => "required|email:rfc,dns",
            "fecha_nacimiento" => "required|date|before_or_equal:" . now()->subYears(13)->format('Y-m-d'),
            "localidad" => "required|string|max:50",
            // Sin la validación para la contraseña porque no es necesario para el administrador
        ], [
            // Mensajes de validación...
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::findOrFail($id);
    
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->localidad = $request->localidad;
    
        if ($request->has('password') && !empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('admin.users')->with('success', 'El usuario ha sido editado correctamente');
    }
    


    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'El usuario ha sido eliminado correctamente');
        
    }
}
