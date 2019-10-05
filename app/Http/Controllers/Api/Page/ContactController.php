<?php

namespace App\Http\Controllers\Api\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;
use Validator;

use App\Http\Controllers\Api\Page\Base\BaseController as BaseController;

class ContactController extends BaseController
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            // 'asunto' => 'required',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        Mail::to('info@sideraldev.com')->send(new ContactForm($request->all()));

        return $this->sendResponse([], 'Mail sended successfully.');
    }
}
