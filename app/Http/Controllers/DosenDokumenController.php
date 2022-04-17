<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\sip_dosen;
use App\sip_dokumen;
use Response;

class DosenDokumenController extends Controller
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
    public function create($id)
    {
        $data["dosen"] = sip_dosen::findOrFail($id);
        $data["dokumen"] = sip_dokumen::whereNull('deleted_at')->orderBy('dokumen', 'asc')->get();
        return view('admin.dosen.dosen-dokumen-tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
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
        $dosen = sip_dosen::findOrFail($id);
        $namafile = "$dosen->user-$request->jenisdok.{$request->dokumen->extension()}";

        $type = request()->dokumen->extension();
        if ($type == "jpeg" || $type == "jpg" || $type == "png") {
            $img = Image::make($request->file('dokumen'));
            $img->resize(720, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::disk('ftp')->put("simpeg/dokumen_dosen/" . $namafile, $img->encode());
        } else {
            Storage::disk('ftp')->putFileAs("simpeg/dokumen_dosen/", $request->file('dokumen'), $namafile);
        }
        sip_dokumen::create([
            "dokumen" => $namafile,
            "user" => $dosen->user,
            "jenis" => $request->jenisdok,
            "keterangan" => $request->keterangan,
            "uploader" => auth()->user()->name,
        ]);

        $this->activity( auth()->user()->name, "upload", $request->jenisdok, "Data dokumen dosen", "Menambahkan dokumen [$dosen->user-$dosen->namagelar]");

        return redirect()->route("dosen.show", $id)->with('success', "Data Dokumen berhasil ditambah . . ."); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dosen, $id)
    {
        $dok = sip_dokumen::findOrFail($id);
        $namafile = $dok->dokumen;
        $tipefile = explode(".", $namafile)[1];
        $file = Storage::disk('ftp')->get("simpeg/dokumen_dosen/$namafile");
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
        Storage::disk('ftp')->delete("simpeg/dokumen_dosen/$dokumen->dokumen");
        $this->activity(auth()->user()->name, "delete", $dokumen->dokumen, "data dokumen dokumen", "Menghapus [$dokumen->dokumen $dosen->namagelar] dari data dokumen dokumen");
        $dokumen->delete();
        
        return redirect()->back()->with('success', "Data [$dokumen->dokumen $dosen->namagelar] berhasil dihapus . . .");
    }
}
