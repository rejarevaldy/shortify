<?php

namespace App\Http\Controllers\Backend;

use App\Models\Link;
use Illuminate\Http\Request;
use App\DataTables\LinksDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    private $create_route;
    private $index_route;

    public function __construct()
    {
        $this->create_route = route('app.link.create');
        $this->index_route = route('app.link.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(LinksDataTable $datatable)
    {
        return $datatable->render('backend.links.index', [
            'title' => 'Links',
            'buttons' => [
                "<a href='$this->create_route' class='btn btn-sm btn-outline-success'>Create</a>",
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.links.create', [
            'title' => 'Link Create',
            'buttons' => [
                "<a href='$this->index_route' class='btn btn-sm btn-outline-secondary'>Back</a>",
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
