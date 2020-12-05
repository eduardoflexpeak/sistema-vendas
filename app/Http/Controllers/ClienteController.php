<?php

namespace App\Http\Controllers;

use App\DataTables\ClienteDataTable;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(ClienteDataTable $clienteDataTable)
    {
        return $clienteDataTable->render('clientes.index');
    }

    public function create()
    {
        return view('clientes.form');
    }

    public function store(Request $request)
    {
        $cliente = ClienteService::store($request->all());

        if ($cliente) {
            return redirect()->route('clientes.index')
                ->withSucesso('Salvo com sucesso');
        }

        return redirect()->route('clientes.create')
                ->withErro('Ocorreu um erro ao salvar');
    }

    public function show(Cliente $cliente)
    {
        //
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.form', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $cliente = ClienteService::update($request->all(), $cliente);

        if ($cliente) {
            return redirect()->route('clientes.index')
                ->withSucesso('Atualizado com sucesso');
        }

        return redirect()->route('clientes.edit', $cliente)
                ->withErro('Ocorreu um erro ao atualizar');
    }

    public function destroy(Cliente $cliente)
    {
        $exclusao = ClienteService::destroy($cliente);

        return response($exclusao, $exclusao ? 200 : 400);
    }
}
