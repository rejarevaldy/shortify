<?php

namespace App\Http\Controllers\Backend;

use App\Models\Link;
use App\Models\Audit;
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
        $shorted_link = $request->link['shorted'] === '' ? bin2hex(random_bytes(5)) : $request->link['shorted'];

        $link_audit = Audit::create([
            "hit_count"     => 0,
            "status"        => 'active',
        ])->fresh();

        $link = Link::create([
            'title'         => $request->link['title'],
            'link'          => $request->link['destination'],
            'shorted_link'  => $shorted_link,
            'link_audit_id' => $link_audit->id,
            'user_id'       => Auth::user()->id,
        ]);

        return redirect()->route('app.link.index')->with('success', "Link get shorted!");
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
        $link = Link::find($id);

        $link->delete();
        return redirect()->back()->with('success', 'Link deleted successfully');
    }
}
