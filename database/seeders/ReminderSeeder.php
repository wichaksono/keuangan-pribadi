<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReminderSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();

        $reminders = [];

        for ($i = 1; $i <= 5; $i++) {
            $reminders[] = [
                'id'           => Str::uuid(),
                'title'        => 'Reminder ' . $i,
                'description'  => 'This is a description for reminder ' . $i,
                'reference_type' => null,
                'reference_id' => null,
                'reminder_at'  => Carbon::now()->addDays($i),
                'created_by'   => $users[array_rand($users)],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ];
        }

        DB::table('reminders')->insert($reminders);
    }
}
