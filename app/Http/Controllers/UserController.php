<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(StoreUserPost $request)
    {
        //User::create($request->all());

        //return redirect()->route('users.index')
        //    ->withErro('Erro ao salvar');
        $user = UserService::store($request->all());

        if ($user) {
            return redirect()->route('users.index')
                ->withSucesso('Salvo com sucesso');
        }

        return redirect()->route('users.index')
                ->withErro('Ocorreu um erro ao salvar');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
