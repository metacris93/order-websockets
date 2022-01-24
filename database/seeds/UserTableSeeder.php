<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'email' => 'user@aol.com'
        ]);
        factory(App\User::class)->state('admin')->create([
            'email' => 'admin@aol.com'
        ]);
    }
}
