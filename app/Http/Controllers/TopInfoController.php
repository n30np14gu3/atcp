<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTopRequest;
use App\Models\PreparedCache;
use App\Modules\Api\CategoriesParser;
use App\Modules\Api\EndpointInfoGetter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TopInfoController extends Controller
{
    use CategoriesParser;

    public function appTopCategory(GetTopRequest $request){

        //Read from cache
        $preparedInfo = PreparedCache::query()->where('cache_date', $request->get('date'))->pluck('position', 'category_id');

        //Request to API
        if($preparedInfo->count() === 0){

            $getter = new EndpointInfoGetter();
            $endPointInfo = $getter->getInfo($request->get('date'), $request->get('date'));
            $preparedInfo  = $this->parseInfo($endPointInfo);
        }

        $this->response['status'] = 'OK';
        $this->response['data'] = $preparedInfo;
        return $this->response;
    }
}
