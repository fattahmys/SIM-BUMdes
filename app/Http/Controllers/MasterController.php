<?php

namespace App\Http\Controllers;

use App\Models\MasterbarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->MasterbarangModel = new MasterbarangModel();
    }
    public function index(){
        $data = [
            'master_barang' => $this->MasterbarangModel->allData(),
        ];
        return view('pages.inventaris.master_barang', $data);
    }
    public function barang(){
        return view('pages.inventaris.tambah_master_barang');
    }
    public function insert(){
        $data = [
            'nama_barang'=>request()->nama_barang,
            'harga_beli'=>request()->harga_beli,
            'harga_jual'=>request()->harga_jual,
            ];
        Request()->validate([
            'nama_barang' => 'required|unique:master_barang,nama_barang|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
           
        ],
        [
            'nama_barang.required' => 'Data tidak boleh kosong!',
        ]);

      
    $this->MasterbarangModel->insert($data);
    // Alert::success('Success Title', 'success Message');
    return redirect('master_barang')->with('success', 'Master barang berhasil ditambahkan.');
    }

    public function delete($id)
    {
        DB::table('master_barang')->where('id',$id)->delete();
        return back()->with('success', 'Master barang berhasil dihapus.');;
    }
    
}
