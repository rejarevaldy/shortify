<?php

namespace Database\Seeders;

use App\Models\Audit;
use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        $faker = \Faker\Factory::create();


        for ($i = 0; $i < 100; $i++) {
            $shorted_link = bin2hex(random_bytes(5));

            $link_audit = Audit::create([
                "hit_count"     => $i,
                "status"        => $i % 2 == 0 ? 'active' : 'inactive'
            ])->fresh();

            $link = Link::create([
                'title'         => 'Title for ' . $i,
                'link'          => 'https://github.com/rejarevaldy/',
                'shorted_link'  => $shorted_link,
                'user_id'       => User::all()->first()->pluck('id')[0],
                'link_audit_id' => $link_audit->id
            ])->fresh();
        }
    }
}
