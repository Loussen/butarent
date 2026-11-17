<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

         $this->call([
             BrandModelSeeder::class,
             CarSeeder::class,
             adminDemo::class,
             SiteContentSeeder::class,
         ]);

    }
}
