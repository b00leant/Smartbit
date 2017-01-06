<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        /*
        $int = mt_rand(1262055681,1262055681);
        $date = date("Y-m-d H:i:s",$int);
        // $this->call(UsersTableSeeder::class);
        DB::table('people')->insert([
            'nome' => str_random(10),
            'cognome' => str_random(10),
            'data_nascita' => $date,
            'email' => str_random(10).'@gmail.com',
            'telefono' => bcrypt('secret'),
            'luogo_nascita' => str_random(10)
        ]);*/
    }
}
