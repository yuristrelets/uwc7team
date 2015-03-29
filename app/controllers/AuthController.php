<?php

class AuthController extends \BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        Auth::check() && Auth::logout();

        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'admin' => 1
        ];

        if(!Auth::attempt($credentials)) {
            return Response::make('Unauthorized', 401);
        }

        return Auth::user();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
