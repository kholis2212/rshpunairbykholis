<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    /**
     * Menampilkan daftar reservasi pemilik
     */
    public function index()
    {
        try {
            // Ambil ID pemilik dari user yang login
            $pemilik = DB::table('pemilik')
                ->where('iduser', Auth::id())
                ->first();

            if (!$pemilik) {
                return redirect()->route('pemilik.dashboard-pemilik')
                    ->with('error', 'Data pemilik tidak ditemukan!');
            }

            // Ambil data reservasi dengan join ke tabel terkait
            $reservasi = DB::table('temu_dokter')
                ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
                ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                ->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
                ->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')
                ->where('pet.idpemilik', $pemilik->idpemilik)
                ->select(
                    'temu_dokter.idreservasi_dokter',
                    'temu_dokter.no_urut',
                    'temu_dokter.waktu_daftar',
                    'temu_dokter.status',
                    'pet.nama as nama_pet',
                    'pet.jenis_kelamin',
                    'ras_hewan.nama_ras',
                    'jenis_hewan.nama_jenis_hewan',
                    'user.nama as nama_dokter',
                    DB::raw("DATE_FORMAT(temu_dokter.waktu_daftar, '%d %M %Y') as tanggal_daftar"),
                    DB::raw("DATE_FORMAT(temu_dokter.waktu_daftar, '%H:%i') as jam_daftar")
                )
                ->orderBy('temu_dokter.waktu_daftar', 'desc')
                ->get();

            // Statistik untuk cards
            $totalReservasi = $reservasi->count();
            $reservasiHariIni = $reservasi->where('tanggal_daftar', now()->format('d %M %Y'))->count();
            $reservasiAktif = $reservasi->where('status', 'P')->count();
            $reservasiSelesai = $reservasi->where('status', 'S')->count();

            return view('pemilik.reservasi.index', compact(
                'reservasi',
                'totalReservasi',
                'reservasiHariIni',
                'reservasiAktif',
                'reservasiSelesai'
            ));

        } catch (\Exception $e) {
            return redirect()->route('pemilik.dashboard-pemilik')
                ->with('error', 'Terjadi kesalahan saat memuat data reservasi: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail reservasi
     */
    public function show($id)
    {
        try {
            // Ambil ID pemilik dari user yang login
            $pemilik = DB::table('pemilik')
                ->where('iduser', Auth::id())
                ->first();

            if (!$pemilik) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data pemilik tidak ditemukan!'
                ], 404);
            }

            // Ambil detail reservasi
            $reservasi = DB::table('temu_dokter')
                ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
                ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                ->leftJoin('role_user', 'temu_dokter.idrole_user', '=', 'role_user.idrole_user')
                ->leftJoin('user', 'role_user.iduser', '=', 'user.iduser')
                ->leftJoin('pemilik as pemilik_pet', 'pet.idpemilik', '=', 'pemilik_pet.idpemilik')
                ->leftJoin('user as user_pemilik', 'pemilik_pet.iduser', '=', 'user_pemilik.iduser')
                ->where('temu_dokter.idreservasi_dokter', $id)
                ->where('pet.idpemilik', $pemilik->idpemilik)
                ->select(
                    'temu_dokter.idreservasi_dokter',
                    'temu_dokter.no_urut',
                    'temu_dokter.waktu_daftar',
                    'temu_dokter.status',
                    'pet.nama as nama_pet',
                    'pet.tanggal_lahir',
                    'pet.warna_tanda',
                    'pet.jenis_kelamin',
                    'ras_hewan.nama_ras',
                    'jenis_hewan.nama_jenis_hewan',
                    'user.nama as nama_dokter',
                    'user_pemilik.nama as nama_pemilik',
                    'pemilik_pet.alamat',
                    'pemilik_pet.no_wa',
                    DB::raw("DATE_FORMAT(temu_dokter.waktu_daftar, '%d %M %Y') as tanggal_daftar"),
                    DB::raw("DATE_FORMAT(temu_dokter.waktu_daftar, '%H:%i') as jam_daftar"),
                    DB::raw("TIMESTAMPDIFF(YEAR, pet.tanggal_lahir, CURDATE()) as usia_tahun"),
                    DB::raw("TIMESTAMPDIFF(MONTH, pet.tanggal_lahir, CURDATE()) % 12 as usia_bulan")
                )
                ->first();

            if (!$reservasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data reservasi tidak ditemukan!'
                ], 404);
            }

            // Format data untuk response
            $data = [
                'reservasi' => $reservasi,
                'status_text' => $this->getStatusText($reservasi->status),
                'status_color' => $this->getStatusColor($reservasi->status),
                'jenis_kelamin_text' => $reservasi->jenis_kelamin == 'J' ? 'Jantan' : ($reservasi->jenis_kelamin == 'B' ? 'Betina' : 'Tidak Diketahui'),
                'usia_text' => $this->formatUsia($reservasi->usia_tahun, $reservasi->usia_bulan)
            ];

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Helper: Mendapatkan teks status
     */
    private function getStatusText($status)
    {
        $statuses = [
            'P' => 'Menunggu',
            'S' => 'Selesai',
            'B' => 'Dibatalkan'
        ];

        return $statuses[$status] ?? 'Tidak Diketahui';
    }

    /**
     * Helper: Mendapatkan warna status
     */
    private function getStatusColor($status)
    {
        $colors = [
            'P' => 'warning',
            'S' => 'success',
            'B' => 'danger'
        ];

        return $colors[$status] ?? 'secondary';
    }

    /**
     * Helper: Format usia
     */
    private function formatUsia($tahun, $bulan)
    {
        if ($tahun === null && $bulan === null) {
            return 'Tidak diketahui';
        }

        $parts = [];
        if ($tahun > 0) {
            $parts[] = $tahun . ' tahun';
        }
        if ($bulan > 0) {
            $parts[] = $bulan . ' bulan';
        }

        return $parts ? implode(' ', $parts) : 'Kurang dari 1 bulan';
    }

    /**
     * QUERY BUILDER LAINNYA
     */

    // 1. Count total reservasi aktif
    public function countReservasiAktif()
    {
        $pemilik = DB::table('pemilik')
            ->where('iduser', Auth::id())
            ->first();

        if (!$pemilik) return 0;

        $count = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where('pet.idpemilik', $pemilik->idpemilik)
            ->where('temu_dokter.status', 'P')
            ->count();

        return $count;
    }

    // 2. Ambil 5 reservasi terbaru
    public function getLatestReservasi()
    {
        $pemilik = DB::table('pemilik')
            ->where('iduser', Auth::id())
            ->first();

        if (!$pemilik) return collect();

        $latest = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->where('pet.idpemilik', $pemilik->idpemilik)
            ->select(
                'temu_dokter.idreservasi_dokter',
                'temu_dokter.no_urut',
                'temu_dokter.waktu_daftar',
                'temu_dokter.status',
                'pet.nama as nama_pet',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->orderBy('temu_dokter.waktu_daftar', 'desc')
            ->limit(5)
            ->get();

        return $latest;
    }

    // 3. Statistik reservasi bulan ini
    public function getStatistikBulanIni()
    {
        $pemilik = DB::table('pemilik')
            ->where('iduser', Auth::id())
            ->first();

        if (!$pemilik) return [];

        $statistik = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where('pet.idpemilik', $pemilik->idpemilik)
            ->whereYear('temu_dokter.waktu_daftar', now()->year)
            ->whereMonth('temu_dokter.waktu_daftar', now()->month)
            ->select(
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "P" THEN 1 ELSE 0 END) as menunggu'),
                DB::raw('SUM(CASE WHEN status = "S" THEN 1 ELSE 0 END) as selesai'),
                DB::raw('SUM(CASE WHEN status = "B" THEN 1 ELSE 0 END) as batal')
            )
            ->first();

        return $statistik;
    }
}