<?php

namespace App\Http\Controllers\culinary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;  
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\panoramas;
use App\Models\tourist_spots;

class culinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $culinaryData = DB::table('tourist_spots')->where('category','kuliner')->get();
        return view('admin.culinary.index',compact('culinaryData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.culinary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'address' => 'required|string',
            'category' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $touristSpotData = [
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'category' => $request->category,
            ];

            $touristSpotDataId = DB::table('tourist_spots')->insertGetId($touristSpotData);

            foreach ($request->file('foto') as $image) {
                // Upload file ke Cloudinary dan dapatkan URL secure
                $uploadedFileUrl = Cloudinary::upload($image->getRealPath(), [
                    'folder' => 'kuliner_foto'
                ])->getSecurePath();
    
                // Simpan URL foto dan gallery_id ke dalam tabel `foto_profils`
                DB::table('fotos')->insert([
                    'tourist_spot_id' => $touristSpotDataId,
                    'foto_url' => $uploadedFileUrl
                ]);
            }
            DB::commit();
            return redirect()->route('admin.adminKuliner')->with('success', 'Tourist spot deleted successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.adminKuliner')->withErrors(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // dd('tes');
        $id = $request->id;
        $dataCulinary = DB::table('tourist_spots')->where('id',$id)->first();
        $dataFoto = DB::table('fotos')->where('tourist_spot_id',$id)->get();
        $dataPanorama = DB::table('panoramas')->where('tourist_spot_id',$id)->first();
        
          // Ambil tempat wisata dan panorama beserta hubungan antar panorama
          $touristSpot = tourist_spots::with('panoramas.tourLinks.destinationPanorama')->findOrFail($id);
     
     return view('admin.culinary.detail', [
         'dataFoto' => $dataFoto,
         'dataCulinary' => $dataCulinary,  
         'touristSpot' => $touristSpot,
     ]);
 
     
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $culinarySpot = DB::table('tourist_spots')->where('id', $id)->first();
        $fotos = DB::table('fotos')->where('tourist_spot_id', $id)->get();
        
        return view('admin.culinary.edit', compact('culinarySpot', 'fotos'));
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
        $request->validate ([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required'
        ]);
        $tourist = tourist_spots::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address
        ];

        tourist_spots::where('id', $id)->update($data);

        return redirect()->route('admin.adminKuliner')->with('success', 'Kuliner updated successfully!');

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
