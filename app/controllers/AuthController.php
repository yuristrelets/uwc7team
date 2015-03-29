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

        $credentials = Input::only('email', 'password');
        $credentials['admin'] = 1;

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
        if($user = Auth::check()) {
            if($user->id === $id) Auth::logout();
        }
    }


}
