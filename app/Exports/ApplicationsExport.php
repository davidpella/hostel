<?php

namespace App\Exports;

use App\Models\Application;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ApplicationsExport implements FromQuery, ShouldAutoSize, WithMapping, WithHeadings, WithStyles
{
    public function query(): Builder
    {
        return Application::select(['amount'])
            ->withTenantName()
            ->withTenantGender()
            ->withTenantLocale()
            ->withTenantRegistrationNumber()
            ->withTenantCourseName()
            ->WithRoomTypeNumber()
            ->WithRoomTypeCapacity();
    }

    public function map($row): array
    {
        return [
            $row->room_type_name,
            $row->room_type_capacity,
            $row->tenant_name,
            $row->tenant_gender,
            $row->tenant_course_name,
            $row->tenant_locale,
            $row->tenant_registration_number,
            $row->amount,
        ];
    }

    public function headings(): array
    {
        return [
            [
                'Room type',
                'Capacity',
                'Name of tenant',
                'Gender',
                'Course',
                'Internation',
                'Registration number',
                'Invoice',
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
            ],
            'H'  => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ],
            ],
            'B'  => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ],
            ],
        ];
    }
}
