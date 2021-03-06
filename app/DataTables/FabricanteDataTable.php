<?php

namespace App\DataTables;

use App\Models\Fabricante;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FabricanteDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($fabricante) {
                $rotaExcluir = route('fabricantes.destroy', $fabricante);

                $acoes = link_to_route('fabricantes.edit', 'Editar', $fabricante, ['class' => 'btn btn-primary btn-sm']);
                $acoes .= FormFacade::button('Excluir', ['class' => 'btn btn-danger btn-sm ml-1', 'onclick' => "excluir('$rotaExcluir')"]);

                return $acoes;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Fabricante $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Fabricante $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('fabricante-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')->text('Cadastrar Novo'),
                        Button::make('export')->text('Exportar')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->title('Ações'),
            Column::make('id'),
            Column::make('nome'),
            Column::make('site')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Fabricante_' . date('YmdHis');
    }
}
