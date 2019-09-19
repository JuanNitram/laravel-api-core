<?php


namespace App\Http\Controllers\Api\Admin\Base;

use App\Http\Controllers\Controller;
use App\Services\Base\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Junity\Hashids\Facades\Hashids;
use Facades\{ App\Facades\Media as MediaManager };
use App\Models\Media;

use MediaUploader;
use Validator;


class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
