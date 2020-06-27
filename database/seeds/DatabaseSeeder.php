<?php

use Illuminate\Database\Seeder;
use ShiftechAfrica\CodeGenerator\Seeds\ShiftCodeGeneratorFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ScriptsTableSeeder::class);
        $this->call(ShiftCodeGeneratorFactory::class);

    }
}
