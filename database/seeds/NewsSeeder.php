<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencie1 = \App\Agencie::find(1);
        $agencie2 = \App\Agencie::find(2);
        $agencie3 = \App\Agencie::find(3);
        $sample_news = [
            [
                'title' => "number 1",
                'description' => "test",
                'releaseDate' => \Carbon\Carbon::now()->toDate()->format("Y-m-d H:i:s"),
                'rate' => 7,
                'agencie_id' => $agencie1->id
            ],
            [
                'title' => "number 2",
                'description' => "test",
                'releaseDate' => \Carbon\Carbon::now()->toDate()->format("Y-m-d H:i:s"),
                'rate' => 6,
                'agencie_id' => $agencie1->id
            ],
            [
                'title' => "number 3",
                'description' => "test",
                'releaseDate' => \Carbon\Carbon::now()->toDate()->format("Y-m-d H:i:s"),
                'rate' => 4,
                'agencie_id' => $agencie2->id
            ],
            [
                'title' => "number 4",
                'description' => "test",
                'releaseDate' => \Carbon\Carbon::now()->toDate()->format("Y-m-d H:i:s"),
                'rate' => 6,
                'agencie_id' => $agencie2->id
            ],
            [
                'title' => "number 5",
                'description' => "test",
                'releaseDate' => \Carbon\Carbon::now()->toDate()->format("Y-m-d H:i:s"),
                'rate' => 2,
                'agencie_id' => $agencie3->id
            ],
            [
                'title' => "number 6",
                'description' => "test",
                'releaseDate' => \Carbon\Carbon::now()->toDate()->format("Y-m-d H:i:s"),
                'rate' => 10,
                'agencie_id' => $agencie3->id
            ]
        ];

        foreach ($sample_news as $news) {
            \App\News::create($news);
        }
    }
}
