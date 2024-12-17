<?php

namespace App\DataTables;

use App\Models\Shirt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShirtsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'shirts.action') // Essa coluna não será visível por padrão
            ->addColumn('buyer', function (Shirt $shirt) {
                return $shirt->ticket->buyer ? $shirt->ticket->buyer->name : 'N/A';
            })
            ->addColumn('contact', function (Shirt $shirt) {
                $buyer = $shirt->ticket->buyer;
                return $buyer ? $buyer->email . ' | ' . $buyer->phone : 'N/A';
            })
            ->setRowId('id');
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Shirt $model): QueryBuilder
    {
        $query = $model->newQuery()->with('ticket.buyer');

        // Para depurar, descomente a linha abaixo
        dd($query->get());

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('shirts-table')
            ->columns($this->getColumns())
            ->minifiedAjax() // Habilita o ajax para carregar os dados
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }


    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-start'),
            Column::make('size'),
            Column::make('buyer'),
            Column::make('contact'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Camisetas_Trilhadojava' . date('d-m-Y-H-i-s');
    }
}
