<?php

namespace App\Modules\Api;

use App\Models\PreparedCache;
use Illuminate\Support\Facades\DB;

trait CategoriesParser
{
    /**
     * parse response data and save in DB
     * @param array $data
     * @return array|null
     */
    protected function parseInfo(array $data)
    {
        $insert_arr = [];
        $arr = [];

        if(count($data) === 0)
            return null;

        foreach($data as $category => $subcategory){
            $minDate = null;
            $minPos = null;
            foreach($subcategory as $position){
                $md = min(array_keys($position, min($position)));
                $mp = $position[$md];

                if($mp === null)
                    continue;

                if($minDate === null || $minPos === null){
                    $minDate = $md;
                    $minPos = $mp;
                    continue;
                }

                if($md < $minPos){
                    $minDate = $md;
                    $minPos = $mp;
                }
            }

            $arr[$category] = $minPos;

            $insert_arr[] = [
                'category_id' => $category,
                'cache_date' => $minDate,
                'position' => $minPos
            ];
        }
        PreparedCache::query()->insert($insert_arr);
        return  $arr;
    }
}
