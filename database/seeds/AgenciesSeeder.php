<?php

use Illuminate\Database\Seeder;

class AgenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sample_agencies = [
            [
                'name' =>'Ag1',
                'about' => 'test',
                'link' => 'https://www.google.com'
            ],
            [
                'name' =>'Ag2',
                'about' => 'test',
                'link' => 'https://www.google.com'
            ],
            [
                'name' =>'Ag3',
                'about' => 'test',
                'link' => 'https://www.google.com'
            ]
        ];

        foreach ($sample_agencies as $agencie) {
            \App\Agencie::create($agencie);
        }
    }
}
