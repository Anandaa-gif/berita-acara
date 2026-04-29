<?php

namespace App\Exports;

use App\Models\BeritaAcara;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;

class BeritaAcaraExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    use Exportable;

    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return BeritaAcara::query()
            ->with('user')
            ->whereBetween('tanggal_registrasi', [$this->startDate, $this->endDate])
            ->latest();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelanggan',
            'No. KTP',
            'Email',
            'No. HP',
            'Alamat',
            'Tanggal Registrasi',
            'Paket',
            'Jenis Perangkat',
            'Biaya Registrasi',
            'Teknisi 1',
            'Teknisi 2',
            'Dibuat Oleh',
            'Tgl Dibuat',
        ];
    }

    public function map($ba): array
    {
        return [
            $ba->id,
            $ba->nama,
            $ba->no_ktp,
            $ba->email,
            $ba->no_hp,
            $ba->alamat,
            $ba->tanggal_registrasi,
            $ba->paket_berlangganan,
            $ba->jenis_perangkat,
            $ba->biaya_registrasi,
            $ba->nama_teknisi_1,
            $ba->nama_teknisi_2,
            $ba->user->name ?? '-',
            $ba->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
