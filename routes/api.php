<?php

use App\Http\Controllers\TopInfoController;
use App\Modules\Api\EndpointInfoGetter;
use Illuminate\Support\Facades\Route;

class X{
    use \App\Modules\Api\CategoriesParser;
    public function x(array $data){
        $this->prepareInfo($data);
    }
}
Route::get('appTopCategory', [TopInfoController::class, 'appTopCategory']);
Route::get('test', function (){
    $endTime = now();
    $startTime = $endTime->copy()->subMonth();

    $monthData = new EndpointInfoGetter();
    $monthData = $monthData->getInfo($startTime->format('Y-m-d'), $endTime->format('Y-m-d'));
    $x = new X($monthData);
    $x->x($monthData);
});
