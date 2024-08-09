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
    protected $dep_code;
    protected $pic;

    public function __construct($status, $dep_code, $pic)
    {
        $this->status = $status;
        $this->dep_code = $dep_code;
        $this->pic = $pic;
    }
    public function view(): View
    {
        $query = Todo::query();

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->dep_code) {
            $query->where('dep_code', $this->dep_code);
        }

        if ($this->pic) {
            $query->where('pic', $this->pic);
        }

        $todos = $query->get();

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
