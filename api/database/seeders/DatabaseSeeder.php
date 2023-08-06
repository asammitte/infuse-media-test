<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Domain\User\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(7)->hasProfile()->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $users = User::all()->pluck('id')->toArray();
        // foreach($users as $user)
		// {
        //     DB::table('course_student')->insert([
        //         'course_id' => $faker->randomElement($coursesIDs)
        //         'student_id' => $faker->randomElement($studentsIDs)
        //     ]);
		// 	Company::create([
		// 		'owner_id' 	=> $user->id,
		// 		'name' 		=> $faker->company,
		// 		'created_at'	=> $faker->dateTime($max = 'now')
		// 	]);
		// }
    }
}
