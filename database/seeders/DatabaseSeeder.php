<?php

namespace Database\Seeders;

use Brick\Math\BigInteger;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('desks')->insert([

            'name' => Str::random(10),
        ]);

    }
}
