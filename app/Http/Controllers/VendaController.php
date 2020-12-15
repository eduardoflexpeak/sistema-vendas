<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDataTable;
use App\Models\Venda;
use App\Services\VendaService;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index(VendaDataTable $vendaDataTable)
    {
        return $vendaDataTable->render('vendas.index');
    }

    public function create()
    {
        return view('vendas.form', [
            'formasPagamento' => Venda::FORMAS_PAGAMENTO
        ]);
    }

    public function store(Request $request)
    {
        $venda = VendaService::store($request);

        if ($venda) {
            $request->session()->flash('sucesso', 'Venda finalizada com sucesso');

            return response('', 201);
        }

        return response('Erro ao salvar a venda', 400);
    }

    public function show(Venda $venda)
    {
        //
    }

    public function edit(Venda $venda)
    {
        //
    }

    public function update(Request $request, Venda $venda)
    {
        //
    }

    public function destroy(Venda $venda)
    {
        //
    }
}
