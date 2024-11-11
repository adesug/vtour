<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tourist_spots;

class PageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataWisata = tourist_spots::with('fotos')
        ->where('category', 'wisata')
        ->inRandomOrder()
        ->limit(3)
        ->get();

        $dataSejarah = tourist_spots::with('fotos')
        ->where('category', 'sejarah')
        ->inRandomOrder()
        ->limit(3)
        ->get();

        $dataKuliner = tourist_spots::with('fotos')
        ->where('category', 'kuliner')
        ->inRandomOrder()
        ->limit(3)
        ->get();
       
        return view('user.index',compact('dataWisata','dataSejarah','dataKuliner'));
    
    }
    public function exploreMoreWisata() 
    {
        $dataWisata = tourist_spots::with('fotos')
        ->where('category', 'wisata')
        ->inRandomOrder()
        ->get();
        return view('user.tourist.index',compact('dataWisata'));
    }
    public function exploreMoreSejarah() 
    {
        $dataSejarah = tourist_spots::with('fotos')
        ->where('category', 'sejarah')
        ->inRandomOrder()
        ->get();
        return view('user.history.index',compact('dataSejarah'));
    }
    public function exploreMoreKuliner() 
    {
        $dataKuliner = tourist_spots::with('fotos')
        ->where('category', 'kuliner')
        ->inRandomOrder()
        ->get();
        return view('user.culinary.index',compact('dataKuliner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
