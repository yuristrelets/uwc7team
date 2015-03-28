<?php

class TagTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->delete();

        Tag::create([
                'name' => 'Помощь военным',
            ]);

        Tag::create([
                'name' => 'Помощт пенсионерам',
            ]);

        Tag::create([
                'name' => 'Помощь детскому дому',
            ]);

        Tag::create([
                'name' => 'Помощь госпиталю',
            ]);

        Tag::create([
                'name' => 'Ремонт детского дома',
            ]);

        Tag::create([
                'name' => 'Ремонт',
            ]);

        Tag::create([
                'name' => 'Военное оборудование',
            ]);

        Tag::create([
                'name' => 'Самолет',
            ]);

        Tag::create([
                'name' => 'амуниция',
            ]);

        Tag::create([
                'name' => 'обувь',
            ]);

        Tag::create([
                'name' => 'одежда',
            ]);

        foreach (Project::all() as $project) {
            $tags = Tag::orderBy(DB::raw('RAND()'))->take(5)->get();
            foreach ($tags as $tag) {
                $tag->projects()->attach($project->id);
            }
        }
    }

}
