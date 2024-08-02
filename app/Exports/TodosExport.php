<?php

namespace App\Exports;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TodosExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }
    public function view(): View
    {
        $todos = $this->status ? Todo::where('status', $this->status)->get() : Todo::all();

        foreach ($todos as $todo) {
            $todo->comment_dephead = nl2br(e($todo->comment_dephead));
            $todo->update_pic = nl2br(e($todo->update_pic));
        }

        return view('todo.exports', ['todo' => $todos]);
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply wrap text style to specific columns
        $sheet->getStyle('I')->getAlignment()->setWrapText(true);
        $sheet->getStyle('J')->getAlignment()->setWrapText(true);

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(150);
        $sheet->getColumnDimension('C')->setWidth(170);
        $sheet->getColumnDimension('D')->setWidth(170);
        $sheet->getColumnDimension('E')->setWidth(170);
        $sheet->getColumnDimension('F')->setWidth(100);
        $sheet->getColumnDimension('G')->setWidth(100);
        $sheet->getColumnDimension('H')->setWidth(100);
        $sheet->getColumnDimension('I')->setWidth(250);
        $sheet->getColumnDimension('J')->setWidth(250);

        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A:J')->getAlignment()->setVertical('center');
        $sheet->getStyle('A:J')->getAlignment()->setHorizontal('center');
    }
}
