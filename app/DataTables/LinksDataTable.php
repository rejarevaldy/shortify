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
            ->addColumn('action', function ($datatable) {
                $html  = "";
                $html .= "<a href='" . route('app.link.edit', $datatable->id) . "' class='text-success m-1'><span class='fa fa-edit'></span></a>";
                $html .= "<a class='text-danger m-1' id='deleteModalBtn' data-url='" . route('app.link.destroy', $datatable->id) . "' data-toggle='modal' data-id='" . $datatable->id . "' data-target='#deleteModal_" . $datatable->id . "' style='cursor: pointer;' onClick='handleDelete(this)'><span class='fa fa-trash'></span></a>";
                return $html;
            })
            ->addColumn('shorted_link', function ($data) {
                return "
                        <button class='btn' onclick='copyText(\"/$data->shorted_link\")'>
                            <i class='micon bi bi-clipboard'></i>
                        </button>
            <a class='text-primary' href='/$data->shorted_link' >shorti.fy/$data->shorted_link</a>";
            })->rawColumns(['shorted_link'])
            ->addColumn('link', function ($data) {
                return "
                <button class='btn' onclick='copyText(\"$data->link\")'>
                <i class='micon bi bi-clipboard'></i>
                        </button>
                <a class='text-primary' href='$data->link' target='_blank'>$data->link</a>";
            })->escapeColumns([]);
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center'),
            Column::make('title'),
            Column::make('link')->title('Links'),
            Column::make('shorted_link')->title('Shorted Link'),
            Column::make('link_audit.hit_count')->title('Hit')->width(20),
            Column::make('link_audit.status')->title('Status')->width(60),
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
