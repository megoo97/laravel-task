<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

trait DailyNewsTrait
{
    public function flattenArray($daily_news)
    {
        $news_array = [];
        foreach ($daily_news as $key => $item) {
            foreach ($item['latestnews'] as $news) {
                $news['agencie'] = $key;
                array_push($news_array, $news);
            }
        }
        return $news_array;
    }

    public function sortArraybyDateAsc($flat_news_array) {
        usort($flat_news_array, function($a, $b) {
            $result=$this->compareDate($a,$b);
            $equality_sort_type="ASC";
            if($result === -1) {
                if($equality_sort_type=="ASC") {
                return $this->compareRating($a,$b);
                }
                return $this->compareRating($b,$a);
            }

            return $result;
        });
        return $flat_news_array;
    }

    public function sortArraybyDateDesc($flat_news_array) {
        usort($flat_news_array, function($a, $b) {
            $result=$this->compareDate($b,$a);
            $equality_sort_type="ASC";
            if($result === -1) {
                if($equality_sort_type=="ASC") {
                return $this->compareRating($a,$b);
                }
                return $this->compareRating($b,$a);
            }
            return $result;
        });
        return $flat_news_array;
    }

    public function convertRatingToNumber($rating) {
        if($rating != null && str_contains($rating,"/10")){
            return (float)str_replace("/10","",$rating);
        }
    }

    public function sortArraybyRatingAsc($flat_news_array) {
        usort($flat_news_array, function($a, $b) {
            $result=$this->compareRating($a,$b);
            $equality_sort_type="DESC";
            if($result == 0) {
                if($equality_sort_type=="ASC") {
                    return $this->compareDate($a,$b);
                }

                return $this->compareDate($b,$a);
            }
            return $result;
        });
        return $flat_news_array;
    }
    public function sortArraybyRatingDesc($flat_news_array) {
        usort($flat_news_array, function($a, $b) {
            $result=$this->compareRating($b,$a);
            $equality_sort_type="ASC";
            if($result == 0) {
                if($equality_sort_type=="ASC") {
                    return $this->compareDate($a,$b);
                }
                return $this->compareDate($b,$a);
            }
            return $result;
        });
        return $flat_news_array;
    }

    public function compareRating($a,$b) {
        $first=$this->convertRatingToNumber($a['rating']);
        $second=$this->convertRatingToNumber($b['rating']);
        return $first - $second;
    }

    public function compareDate($a,$b) {
        if(Carbon::parse(($a['datetime']))->equalTo(Carbon::parse($b['datetime'])))
            return -1;
        return Carbon::parse(($a['datetime']))->greaterThan(Carbon::parse($b['datetime'])) == true ? true :false;
    }
}

