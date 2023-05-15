<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\LinkSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'admin',
            'username'          => 'admin',
            'email'             => 'admin@gmail.co.id',
            'password'          =>  Hash::make('admin'),
        ]);

        $this->call(LinkSeeder::class);
    }
}
