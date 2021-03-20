<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $cek_role = User::where('role', auth()->user()->role == 2);
        return view('home');
    }

    public function kalkulator()
    {
        return view('admin.kalkulator.index');
    }

    public function HitungKalkulator(Request $request)
    {
        $besar_pinjaman = $request->besar_pinjam;
        $bunga = $request->bunga;
        $jangka = $request->jangka;

        $bungapersen = $bunga / 100;
        $tahun = $jangka / 12;

        $c = pow((1 + $bungapersen), $tahun);
        $d = $c - 1;
        $fax = ($bungapersen * $c) / $d;
        $anuitas = round($fax, 6);

        $besar_angsur = ($besar_pinjaman * $anuitas) / 12;
            $besar_angsuran = round($besar_angsur, -2) + 100;
        // dd($besar_angsuran);
        //angsuran bunga = pinjaman pokok * bungapersen/ 12-24-36-48-60-72-84-96
        // $besar_angsuran = besarAngsuran($besar_pinjaman,$getAnuitas);
        $array1 = [0 => null];
        $array2 = [0 => null];
        $array3 = [0 => intval($besar_pinjaman)];
        $no = 1;
        $angsuran_bunga = $besar_pinjaman * $bungapersen / 12;
        $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

        $loopingjangka = $jangka+1;
        for ($i = 1; $i < $loopingjangka; $i++) {

            if ($no == 13) {
                $ang_bunga = $besar_pinjaman * $bungapersen / 12;
                $angsuran_bunga = round($ang_bunga,2);
                $angsuran_pokok = $besar_angsuran - $angsuran_bunga;
                $no = 1;
            }
            $no++;
            array_push($array1, $angsuran_bunga);
            array_push($array2, $angsuran_pokok);


            $besar_pinjaman -= $array2[$i];
            array_push($array3, $besar_pinjaman);
        }
         // echo 'besar_angsuran '.$besar_angsuran;
         $array_all = ['bunga'=>$array1,
         'pokok'=>$array2,
         'pinjaman'=>$array3,
     ];
    //   dd($array_all);
     // return response()->json($array_all);
     $object = new \stdClass();
		if (is_array($array_all))
		{
			foreach ($array_all as $kolom=>$isi)
			{
				$kolom = strtolower(trim($kolom));
				$object->$kolom = $isi;
			}
		}
     return view('admin.kalkulator.show','object',$object);
         //  return view('admin.kalkulator.show',['array1' => $array1],['array2' => $array2], ['array2' => $array3]);
    }
}
