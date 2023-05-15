<?php

namespace App\DataTables;

use App\Models\Link;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\Applicant\Applicant;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class LinksDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'links.action')
            ->addColumn('shorted_link', function ($data) {
                return "<a class='text-primary'>shorti.fy/$data->shorted_link</a>";
            })->rawColumns(['shorted_link'])
            ->addColumn('link', function ($data) {
                return "<a class='text-primary' href='$data->link' target='_blank'>$data->link</a>";
            })->rawColumns(['link', 'shorted_link'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Link $model): QueryBuilder
    {
        return $model->newQuery()->where('user_id', Auth::user()->id)->with(['link_audit', 'user']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('datatableserverside')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {

        return [
            Column::make('title'),
            Column::make('link')->title('Links'),
            Column::computed('shorted_link')
                ->escapeColumns([])
                ->title('Shorted Link'),
            Column::make('link_audit.hit_count')->title('Hit'),
            Column::make('link_audit.status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Links_' . date('YmdHis');
    }
}
