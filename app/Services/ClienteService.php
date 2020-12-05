<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Support\Facades\Log;
use Throwable;

class ClienteService
{
    public static function store($request)
    {
        try {
            return Cliente::create($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function update($request, $cliente)
    {
        try {
            return $cliente->update($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function destroy($cliente)
    {
        try {
            return $cliente->delete();
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }

    public static function clientesSelect($request)
    {
        if (isset($request['pesquisa'])) {
            return Cliente::select('id', 'nome as text')
                        ->where('nome', 'like', "%" . $request['pesquisa'] . "%")
                        ->limit(10)
                        ->get();
        }

        return Cliente::select('id', 'nome as text')
                        ->limit(10)
                        ->get();
    }
}