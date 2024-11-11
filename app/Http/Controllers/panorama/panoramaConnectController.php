<?php

namespace App\Http\Controllers\panorama;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tour_links;
use App\Models\panoramas;


class panoramaConnectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTour()
    {
        $category = 'wisata';
        $dataPanoramaConnect = tour_links::with([
            'sourcePanorama.touristSpot',
            'destinationPanorama.touristSpot'
        ])
        ->whereHas('sourcePanorama.touristSpot', function ($query) use ($category) {
            $query->where('category', $category);
        })
        ->orWhereHas('destinationPanorama.touristSpot', function ($query) use ($category) {
            $query->where('category', $category);
        })
        ->get();
        // dd($dataPanoramaConnect);
        return view('admin.tourist.panoramaConnect.index',compact('dataPanoramaConnect'));
    }
    
    public function indexHistory() {
        $category = 'sejarah';
        $dataPanoramaConnect = tour_links::with([
            'sourcePanorama.touristSpot',
            'destinationPanorama.touristSpot'
        ])
        ->whereHas('sourcePanorama.touristSpot', function ($query) use ($category) {
            $query->where('category', $category);
        })
        ->orWhereHas('destinationPanorama.touristSpot', function ($query) use ($category) {
            $query->where('category', $category);
        })
        ->get();

        return view('admin.history.panoramaConnect.index',compact('dataPanoramaConnect'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTour()
    {
        $category = 'wisata';
        $panoramaData = panoramas::with('touristSpot')
        ->whereHas('touristSpot', function ($query) use ($category) {
            $query->where('category',$category);
        })->get();
    
        return view('admin.tourist.panoramaConnect.create',compact('panoramaData'));
    }
    public function createHistory()
    {
        $category = 'sejarah';
        $panoramaData = panoramas::with('touristSpot')
        ->whereHas('touristSpot', function ($query) use ($category) {
            $query->where('category',$category);
        })->get();
    
        return view('admin.history.panoramaConnect.create',compact('panoramaData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTour(Request $request)
    {
        $request->validate([
            'destination_panorama_id' => 'required',
            'source_panorama_id' => 'required',
            'link_description' => 'required',
        ]);

        DB::beginTransaction();

        try {
           $data =  [
            'destination_panorama_id' =>  $request->destination_panorama_id,
            'source_panorama_id' => $request->source_panorama_id,
            'link_description' => $request->link_description,
            'pitch' => $request->pitch,
            'yaw' => $request->yaw,
           ];
           DB::table('tour_links')->insert([
            $data
           ]);

           DB::commit();
           return redirect()->route('admin.adminWisataPanoramaConnect')->with(['success'=> 'Data Berhasil Disimpan']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]);
        }
    }
    public function storeHistory(Request $request)
    {
    
        $request->validate([
            'destination_panorama_id' => 'required',
            'source_panorama_id' => 'required',
            'link_description' => 'required',
        ]);

        DB::beginTransaction();

        try {
           $data =  [
            'destination_panorama_id' =>  $request->destination_panorama_id,
            'source_panorama_id' => $request->source_panorama_id,
            'link_description' => $request->link_description,
            'pitch' => $request->pitch,
            'yaw' => $request->yaw,
           ];
           DB::table('tour_links')->insert([
            $data
           ]);

           DB::commit();
           return redirect()->route('admin.adminSejarahPanoramaConnect')->with(['success'=> 'Data Berhasil Disimpan']);
        } catch (\Throwable $th) {
            DB::rollBack();
      
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]);
        }
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
    public function editTour(Request $request)
    {
        $id = $request->id;
        $dataPanorama = tour_links::with([
            'sourcePanorama.touristSpot',
            'destinationPanorama.touristSpot'
        ])->get();
        $dataPanoramaConnect = tour_links::findOrFail($id);
        return view('admin.tourist.panoramaConnect.edit',compact('dataPanoramaConnect','dataPanorama'));
    }
    public function editHistory(Request $request)
    {
        $id = $request->id;
        $dataPanorama = tour_links::with([
            'sourcePanorama.touristSpot',
            'destinationPanorama.touristSpot'
        ])->get();
        $dataPanoramaConnect = tour_links::findOrFail($id);
        return view('admin.history.panoramaConnect.edit',compact('dataPanoramaConnect','dataPanorama'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        // Pastikan ID ada
        if (!$id) {
            return redirect()->back()->withErrors(['error' => 'ID not provided.']);
        }
    
        // Validasi input
        $request->validate([
            'sumber_panorama' => 'required|exists:panoramas,id', 
            'tujuan_panorama' => 'required|exists:panoramas,id', 
            'deskripsi' => 'required|string|max:500',
            'pitch' => 'required',
            'yaw' => 'required'
        ]);
    
        // Siapkan data untuk update
        $data = [
            'source_panorama_id' => $request->sumber_panorama,
            'destination_panorama_id' => $request->tujuan_panorama,
            'link_description' => $request->deskripsi,
            'pitch' => $request->pitch,
            'yaw' => $request->yaw,
        ];
    
        \Log::info('Updating tour_links with data: ', $data);
    
        // Update data
        $updatedRows = tour_links::where('id', $id)->update($data);
        return redirect()->back()->with(['success'=> 'Data Berhasil Diupdate']);
       
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $dataPanoramaConnect = tour_links::findOrFail($id);

        $dataPanoramaConnect->delete();
        return redirect()->back();
    }
}
