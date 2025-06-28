<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        if ($user instanceof \App\Models\User) {
            // Update status jadi 'Ditolak' kalau sudah kadaluarsa
            $user->deposit()
                ->where('status', 'Menunggu')
                ->where('expired_at', '<', Carbon::now())
                ->update([
                    'status' => 'Ditolak',
                    'alasan_penolakan' => 'Batas Waktu Sudah Habis',
                ]);
    
            // Ambil semua data deposit untuk ditampilkan
            $deposits = $user->deposit()->orderBy('created_at', 'desc')->get();
        } else {
            $deposits = collect();
        }
    
        return view('user.deposit.index', ['deposits' => $deposits]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.deposit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'nominal' => 'required|integer|min:20000',
        ]);
        DB::beginTransaction();
        try {
            // Simpan bukti pembayaran
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $filename = time() . '_' . $file->getClientOriginalName();
               $buktifile =  $file->move(public_path('assets/images'), $filename);   
                }

            // Buat deposit baru
            $user = Auth::user();
            $deposit = new \App\Models\Deposit();
            $deposit->user_id = $user->id;
            $deposit->metode_pembayaran = $request->metode_pembayaran;
            $deposit->bukti = $buktifile->getFilename(); // Simpan path bukti pembayaran
            $deposit->status = 'Menunggu'; // Status awal deposit
            $deposit->nominal_before = $user->saldo; // Nilai awal sebelum deposit
            $deposit->nominal = $request->nominal; // Nominal deposit
            $deposit->expired_at = Carbon::now()->addMinutes(30); // Waktu deposit berakhir

            $deposit->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal membuat deposit: ' . $e->getMessage()]);
        }
        // Simpan deposit ke database
        // Logika penyimpanan deposit akan ditambahkan di sini

        return redirect()->route('user.deposit.index')->with('success', 'Deposit berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function adminindex()
    {
        $deposits = Deposit::with('user')->orderBy('created_at', 'desc')->get();
        foreach ($deposits as $deposit) {
            if($deposit->expired_at < Carbon::now()&&$deposit->status == 'Menunggu'){
                $deposit->delete();
            }        
         }
        return view('admin.deposit.index', [
            'deposits' => $deposits,
        ]);

       
    }

    public function adminApprove(string $id)
    {
        DB::beginTransaction();
        try {
            $deposit = Deposit::find($id);
            $deposit->status = 'Disetujui';
            $deposit->save();
            $user = User::find($deposit->user_id);
            $user->saldo = $user->saldo + $deposit->nominal;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal mengubah status deposit: ' . $e->getMessage()]);
        }
        return redirect()->route('admin.deposit.index')->with('success', 'Deposit berhasil disetujui.');
    }

    public function adminReject(Request $request, $id)
{
    $request->validate([
        'alasan' => 'required|string|max:1000',
    ]);

    $deposit = Deposit::findOrFail($id);
    $deposit->status = 'Ditolak';
    $deposit->alasan_penolakan = $request->alasan;
    $deposit->save();

    return redirect()->route('admin.deposit.index')->with('success', 'Deposit ditolak dengan alasan.');
}

    
}
