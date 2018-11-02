<?php

use Illuminate\Database\Seeder;

class BookdetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // bookdetailsテーブルにレコードを50件追加する
        factory(\App\Bookdetail::class, 50)->create();
    }
}
