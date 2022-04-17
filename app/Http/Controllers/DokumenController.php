<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\sip_dosen;
use App\sip_dokumen;
use Response;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokumen-tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'dokumen' => 'required|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx|max:512',
                'jenisdok' => "required",
                "keterangan" => "required",
            ],
            [
                'required' => 'The :attribute field is required.',
                'unique' => ':attribute is already used or In TRASH',
            ]
        );
        if(auth()->user()->role->first() == '7'){
            $path = "simpeg/dokumen_dosen";
        }else{
            $path = "simpeg/dokumen_pegawai";
        }
        $namafile = auth()->user()->username."-$request->jenisdok.{$request->dokumen->extension()}";

        $type = request()->dokumen->extension();
        if ($type == "jpeg" || $type == "jpg" || $type == "png") {
            $img = Image::make($request->file('dokumen'));
            $img->resize(720, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('ftp')->put("$path" . $namafile, $img->encode());
        } else {
            Storage::disk('ftp')->putFileAs("$path", $request->file('dokumen'), $namafile);
        }
        sip_dokumen::create([
            "dokumen" => $namafile,
            "user" => auth()->user()->username,
            "jenis" => $request->jenisdok,
            "keterangan" => $request->keterangan,
            "uploader" => auth()->user()->name,
        ]);

        $this->activity( auth()->user()->name, "upload", $request->jenisdok, "Data dokumen dosen", "Menambahkan dokumen [".auth()->user()->username."]");

        return redirect()->route("profil")->with('success', "Data Dokumen berhasil ditambah . . ."); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dok = sip_dokumen::findOrFail($id);
        $namafile = $dok->dokumen;
        $tipefile = explode(".", $namafile)[1];
        if(Storage::disk('ftp')->exists("simpeg/dokumen_dosen/$namafile")){
            $file = Storage::disk('ftp')->get("simpeg/dokumen_dosen/$namafile");
        }elseif(Storage::disk('ftp')->exists("simpeg/dokumen_pegawai/$namafile")){
            $file = Storage::disk('ftp')->get("simpeg/dokumen_pegawai/$namafile");
        }
        if ($tipefile == "pdf") {
            $file = Response::make($file, 200);
            $file->header('Content-Type', 'application/pdf');
        } else {
            $file = Image::make($file)->response('jpg');
        }
        return $file;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sip_dosen $dosen, $id)
    {
        $dokumen = sip_dokumen::findOrFail($id);
        if(Storage::disk('ftp')->exists("simpeg/dokumen_dosen/$dokumen->dokumen")){
            Storage::disk('ftp')->delete("simpeg/dokumen_dosen/$dokumen->dokumen");
        }elseif(Storage::disk('ftp')->exists("simpeg/dokumen_pegawai/$dokumen->dokumen")){
            Storage::disk('ftp')->delete("simpeg/dokumen_pegawai/$dokumen->dokumen");
        }
        $this->activity(auth()->user()->name, "delete", $dokumen->dokumen, "data dokumen dokumen", "Menghapus [$dokumen->dokumen] dari data dokumen dokumen");
        $dokumen->delete();
        
        return redirect()->back()->with('success', "Data [$dokumen->dokumen] berhasil dihapus . . .");
    }
}
