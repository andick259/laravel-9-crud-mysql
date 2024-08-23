<?php

namespace App\Http\Controllers;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
     public function index()
    {
        //$data = siswa::all();
        //$data = siswa::orderBy('nomor_induk', 'desc')->get();
        $data = siswa::orderBy('nomor_induk', 'desc')->paginate(2);
        return view('siswa/index')->with('data', $data);
        
    }

    public function detail($id)
    {
        $data = siswa::where('nomor_induk', $id)->first();
        return view('/siswa/show')->with('data', $data);
    }


    
    public function create()
    {
        return view('/siswa/create');
    }

    public function store(Request $request)
    {
       //Session::flash('nomor_induk', $request->nomor_induk);
       //Session::flash('nama', $request->nama);
       //Session::flash('alamat', $request->alamat);
       $request->validate([
        'nomor_induk'=>'required|numeric',
        'nama'=>'required',
        'alamat'=>'required',
        'foto'=>'required|mimes:jpeg,jpg,png,gif'
       ], [
        'nomor_induk.required' => 'Nomor induk wajib diisi',
        'nomor_induk.numeric' => 'Nomor induk wajib diisi dalam angka',
        'nama.required' => 'Nama wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'foto.required' => 'Foto wajib diupload',
        'foto.mimes' => 'Only (jpeg, jpg, png, gif)'
       ]);
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('Ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('foto'),$foto_nama);

        $data = [
            'nomor_induk'=>$request->input('nomor_induk'),
            'nama'=>$request->input('nama'),
            'alamat'=>$request->input('alamat'),
            'foto'=>$foto_nama
        ];
        siswa::create($data);
        return redirect('/siswa')->with('success', 'Berhasil memasukan data');
    }


    public function edit($id){
        $data = siswa::where('nomor_induk', $id)->first();
        return view('/siswa/edit')->with('data', $data);
     }

     public function update($id, Request $request){
        $request->validate([
           // 'nomor_induk'=>'required|numeric',
            'nama'=>'required',
            'alamat'=>'required'
           ], [
           // 'nomor_induk.required' => 'Nomor induk wajib diisi',
           // 'nomor_induk.numeric' => 'Nomor induk wajib diisi dalam angka',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi'
           ]);
            $data = [
               // 'nomor_induk'=>$request->input('nomor_induk'),
                'nama'=>$request->input('nama'),
                'alamat'=>$request->input('alamat'),
            ];

            if($request->hasFile('foto'))
            {
             $request->validate([
                'foto' => 'mimes:jpeg,jpg,png,gif'
             ],[
                'foto.mimes' => 'Only (jpeg, jpg, png, gif)'
             ]);   
             //Upload foto Baru ke directori
             $foto_file = $request->file('foto');
             $foto_ekstensi = $foto_file->extension();
             $foto_nama = date('Ymdhis').".".$foto_ekstensi;
             $foto_file->move(public_path('foto'),$foto_nama);
             //
            // proses menghapus data lama
             $data_foto = siswa::where('nomor_induk', $id)->first();
             File::delete(public_path('foto'.'/'.$data_foto->foto));
            //
            $data['foto'] = $foto_nama;
            }

            siswa::where('nomor_induk', $id)->update($data);
            return redirect('/siswa')->with('success','Berhasil melakukan update data');
     }

     public function destroy($id)
     {
        $data = siswa::where('nomor_induk', $id)->first();
        File::delete(public_path('foto').'/'.$data->foto);
        siswa::where('nomor_induk', $id)->delete();
        return redirect('/siswa')->with('success', 'Berhasil hapus data');
     }

}
