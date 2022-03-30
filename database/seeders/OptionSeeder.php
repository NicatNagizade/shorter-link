<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $option = new Option();
        $option->key = 'short_link_last_id';
        $option->value = 1;
        $option->save();
    }
}
