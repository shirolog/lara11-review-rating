<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([

            [
                'title' => '01 example post title',
                'image' => 'post_1.webp',
            ],

            [
                'title' => '02 example post title',
                'image' => 'post_2.webp',
            ],

            [
                'title' => '03 example post title',
                'image' => 'post_3.webp',
            ],

            [
                'title' => '04 example post title',
                'image' => 'post_4.webp',
            ],

            [
                'title' => '05 example post title',
                'image' => 'post_5.webp',
            ],

            [
                'title' => '06 example post title',
                'image' => 'post_6.webp',
            ],

        ]);
    }
}
