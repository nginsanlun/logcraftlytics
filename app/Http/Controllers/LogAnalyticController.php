<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LogAnalyticResource;
use App\Contracts\LogAnalyticModuleInterface;

class LogAnalyticController extends Controller
{
    public function __construct(
        protected LogAnalyticModuleInterface $logAnalytic,
        // protected LogAnalyticResource $logAnalyticResource
    ) {
    }

    public function index(Request $request)
    {
        $count = $request->input('count', 5);
        $list = $this->logAnalytic->showLogAnalyticList($count);

        if($list->count() <= 0) {
            return response()->json(
                [
                    'message' => 'LogAnalytic not found'
                ],
                404
            );
        }

        return response()->json(
            [
                'data' => (new LogAnalyticResource($list))->LogCollectionTransform()
            ],
            200
        );
    }
    public function getLogAnalyticByFilter(Request $request)
    {   
        $validator = Validator::make(
            $request->all(),
            [
                'created_at' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors()->get('created_at')
                ],
                422
            );
        }

        $date = $request->input('created_at'); 
        $routeId = $request->input('route_id', '');
        $methodId = $request->input('method_id', '');
        $statusId = $request->input('status_id', '');
        $logAnalytic = $this->logAnalytic->getLogAnalyticByFilter($date, $routeId, $methodId, $statusId);
        // $log = $this->logAnalyticResource($logAnalytic)->logCollectionTransform();

        if (!$logAnalytic) {
            return response()->json(
                [
                    'message' => 'LogAnalytic not Found'
                ],
                404
            );
        }

        return response()->json(
            [
                'data' => (new LogAnalyticResource($logAnalytic))->LogCollectionTransform()
            ],
            200
        );
    }

    public function show($id)
    {
        $list = $this->logAnalytic->findLogAnalyticById($id);

        if (!$list) {
            return response()->json(
                [
                    'message' => 'LogAnalytic not found'
                ],
                404
            );
        }

        return response()->json(
            [
                'data' => (new LogAnalyticResource($list))->LogCollectionTransform()
            ],
            200
        );
    }
}
