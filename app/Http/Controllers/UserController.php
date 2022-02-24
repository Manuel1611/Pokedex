<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Requests\UsereditEditRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('verified')->only(['userupdate', 'useredit']);
        $this->middleware('admin')->except(['userupdate', 'useredit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', ['roles' => ['Usuario', 'Entrenador']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User($request->all());
        $user->password = Hash::make($request->input('password'));
        if($request->verified == 'true') {
            $user->email_verified_at = Carbon::now();
        }
        try {
            $user->save();
            if($request->verified != 'true') {
                $user->sendEmailVerificationNotification();
            }
        } catch(\Exception $e) {
            return back()->withInput();
        }
        return redirect(url('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', ['roles' => ['Usuario', 'Entrenador'], 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        if($request->password == null) {
            $data = $request->except(['password']);
        } else {
            $data = $request->all();
            $data['password'] = Hash::make($request->input('password'));
        }
        try {
            $user->update($data);
        } catch(\Exception $e) {
            return back()->withInput();
        }
        return redirect(url('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    public function useredit() {
        return view('user.useredit');
    }
    
    public function userupdate(UsereditEditRequest $request) {
        if($request->password != null && $request->oldpassword != null) {
            // Vamos a cambiar la clave
            $r = Hash::check($request->oldpassword, auth()->user()->password);
            if($r) {
                $result = $this->userSave($request, true);
            } else {
                // Error
                return back()->withInput()->withErrors(['oldpassword' => 'La clave de acceso antigua no es correcta']);
            }
        } else if($request->password == null && $request->oldpassword == null) {
            $result = $this->userSave($request, false);
        } else {
            // Error
            $data = ['message' => 'No se ha podido actualizar tu perfil. Se han de introducir las tres claves de acceso o ninguna'];
            return back()->withInput()->with($data);
        }
        
        if(!$result) {
            $data = ['message' => 'No se ha podido actualizar tu perfil'];
        } else {
            $data = ['message' => 'Tu perfil se ha actualizado correctamente'];
        }
        return redirect(url('/base'))->with($data);
    }
    
    private function userSave(Request $request, $isNewPassword) {
        $result = true;
        $user = auth()->user();
        $user->name = $request->input('name');
        
        if($user->email != $request->input('email')) {
            $user->email = $request->input('email');
            // Anulamos la fecha de verificación
            $user->email_verified_at = null;
        }
        
        if($isNewPassword) {
            $user->password = Hash::make($request->input('password'));
        }
        
        try {
            $user->save();
            // Enviar un correo electrónico de verificación
            $user->sendEmailVerificationNotification();
        } catch(\Exception $e) {
            $result = false;
        }
        return $result;
    }
}
