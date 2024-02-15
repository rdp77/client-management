<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Marketer;
use App\Models\Product;
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

        Client::factory()->count(25)->create();
        Marketer::factory()->count(25)->create();
        Product::factory()->count(50)->create();
        Category::factory()->count(10)->create();

        Notification::make()
            ->title('Welcome to Filament')
            ->body('You are ready to start building your application.')
            ->success()
            ->sendToDatabase($user);
    }
}
