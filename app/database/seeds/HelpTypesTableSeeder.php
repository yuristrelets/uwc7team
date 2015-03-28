<?php

class HelpTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('help_types')->delete();

        HelpType::create([
                'name' => 'Финансовая'
            ]);

        HelpType::create([
                'name' => 'Время'
            ]);

        HelpType::create([
                'name' => 'Код'
            ]);
    }

}
