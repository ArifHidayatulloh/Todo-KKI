<?php

namespace App\Exports;

use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class TodosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $status;

    public function __construct($status){
        $this->status = $status;
    }
    public function view(): View
    {
        if($this->status){
            return view('todo.exports', [
                'todo' => Todo::where('status', $this->status)->get(),
            ]);
        }
        return view('todo.exports',[
            'todo' => Todo::all()
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Iterate over columns to auto-size
                foreach ($sheet->getColumnIterator() as $column) {
                    $columnIndex = $column->getColumnIndex();
                    $sheet->getColumnDimension($columnIndex)->setAutoSize(true);
                }
            },
        ];
    }

}
