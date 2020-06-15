<?php
namespace App\Entities;

trait CourseEntity {
    public function increaseHours(int $n)
    {
        $increment = $this->total_hours + $this->incrementBy($n);

        if ($increment <= $this::THRESHOLD) {
            $this->total_hours = $increment;
            $this->save();

            return true;
        } else {
            return false;
        }
    }
    public function decreaseHours(int $n)
    {
        $decrement = $this->total_hours - $n;

        if ($decrement < $this::MINIMUM) {
            return false;
        } else {
            $this->total_hours = $decrement;
            $this->save();
            return true;
        }

    }
    private function incrementBy(int $n)
    {
        switch ($n) {
            case 1:
                $increment = $this::FIRST_INCREMENT;
                break;
            case 2:
                $increment = $this::SECOND_INCREMENT;
                break;
            case 3:
                $increment = $this::THIRD_INCREMENT;
                break;
            default:
                $increment = $n;
                break;
        }
        return $increment;
    }
}
