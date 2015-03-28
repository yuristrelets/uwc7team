<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
                'email' => 'pavel.grudina@gmail.com',
                'username' => 'Pavel',
                'password' => Hash::make('123'),
                'admin' => 1
            ]);

        User::create([
                'email' => 'yuristrelets@gmail.com',
                'username' => 'Yuri',
                'password' => Hash::make('123'),
                'admin' => 1
            ]);

        User::create([
                'email' => 'nasguling@gmail.com',
                'username' => 'alex',
                'password' => Hash::make('123'),
                'admin' => 1
            ]);

        User::create([
                'email' => 'userrrrrrrrr@gmaadsail.com',
                'username' => 'user_test',
                'password' => Hash::make('123')
            ]);

        User::create([
                'email' => 'usertest2@gmaadsail.com',
                'username' => 'user_test2',
                'password' => Hash::make('123')
            ]);

        User::create([
                'email' => 'usertest3@gmaadsail.com',
                'username' => 'user_test3',
                'password' => Hash::make('123')
            ]);
    }

}
