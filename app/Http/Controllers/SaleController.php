<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales=Sale::all();
        if(count($sales)<1){
            $results=$this->get_data();
            foreach($results as $result){
                $sale=new Sale();
                $sale->no=$result->no;
                $sale->id_produk=$result->id_produk;
                $sale->nama_produk=$result->nama_produk;
                $sale->kategori=$result->kategori;
                $sale->harga=$result->harga;
                $sale->status=$result->status;
                $sale->save();
            }
        }
        $data['sales']=Sale::where('status','bisa dijual')->get();
        // dd($data);
        return view('sale.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sale.add');
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
            'nama_barang'=>'required',
            'kategori'=>'required',
            'harga'=>'required|numeric',
        ]);

        $no=DB::table('sales')->max('no');
        $id_produk=DB::table('sales')->max('id_produk');
        $sale=new Sale();
        $sale->no=$no+=1;
        $sale->id_produk=$id_produk+=1;
        $sale->nama_produk=$request->nama_barang;
        $sale->kategori=$request->kategori;
        $sale->harga=$request->harga;
        $sale->status=$request->status;
        $sale->save();
        return redirect()->route('sales.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale,$id)
    {
        $data['sale']=Sale::find($id);
        return view('sale.edit',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale,$id)
    {
        $request->validate([
            'nama_barang'=>'required',
            'kategori'=>'required',
            'harga'=>'required|numeric',
        ]);

        $no=DB::table('sales')->max('no');
        $id_produk=DB::table('sales')->max('id_produk');
        $sale=new Sale();
        $sale=Sale::find($id);
        $sale->no=$no+=1;
        $sale->id_produk=$id_produk+=1;
        $sale->nama_produk=$request->nama_barang;
        $sale->kategori=$request->kategori;
        $sale->harga=$request->harga;
        $sale->status=$request->status;
        $sale->save();
        return redirect()->route('sales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale,$id)
    {
        $sale=Sale::find($id);
        $sale->delete();
    }

    public function get_data()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://recruitment.fastprint.co.id/tes/api_tes_programmer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('username' => 'tesprogrammer','password' => '463c11c20c54be3e9dcc1466193b18a0'),
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=bvn51gsj9f6b9tgck1v29koo9oj2p2ht'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return (json_decode($response)->data);
    }
}
