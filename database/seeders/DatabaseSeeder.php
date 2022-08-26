<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // for genatating API Key
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Project::truncate();
        Task::truncate();
        DB::table('project_user')->truncate();

        $admin = User::create([
            'name'=>'Super Admin',
            'email'=>'admin@local',
            'password' => bcrypt('password'),
            'api_token'=>Str::random(60),
        ]);
        $user1 = User::create([
            'name'=>'mta',
            'email'=>'mta@local',
            'password' => bcrypt('password'),
            'api_token'=>Str::random(60),
        ]);
        $proj = Project::create([
           'title' => 'Project Manager Development',
           'description' =>'write the database with test data',
           'manager_id'=>$admin->id,
        ]);
        $task1 =Task ::create([
            'title' => 'seed Database',
            'description' =>'Seed the database with test data.',
            'user_id'=>$admin->id,
            'project_id'=>$proj->id,
            'status_code'=>'COMP',
        ]);

         $task2 =Task ::create([
            'title' => 'Complete Dev',
            'description' =>'write code maiu',
            'user_id'=>$user1->id,
            'project_id'=>$proj->id,
            'status_code'=>'OPEN',
         ]); 

         //pubulate user table

         $proj->users()->saveMany([$admin,$user1]);
    }
}
