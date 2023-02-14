<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DummyTask;
use App\Exports\DummyTasksExport;

class ExportableDataTableComponent extends Component
{
    public $selected = []; // This is the array of selected rows

    public function render()
    {
        $tasks = DummyTask::latest()->get();

        return view('livewire.exportable-data-table-component', compact('tasks'));
    }

    public function exportToCsv()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new DummyTasksExport($this->selected))->download('dummy_tasks_' . date('Y-m-d') . '_' . now()->toTimeString() . '.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportToXls()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new DummyTasksExport($this->selected))->download('dummy_tasks_' . date('Y-m-d') . '_' . now()->toTimeString() . '.xlsx');
    }

    public function exportToPdf()
    {
        if ($this->isArrayEmpty()) {
            return;
        }

        return (new DummyTasksExport($this->selected))->download('dummy_tasks_' . date('Y-m-d') . '_' . now()->toTimeString() . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function isArrayEmpty()
    {
        if ($this->selected) {
            return false;
        }

        session()->flash('error', 'Please select at least one row to export');

        return true;
    }
}
