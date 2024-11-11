<?php

namespace App\Http\Controllers\panorama;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;  
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\tourist_spots;
use App\Models\panoramas;

class panoramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTour()
    {
        $category = 'wisata';
        // $touristSpotData = panoramas::with('touristSpot')->get();
        $touristSpotData = panoramas::with('touristSpot')
        ->whereHas('touristSpot', function ($query) use ($category) {
            $query->where('category',$category);
        })
        ->get();
        return view('admin.tourist.panorama.index',compact('touristSpotData'));
    }

    public function indexHistory()
    {
        $category = 'sejarah';
        // $touristSpotData = panoramas::with('touristSpot')->get();
        $touristSpotData = panoramas::with('touristSpot')
        ->whereHas('touristSpot', function ($query) use ($category) {
            $query->where('category',$category);
        })
        ->get();
        return view('admin.history.panorama.index',compact('touristSpotData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTour()
    {
        $touristSpotData = DB::table('tourist_spots')->where('category','wisata')->get();
        return view('admin.tourist.panorama.create',compact('touristSpotData'));
    }

    public function createHistory()
    {
        $touristSpotData = DB::table('tourist_spots')->where('category','sejarah')->get();
        return view('admin.history.panorama.create',compact('touristSpotData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTour(Request $request)
    {
        // dd($request);
        $request->validate([
            'tourist_spot_id' => 'required',
            'title' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $panorama_url = Cloudinary::upload($request->file('panorama')->getRealPath(), [
                'folder' => 'panorama_wisata_foto'
            ])->getSecurePath();
           $panoramaData = [
            'tourist_spot_id' => $request->tourist_spot_id,
            'title' => $request->title,
            'panorama_url' => $panorama_url,
            'pitch' => $request->pitch,
            'yaw' => $request->yaw,
           ];
           DB::table('panoramas')->insert([
            $panoramaData
           ]);

           DB::commit();
           return redirect()->route('admin.adminWisataPanorama')->with(['success'=> 'Data Berhasil Disimpan']);

        } catch (\Throwable $th) {
             DB::rollBack();
            dd($th);
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $th->getMessage()]);
        }
    }

    public function storeHistory(Request $request)
    {
        // dd($request);
        $request->validate([
            'tourist_spot_id' => 'required',
            'title' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $panorama_url = Cloudinary::upload($request->file('panorama')->getRealPath(), [
                'folder' => 'panorama_sejarah_foto'
            ])->getSecurePath();
           $panoramaData = [
            'tourist_spot_id' => $request->tourist_spot_id,
            'title' => $request->title,
            'panorama_url' => $panorama_url,
            'pitch' => $request->pitch,
            'yaw' => $request->yaw,
           ];
           DB::table('panoramas')->insert([
            $panoramaData
           ]);

           DB::commit();
           return redirect()->route('admin.adminSejarahPanorama')->with(['success'=> 'Data Berhasil Disimpan']);

        } catch (\Throwable $th) {
             DB::rollBack();
            dd($th);
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
        $touristSpotData = DB::table('tourist_spots')->get();
        $panorama = panoramas::findOrFail($id);
        return view('admin.tourist.panorama.edit',compact('panorama','touristSpotData'));
    }
    public function editHistory(Request $request)
    {
        $id = $request->id;
        $touristSpotData = DB::table('tourist_spots')->get();
        $panorama = panoramas::findOrFail($id);
        return view('admin.history.panorama.edit',compact('panorama','touristSpotData'));
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
    
        // Validasi input
        $request->validate([
            'name' => 'required|exists:tourist_spots,id', // Pastikan 'name' adalah ID yang valid
            'title' => 'required|string|max:255',
            'panorama' => 'nullable|file|image' // Validasi panorama jika ada
        ]);

        $panorama = panoramas::findOrFail($id);
        
        // Update data dasar
        $data = [
            'tourist_spot_id' => $request->name,
            'title' => $request->title,
        ];

        // Jika ada file panorama baru
        if ($request->hasFile('panorama')) {
            $publicId = pathinfo(parse_url($panorama->panorama_url, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy('panorama_wisata_foto/' . $publicId);

            // Upload panorama baru
            $panorama_url = Cloudinary::upload($request->file('panorama')->getRealPath(), [
                'folder' => 'panorama_wisata_foto'
            ])->getSecurePath();
            
            $data['panorama_url'] = $panorama_url; // Tambahkan URL baru ke data
        }

        // Update entri di database
        panoramas::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Panorama updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
         // Temukan panorama berdasarkan ID
    $panorama = panoramas::findOrFail($id);
    
    // Ambil public_id dari URL gambar
    $publicId = pathinfo(parse_url($panorama->panorama_url, PHP_URL_PATH), PATHINFO_FILENAME);
        // dd($publicId);
    // Hapus dari Cloudinary
    Cloudinary::destroy('panorama_wisata_foto/'.$publicId);
    
    // Hapus dari database
    $panorama->delete();

    return redirect()->back();
    
    }
}
