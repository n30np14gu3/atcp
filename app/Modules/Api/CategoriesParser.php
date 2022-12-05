<?php

namespace App\Modules\Api;

use App\Models\PreparedCache;
use Illuminate\Support\Facades\DB;

trait CategoriesParser
{
    /**
     * Get all days in subcategories
     * @param array $subcategory
     * @return array
     */
    private function getDays(array $subcategory): array
    {
        $days = [];

        foreach($subcategory as $position){

            foreach($position as $date => $pos){
                if($pos !== null)
                    $days[$date] = @$days[$date] === null ? $pos : min($pos, @$days[$date]);
            }
        }

        return $days;
    }
    /**
     * parse response data and save in DB
     * @param array $data
     * @return array|null
     */
    protected function parseInfo(array $data): ?array
    {
        $insert_arr = [];
        $arr = [];

        if(count($data) === 0)
            return null;

        foreach($data as $category => $subcategory){

            $days = $this->getDays($subcategory);

            $minDate= min(array_keys($days, min($days)));
            $minPos = $days[$minDate];

            $arr[$category] = $minPos;

            $insert_arr[] = [
                'category_id' => $category,
                'cache_date' => $minDate,
                'position' => $minPos
            ];
        }
        PreparedCache::query()->insertOrIgnore($insert_arr);
        return  $arr;
    }

    public function prepareInfo(array $data)
    {
        if(count($data) === 0)
            return;

        $insert_arr = [];

        foreach($data as $category => $subcategory){

            $days = $this->getDays($subcategory);

            foreach($days as $day => $pos){
                $insert_arr[] = [
                    'category_id' => (string)$category,
                    'cache_date' => $day,
                    'position' => $pos
                ];
            }
        }

        PreparedCache::query()->insertOrIgnore($insert_arr);
    }
}
