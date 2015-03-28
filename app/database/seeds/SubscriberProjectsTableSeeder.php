<?php

class SubscriberProjectsTableSeeder extends Seeder {

    public function run()
    {
        foreach (Project::all() as $project) {
            $users = User::orderBy(DB::raw('RAND()'))->take(2)->get();
            foreach ($users as $user) {
                $user->subcribeProjects()->attach($project->id);
            }
        }
    }

}
