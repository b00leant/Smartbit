<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $unixTimestap = '1461067200';
        foreach (range(1,10) as $index) {
            //Generate a timestamp using mt_rand.
            $timestamp = mt_rand(1, time());
             
            //Format that timestamp into a readable date string.
            $randomDate = date("d M Y", $timestamp);
                        
	        DB::table('people')->insert([
	            'nome' => $faker->firstName,
	            'email' => $faker->email,
	            'cognome'=> $faker->lastName,
	            //'data_nascita' => $faker->$randomDate,
	            'data_nascita' => $faker->time,
	            'telefono'=> $faker->phoneNumber,
	            'luogo_nascita'=>$faker->city,
	        ]);
        }
    }
}
