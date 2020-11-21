<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\StoreUserPost;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
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

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user = UserService::update($request->all(), $user);

        if ($user) {
            return redirect()->route('users.index')
                ->withSucesso('Atualizado com sucesso');
        }

        return redirect()->route('users.edit', $user)
                ->withErro('Ocorreu um erro ao atualizar');
    }

    public function destroy(User $user)
    {
        $user = UserService::destroy($user);

        if ($user) {
            return redirect()->route('users.index')
                ->withSucesso('Excluído com sucesso');
        }

        return redirect()->route('users.show', $user)
                ->withErro('Ocorreu um erro ao excluir');
    }
}
