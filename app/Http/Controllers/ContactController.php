<?php

namespace App\Http\Controllers;

use App\contact;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['contacts']=Contact::paginate(5);
        return view('contact.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosContact=request()->except('_token');
        if($request->hasFile('photo')){
            $datosContact['photo']=$request->file('photo')->store('uploads','public');
        }
        contact::insert($datosContact);

        $datos['contacts']=Contact::paginate(5);
        return view('contact.index',$datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact=contact::findOrFail($id);
        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $datosContact=request()->except(['_token','_method']);
        if($request->hasFile('photo')){
            $contact=contact::findOrFail($id);
            Storage::delete('public/'.$contact->photo);

            $datosContact['photo']=$request->file('photo')->store('uploads','public');
        }
        contact::where('id','=',$id)->update($datosContact);

        $contact=contact::findOrFail($id);
        return view('contact.edit',compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        contact::destroy($id);
        return redirect('contact');
    }
}
