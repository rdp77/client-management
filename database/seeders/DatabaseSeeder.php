<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.test',
            'password' => Hash::make('admin'),
        ]);

        Notification::make()
            ->title('Welcome to Filament')
            ->body('You are ready to start building your application.')
            ->success()
            ->sendToDatabase($user);
    }
}
