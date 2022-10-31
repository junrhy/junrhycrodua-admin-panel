<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;

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
     * Edit form resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $endpoint = Endpoint::find($id);

        return view('endpoint.edit')
                ->with('endpoint', $endpoint);
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
            'endpoint_url' => 'required|regex:'.$url_regex
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

        $headers = str_replace('"', "double-qoute", $endpoint->headers);
        $data = str_replace('"', "double-qoute", $endpoint->data);

        return view('endpoint.show')
                ->with('endpoint', $endpoint)
                ->with('headers', !empty($headers) ? $headers : '{}')
                ->with('data', !empty($data) ? $data : '{}');
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
        $url_regex = '/^(http(s)?:\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $this->validate($request, [
            'name' => 'required|unique:endpoints',
            'endpoint_url' => 'required|regex:'.$url_regex
        ]);
        
        $endpoint = Endpoint::find($id);
        $endpoint->fill($request->all())->save();

        return back()->with('success', 'Endpoint successfully updated.');
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
}
