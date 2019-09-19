<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use Analytics;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use Validator;

class AnalyticsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetch(Request $request){
        // $startDate = Carbon::now()->subYear();
        // $endDate = Carbon::now();
        // $metrics = 'ga:sessions,ga:pageviews,ga:sessionDuration';
        $data = Analytics::fetchTotalVisitorsAndPageViews(Period::days(30));

        if($data){
            $success['total_visitors_page_views'] = Analytics::fetchTotalVisitorsAndPageViews(Period::days(30));
            $success['visitors_page_views'] = Analytics::fetchVisitorsAndPageViews(Period::days(30));
            $success['user_types'] = Analytics::fetchUserTypes(Period::days(30));
            $success['top_browsers'] = Analytics::fetchTopBrowsers(Period::days(30));
            $success['users_country'] = Analytics::performQuery(Period::days(30), 'ga:users', [
                'metrics' => 'ga:users',
                'dimensions' => 'ga:country'
            ]);
            $success['entrances'] = Analytics::performQuery(Period::days(30), 'ga:entrances');
            $success['avg_session_duration'] = Analytics::performQuery(Period::days(30), 'ga:avgSessionDuration');

            return $this->sendResponse($success, 'Analytics fetched data.');
        }

        return $this->sendError('Fetching data error.', [], 200);
    }
}
