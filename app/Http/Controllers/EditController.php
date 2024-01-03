<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\real;
use App\Models\SPK;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Yajra\DataTables\Facades\DataTables;
use function Laravel\Prompts\select;

class EditController extends Controller
{
 

    public function editp(Request $request){
       // $user = Auth::user();
       $user = auth()->user();

       // Lakukan validasi data yang dikirimkan melalui $request jika diperlukan
       $request->validate([
           'current_password' => 'required',
           'password' => 'required|min:4|confirmed',
           'password_confirmation' => 'required|same:password',
       ]);
// SHA1
if (sha1($request->current_password) === $user->Password) {
    // Pastikan password baru dan konfirmasi cocok
    if ($request->password === $request->password_confirmation) {
        // Melakukan update password langsung ke database
        DB::table('ts_karyawan_sk')
            ->where('nama_kary', $user->nama_kary)
            ->update(['Password' => sha1($request->password)]);

        // Redirect dengan pesan sukses
       
    return response()->json(['message' => 'Password berhasil diubah.']);
    } else {
        // Redirect dengan pesan kesalahan konfirmasi password
        return response()->json(['message' => 'Konfirmasi password tidak cocok.']);
    }
} else {
    // Redirect dengan pesan kesalahan kata sandi saat ini
    return response()->json(['message' => 'Password lama salah.'],400);
}
//    hash
       // Pastikan kata sandi saat ini sesuai
    //    if (Hash::check($request->current_password, $user->Password)) {
    //        // Pastikan password baru dan konfirmasi cocok
    //        if ($request->password === $request->password_confirmation) {
    //            // Melakukan update password langsung ke database
    //            DB::table('ts_karyawan_sk')
    //                ->where('nama_kary', $user->nama_kary)
    //                ->update(['Password' => Hash::make($request->password)]);
   
    //            // Redirect dengan pesan sukses
    //            return response()->json(['message' => 'Password berhasil diubah.']);
    //        } else {
    //            // Redirect dengan pesan kesalahan konfirmasi password
    //            return response()->json(['message' => 'Konfirmasi password tidak cocok.']);
    //        }
    //    } else {
    //        // Redirect dengan pesan kesalahan kata sandi saat ini
    //        return response()->json(['message' => 'Kata sandi saat ini salah.'], 422);
    //    }
    }

   
public function realisasi(Request $request){
    if (Auth::check()) {
    //$idJobSPKk = $request->input('Id_Job_SPK');
    $currentUserNamaKary = Auth::user()->nama_kary;
	$cari = $request->cari;
    $searchKapal = $request->input('searchKapal');
    $data = Post::join('td_joborder', 'td_wp_spk.Id_Job', '=', 'td_joborder.Id_Job')
    ->join('td_project', 'td_joborder.Id_Reg', '=', 'td_project.Id_Reg')
    ->join('ts_kapal', 'td_project.IdVessel', '=', 'ts_kapal.IdVessel')
 
    ->join('ts_karyawan_sk', 'td_wp_spk.Kode_Pelksn', '=', 'ts_karyawan_sk.nama_kary')
    ->where('ts_karyawan_sk.nama_kary', $currentUserNamaKary)
    ->where('ts_kapal.Nama Kapal','like',"%".$cari."%")
    ->where('ts_kapal.Nama Kapal', 'LIKE', '%' . $searchKapal . '%') // Gunakan LIKE untuk pencarian berdasarkan nama kapal

    ->select(
        'td_wp_spk.NoSPK',
        'td_wp_spk.Id_Job_SPK',
        'td_wp_spk.NoWBS',
        'td_project.Kode_Proyek',
        'ts_kapal.Nama Kapal',
        'td_wp_spk.Val_A',
        'td_wp_spk.Val_B',
        'td_wp_spk.Val_C',
    )
    ->paginate(10);;
    

   return view('realisasi.realisasi',compact('data'));
    }
    else {
        // Jika pengguna belum login, arahkan ke halaman login
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

}

public function tambahDataReal(Request $request, $Id_Job_SPK)
{
//return $request->all();



    // Validasi data yang diterima dari formulir
    $validator =Validator::make( $request->all(),[
        'Kode' => 'required',
        'realisasi_WP' => 'required',
        'volume_Task' => 'required',
        'Satuan'=>'required',
       'Ttl_Price'=>'required',
        'UnitPrice'=>'required',
        // Tambahkan validasi untuk kolom lainnya sesuai kebutuhan
    ]);
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal: ' . implode(', ', $validator->errors()->all())
        ], 422);
    }
  // Hitung Ttl_Price berdasarkan volume_Task dan Satuan
  $volume_Task = $request->input('volume_Task'); // Ambil nilai volume_Task dari input
  $Ttl_Price = $volume_Task * 3000; 
   // $idJobSPKk = $request->session()->get('Id_Job_SPK');
    // Ambil Id_Job_SPK dari td_wp_spk
   $idJobSPK = DB::table('td_wp_spk')->where('Id_Job_SPK', $Id_Job_SPK)->value('Id_Job_SPK');
   
   $tdWpBklReal = new real;
   $tdWpBklReal->Id_Job_SPK = $idJobSPK;
   $tdWpBklReal->Kode = $request->Kode;
   $tdWpBklReal->realisasi_WP = $request->realisasi_WP;
   $tdWpBklReal->volume_Task = $request->volume_Task;
   $tdWpBklReal->Satuan = $request->Satuan;
   $tdWpBklReal->Ttl_Price = $Ttl_Price;
   $tdWpBklReal->UnitPrice = 3000;
   $tdWpBklReal->tgl_update = now();
   $tdWpBklReal->status = 0;
   $tdWpBklReal->status_M = 0;
   
   // Simpan data ke dalam tabel
   $tdWpBklReal->save();
   
    return response()->json([
        'success' => true,
        'message' => 'Data berhasil disimpan',
        'data'    => $tdWpBklReal,  
    ]);

}
public function laporan($Id_Job_SPK){


    $data = Post::join('td_joborder', 'td_wp_spk.Id_Job', '=', 'td_joborder.Id_Job')
    ->join('td_project', 'td_joborder.Id_Reg', '=', 'td_project.Id_Reg')
    ->join('ts_kapal', 'td_project.IdVessel', '=', 'ts_kapal.IdVessel')
    ->join('td_wp','td_joborder.Id_Job','=', 'td_wp.Id_Job')
    ->join('ts_karyawan_sk', 'td_wp_spk.Kode_Pelksn', '=', 'ts_karyawan_sk.nama_kary')
    ->select('*'
        // 'td_wp_spk.NoSPK',
        // 'td_wp_spk.Id_Job_SPK',
        // 'td_wp_spk.NoWBS',
        // 'td_project.Kode_Proyek',
        // 'ts_kapal.Nama Kapal'
    )
    ->where('td_wp_spk.Id_Job_SPK', $Id_Job_SPK) // Filter berdasarkan Id_Job_SPK
    ->first();
        // Ambil data SPK sesuai dengan ID yang diterima dari rute
        //$data = Post::find($Id_Job_SPK);
    
        // Ambil data realisasi sesuai dengan SPK yang dipilih
        $real = real::where('Id_Job_SPK', $Id_Job_SPK)->get();
    
        // Kirim data ke tampilan laporan

       $isCheckedA = $data->Val_A; // Ganti ini dengan data yang sesuai dari database untuk checkbox A
$isCheckedB = $data->Val_B; // Ganti ini dengan data yang sesuai dari database untuk checkbox B
$isCheckedC = $data->Val_C; // Ganti ini dengan data yang sesuai dari database untuk checkbox C
return  view('laporan', compact('data', 'real','isCheckedA', 'isCheckedB', 'isCheckedC'));
// $pdf = PDF::loadView('laporan', compact('data', 'real', 'isCheckedA', 'isCheckedB', 'isCheckedC'));
// $pdf->setPaper('A4', 'portrait'); // Atur ukuran kertas dan orientasi sesuai kebutuhan
// return $pdf->stream('laporan.pdf');
    
      
}
public function generatePDF()
{
    $data = ['title' => 'Welcome to Laravel PDF'];
    
    $pdf = Pdf::loadView('laporan', $data);

    return $pdf->stream('example.pdf'); // Menampilkan PDF di browser
}
// public function edit($Id_Job_SPK)
// {
//     $data = Post::find($Id_Job_SPK); // Mengambil data berdasarkan ID
//     return view('update', compact('data'));

// }
// public function update(Request $request,Post $id)
// {
//     $request->validate([
//         'nama' => 'required',
      
//     ]);

//     $id->update($request->all());

//     return redirect()->route('posts.index')
//                     ->with('success','Post updated successfully');


// }

}