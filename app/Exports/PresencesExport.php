<?php

namespace App\Exports;

use App\Models\SessionPresence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PresencesExport implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
{
    public function __construct(private SessionPresence $session) {}

    public function collection()
    {
        return $this->session->presences->map(function ($presence, $index) {
            return [
                'N°'          => $index + 1,
                'Matricule'   => $presence->agent->matricule ?? '—',
                'Prénom'      => $presence->agent->prenom ?? '—',
                'Nom'         => $presence->agent->nom ?? '—',
                'Email'       => $presence->agent->email ?? '—',
                'Heure'       => $presence->date_heure ? $presence->date_heure->format('H:i:s') : '—',
                'Adresse IP'  => $presence->adresse_ip ?? '—',
            ];
        });
    }

    public function headings(): array
    {
        return ['N°', 'Matricule', 'Prénom', 'Nom', 'Email', 'Heure de marquage', 'Adresse IP'];
    }

    public function title(): string
    {
        return 'Présences';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
