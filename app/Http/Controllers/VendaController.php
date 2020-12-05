<?php

namespace App\Http\Controllers;

use App\DataTables\VendaDataTable;
use App\Models\Venda;
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
        //
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
