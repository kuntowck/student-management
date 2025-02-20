<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class AcademicStatusCell extends Cell
{
    protected $status;
    protected $theme;

    public function mount($status)
    {
        $this->status = $status;

        if ($this->status === 'active' || $this->status === 'Active') {
            $this->theme = 'green';
        } else if ($this->status === 'on leave' || $this->status === 'On Leave') {
            $this->theme = 'red';
        } else {
            $this->theme = 'gray';
        }
    }

    public function getStatusProperty()
    {
        return $this->status;
    }

    public function getThemeProperty()
    {
        return $this->theme;
    }
}
