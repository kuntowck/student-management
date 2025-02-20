<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class LatestGradesCell extends Cell
{
    protected $grades = [], $latestGrades = [];

    public function mount($grades)
    {
        $this->grades[] = $grades;

        if (count($this->grades) > 5) {
            $this->latestGrades = array_slice($this->grades, -6, 5);
        } else {
            $this->latestGrades = $this->grades;
        }
    }

    public function getGradesProperty()
    {
        return $this->grades;
    }

    public function getLatestGradesProperty()
    {
        return $this->latestGrades;
    }
}
