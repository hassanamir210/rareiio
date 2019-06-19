<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


//// JWT ////
use JWTAuthException;
use JWTAuth;

//// Models ////
use App\Models\User;
use App\Models\Applicant;

class AdminController extends Controller
{
    public function listApplicants(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $response = [
                'data' => [
                    'code'      => 400,
                    'message'   => 'Invalid Token! User Not Found.',
                ],
                'status' => false
            ];
        if(!empty($user) && $user->isAdmin())
        {
            try 
            {
                $applicants = Applicant::all();

                $response['data']['message']    = 'Request Successfull';
                $response['data']['code']       = 200;
                $response['data']['result']     = $applicants;
                $response['status']             = true;
            }
            catch (\Exception $e) 
            {
                $response['data']['message']    = 'Something went wrong. Please try again later!';
            }
        }
        return $response;
    }

}
