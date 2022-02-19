<?php

namespace Database\Seeders;

use App\Models\CheckIn;
use App\Models\Group;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithFaker;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // always define factories to make testing easier

         // create a user
        $instructor = User::create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'role' => 1 // instructor
        ]);

         // let's create a sample group
        $group = Group::create([
            'user_id' => $instructor->id,
            'group_name' => 'group_1',
            'member1' =>  'member1',
            'member2' =>  'member2',
            'member3' => 'member3',
            'member4' => 'member4',
            'section' => 'section',
        ]);

        $room = Room::create([
            'user_id' => $instructor->id,
            'rname' => 'secret',
            'rkey' => 'secret',
            'description' => 'secret room',
        ]);

        // let's create some students
        $students =  \App\Models\User::factory(10)
            ->create();

        // let's populate the room
        $studentsToRoom = $students->random(3);

        foreach ($studentsToRoom as $student) {
            CheckIn::create([
                'user_id' => $student->id,
                'room_id' => 1,
            ]);
        }
    }
}
