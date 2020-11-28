<?php

namespace App\Http\Controllers;

use App\DataTables\FabricanteDataTable;
use App\Http\Requests\StoreFabricantePost;
use App\Models\Fabricante;
use App\Services\FabricanteService;
use Illuminate\Http\Request;

class FabricanteController extends Controller
{
    public function index(FabricanteDataTable $fabricanteDataTable)
    {
        return $fabricanteDataTable->render('fabricantes.index');
    }

    public function create()
    {
        return view('fabricantes.form');
    }

    public function store(StoreFabricantePost $request)
    {
        $fabricante = FabricanteService::store($request->all());

        if ($fabricante) {
            return redirect()->route('fabricantes.index')
                ->withSucesso('Salvo com sucesso');
        }

        return redirect()->route('fabricantes.index')
                ->withErro('Ocorreu um erro ao salvar');
    }

    public function show(Fabricante $fabricante)
    {
        //
    }

    public function edit(Fabricante $fabricante)
    {
        return view('fabricantes.form', compact('fabricante'));
    }

    public function update(Request $request, Fabricante $fabricante)
    {
        $fabricante = FabricanteService::update($request->all(), $fabricante);

        if ($fabricante) {
            return redirect()->route('fabricantes.index')
                ->withSucesso('Atualizado com sucesso');
        }

        return redirect()->route('fabricantes.edit', $fabricante)
                ->withErro('Ocorreu um erro ao atualizar');
    }

    public function destroy(Fabricante $fabricante)
    {
        $exclusao = FabricanteService::destroy($fabricante);

        return response($exclusao, $exclusao ? 200 : 400);
    }

    public function fabricantesSelect(Request $request)
    {
        return FabricanteService::fabricantesSelect($request->all());
    }
}
