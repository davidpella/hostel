<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoicesExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    public function query(): Builder
    {
        return Invoice::query()
            ->select(['amount'])
            ->withRoomNumber()
            ->withRoomCapacity()
            ->withTenantName()
            ->withTenantGender()
            ->withTenantCourseName()
            ->withTenantLocale()
            ->withTenantRegistrationNumber();
    }

    public function headings(): array
    {
        return [
            ['Academic year 2020/21 semester one', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            ['New hostel', ' ', ' ', ' ', ' ', ' ', ' ', ' '],
            ['Room number', 'Capacity', 'Name of tenant', 'Gender', 'Course', 'Internation', 'Registration number', 'Invoice',]
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            'A'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],
            ],
            'B'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ],
            ],
            'C'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],
            ],
            'D'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],

            ],
            'E'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],
            ],
            'F'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],
            ],
            'G'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],
            ],
            'H'  => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'BFDBFE'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ],
            ],

            1 => [
                'font' => [
                    'size' => 14
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'FFFFFF'
                    ]
                ],
            ],
            2 => [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'FFFFFF'
                    ]
                ],
            ],
            3 => [
                'font' => [
                    'bold' => true,
                    'size' => 14,

                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'FFFFFF'
                    ]
                ],
            ],
            4 => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => '1D4ED8'
                    ],
                ],
                'borders' => [
                    'top' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ],
            5 => [
                'borders' => [
                    'top' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'rgb' => '3B82F6'
                        ],
                    ],
                ],
            ],
        ];
    }

    public function map($row): array
    {
        return [
            $row->room_number,
            $row->room_capacity,
            $row->tenant_name,
            $row->tenant_gender,
            $row->tenant_course_name,
            $row->tenant_locale,
            $row->tenant_registration_number,
            $row->amount,
        ];
    }
}
