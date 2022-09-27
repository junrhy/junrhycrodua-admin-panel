<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Endpoint;

class EndpointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $endpoints = Endpoint::all();

        return view('endpoint.index')
                ->with('endpoints', $endpoints);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('endpoint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url_regex = '/^(http(s)?:\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $this->validate($request, [
            'name' => 'required|unique:endpoints',
            'api_source' => 'required',
            'endpoint_url' => 'required|regex:'.$url_regex,
            'auth' => 'required'
        ]);

        Endpoint::create($request->all());

        return back()->with('success', 'Endpoint successfully registered.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $endpoint = Endpoint::find($id);

        $auth = explode(",", str_replace("\r\n", ",", $endpoint->auth));
        $allAuth = [];
        foreach ($auth as $auth_line) {
            $line_auth = explode(":", $auth_line);
            $allAuth[$line_auth[0]] = $line_auth[1];
        }

        return view('endpoint.show')
                ->with('endpoint', $endpoint)
                ->with('allAuth', $allAuth);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ids = explode(",",$id);
        Endpoint::whereIn('id', $ids)->update(['is_active' => $request->is_active]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(",",$id);
        Endpoint::whereIn('id', $ids)->delete();
    }

    public function createTableRecord($id)
    {
        $endpoint = Endpoint::find($id);

        $auth = explode(",", str_replace("\r\n", ",", $endpoint->auth));
        $allAuth = [];
        foreach ($auth as $auth_line) {
            $line_auth = explode(":", $auth_line);
            $allAuth[$line_auth[0]] = $line_auth[1];
        }

        return view('endpoint.table.create')
                ->with('endpoint', $endpoint)
                ->with('allAuth', $allAuth);
    }

    public function storeTableRecord(Request $request)
    {
        // code...
    }

    public function removeTableRecord($id)
    {
        // code...
    }

    public function downloadTableRecord(Request $request)
    {
        // code...
    }
}
