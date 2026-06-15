<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agent;
use App\Services\AgentService;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = Excel::toCollection(new class implements ToCollection, WithHeadingRow {
            public function collection(Collection $rows)
            {
            }
        }, storage_path('app/IT_ELITE_présence.xlsx'));

        foreach ($rows->first() as $row) {
            if (empty($row['nom']))
                continue;

            Agent::firstOrCreate(
                ['email' => $row['email'] ?? strtolower($row['nom']) . '@elite-it.com'],
                [
                    'nom' => $row['nom'],
                    'prenom' => $row['prenoms'],
                    'password' => Hash::make('Elite@2026'),
                    'structure' => $row['structure'] ?? 'ELITE IT',
                    'telephone' => $row['telephone'] ?? null,
                    'qr_code_uuid' => Str::uuid()->toString(),
                    'actif' => true,
                ]
            );
        }
    }
}