<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DisableGraduatedStudents extends Command
{
    protected $signature = 'students:disable-graduated';
    protected $description = 'Disable student accounts that have passed their graduation date';

    public function handle()
    {
        $today = Carbon::today();

        $students = User::where('role', 'student')
            ->where('status', 'active')
            ->whereNotNull('graduate_day')
            ->where('graduate_day', '<=', $today)
            ->get();

        $count = 0;
        foreach ($students as $student) {
            $student->update(['status' => 'disabled']);
            $count++;
        }

        $this->info("Disabled {$count} graduated student accounts.");
    }
}