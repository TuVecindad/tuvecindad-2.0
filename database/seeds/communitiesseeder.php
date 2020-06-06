<?php

use Illuminate\Database\Seeder;

class communitiesseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    factory(App\Community::class, 50)->create()->each(function ($communities) {
        $communities->users()->save(factory(App\User::class)->make());
    });
}
}
