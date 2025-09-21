<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReminderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('Tidak ada user untuk dijadikan creator.');
            return;
        }

        // Contoh data reminders
        $reminders = [
            [
                'title' => 'Bayar Listrik',
                'description' => 'Bayar tagihan listrik bulan ini sebelum tanggal 25',
                'priority' => 'high',
                'reminder_at' => Carbon::now()->addDays(2),
                'is_completed' => false,
            ],
            [
                'title' => 'Belanja Mingguan',
                'description' => 'Belanja kebutuhan rumah tangga',
                'priority' => 'normal',
                'reminder_at' => Carbon::now()->addDays(1),
                'is_completed' => false,
            ],
            [
                'title' => 'Periksa Gigi',
                'description' => 'Janji kontrol gigi rutin',
                'priority' => 'low',
                'reminder_at' => Carbon::now()->addWeeks(1),
                'is_completed' => false,
            ],
        ];

        foreach ($reminders as $data) {
            Reminder::create(array_merge($data, [
                'id' => (string) Str::uuid(),
                'created_by' => $users->random()->id,
            ]));
        }
    }
}
