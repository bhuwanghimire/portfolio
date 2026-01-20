<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'name' => 'Alex Doe',
            'email' => 'alex@example.com',
            'phone' => '0123456789',
            'location' => 'New York, USA',
            'bio' => 'I am a passionate UI/UX Designer and Frontend Developer based in New York. I have a strong background in design principles and a keen eye for detail. My goal is to create intuitive and aesthetically pleasing digital experiences that solve real-world problems.',
            'title' => 'UI/UX Designer & Frontend Developer',
            'availability_status' => 'open',
            'years_experience' => 7,
            'completed_projects' => 120,
            'happy_clients' => 50,
            'about_me' => 'I am a passionate UI/UX Designer and Frontend Developer based in New York. I have a strong background in design principles and a keen eye for detail. My goal is to create intuitive and aesthetically pleasing digital experiences that solve real-world problems.',
            'headline' => 'Welcome to my world',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

