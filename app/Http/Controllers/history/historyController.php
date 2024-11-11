<?php

namespace App\Http\Controllers\history;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;  
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\panoramas;
use App\Models\tourist_spots;

class historyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historyData = DB::table('tourist_spots')->where('category','sejarah')->get();
        return view('admin.history.index',compact('historyData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.history.create');
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
                    'folder' => 'sejarah_foto'
                ])->getSecurePath();
    
                // Simpan URL foto dan gallery_id ke dalam tabel `foto_profils`
                DB::table('fotos')->insert([
                    'tourist_spot_id' => $touristSpotDataId,
                    'foto_url' => $uploadedFileUrl
                ]);
            }
            DB::commit();
            return redirect()->route('admin.adminSejarah')->with(['success'=> 'Data Berhasil Disimpan']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.adminSejarah')->withErrors(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]);
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
        $id = $request->id;
        $dataHistory = DB::table('tourist_spots')->where('id',$id)->first();
        $dataFoto = DB::table('fotos')->where('tourist_spot_id',$id)->get();
        $dataPanorama = DB::table('panoramas')->where('tourist_spot_id',$id)->first();
        
          // Ambil tempat wisata dan panorama beserta hubungan antar panorama
          $touristSpot = tourist_spots::with('panoramas.tourLinks.destinationPanorama')->findOrFail($id);
          // Format data untuk Pannellum
     $scenes = [];
     foreach ($touristSpot->panoramas as $panorama) {
        
         // Set data dasar panorama
         $scene = [
             'title' => $panorama->title,
             'hfov' => 110,
             'pitch' => $panorama->pitch ?? 0, // Pitch default dari panorama
             'yaw' => $panorama->yaw ?? 0, // Yaw default dari panorama
             'type' => 'equirectangular',
             "autoRotate"=> -2,
             'panorama' =>  $panorama->panorama_url , // URL panorama
             'hotSpots' => []
         ];
 
         // Tambahkan hotSpots (hubungan antar panorama)
         foreach ($panorama->tourLinks as $link) {
             $scene['hotSpots'][] = [
                 'pitch' => $link->pitch ?? 0,
                 'yaw' => $link->yaw ?? 0,
                 'type' => 'scene',
                 "autoRotate"=> -2,
                 'text' => $link->destinationPanorama->title ?? 'Panorama',
                 'sceneId' => $link->destinationPanorama->id ?? null,
                 'targetYaw' => $link->yaw ?? 0,
                 'targetPitch' => $link->pitch ?? 0,
             ];
         }
 
         // Tambahkan scene ke daftar scenes
         $scenes[$panorama->id] = $scene;
     }
     // dd(json_encode($scenes));
     return view('admin.history.detail', [
         'dataFoto' => $dataFoto,
         'dataTourist' => $dataHistory,  
         'touristSpot' => $touristSpot,
         'scenes' => $scenes, 
         // Kirim data scenes dalam bentuk JSON
     ]);
         // return view('admin.tourist.detail',compact('dataTourist','dataFoto','dataPanorama'));
 
     
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $historySpot = DB::table('tourist_spots')->where('id', $id)->first();
        $fotos = DB::table('fotos')->where('tourist_spot_id', $id)->get();
        
        return view('admin.history.edit', compact('historySpot', 'fotos'));
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

        return redirect()->route('admin.adminSejarah')->with('success', 'Sejarah updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historySpot = tourist_spots::with(['fotos', 'panoramas'])->findOrFail($id);
        // dd($touristSpot);
        // Hapus foto dari Cloudinary
        foreach ($historySpot->fotos as $foto) {
            $publicId = pathinfo(parse_url($foto->foto_url, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy('sejarah_foto/'.$publicId);
        }

        // Hapus panorama dari Cloudinary
        foreach ($historySpot->panoramas as $panorama) {
            $publicId = pathinfo(parse_url($panorama->panorama_url, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy('panorama_sejarah_foto/'.$publicId);
        }

        // Hapus data dari database
        $historySpot->fotos()->delete(); // Hapus semua foto
        $historySpot->panoramas()->delete(); // Hapus semua panorama
        $historySpot->delete(); // Hapus tourist spot itu sendiri

        return redirect()->back()->with('success', 'Tourist spot deleted successfully!');
    }
}
