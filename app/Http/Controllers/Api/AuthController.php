<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

//// JWT ////
use JWTAuthException;
use JWTAuth;

//// Models ////
use App\Models\Roles;
use App\Models\User;
use App\Models\Applicant;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // inializing a default response in case of something goes wrong.
        $response = [
                'data' => [
                    'code' => 400,
                    'message' => 'Invalid credentials or missing parameters',
                ],
                'status' => false
            ];

        // checking if parameters are set or not
        if(isset($request['email'],$request['password']))
        {

            // authenticate token from username and passwrod
            $credentials = $request->only('email', 'password');
            $token = null;
            try {
               if (!$token = JWTAuth::attempt($credentials)) 
               {
                    return [
                        'data' => [
                            'code' => 400,
                            'message' => 'Email or password wrong.',
                        ],
                        'status' => false
                    ];
               }
            } catch (JWTAuthException $e) {
                return [
                        'data' => [
                            'code' => 500,
                            'message' => 'Fail to create token.',
                        ],
                        'status' => false
                    ];
            }
            // Finding User from token.
            $user = JWTAuth::toUser($token);
            // Checking if user is valid or not.

            if(!empty($user))
            {
                if($user->isAdmin())
                {  
                    $response['data']['code']               = 200;  
                    $response['data']['message']            = "Request Successfull!!";
                    $response['data']['token']              = User::loginUser($user->id,$token);
                    $response['data']['result']['userData'] = $user->getArrayResponse();
                    $response['status']                     = true;    
                }
                else
                {
                    $response['data']['message'] = 'Applicants are not allowed to login for now';
                }
            }
            else
            {   
                // Eesponse if user is not valid.
                $response['data']['message'] = 'Not a valid user';
            }
        }
        return $response;
    }


    public function applicantSignup(Request $request)
    {
        $response = [
            'data' => [
                'code' => 400,
                'message' => 'Something went wrong. Please try again later!',
            ],
           'status' => false
        ];
        $rules = [
            'name'          => ['required'],
            'email'         => ['required'],
            'phoneNumber'   => ['required'],
            'dob'           => ['required'],
            'password'      => ['required'],
            'coverLetter'   => ['required'],
            'cv'            => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            $response['data']['message'] = 'Invalid input values.';
            $response['data']['errors'] = $validator->messages();
        }else
        {
            $name           = $request->name;
            $email          = $request->email;
            $phoneNumber    = $request->phoneNumber;
            $dob            = $request->dob;
            $password       = $request->password;
            $coverLetter    = $request->coverLetter;
            $cv             = $request->cv;

            $checkEmail     = User::where('email',$email)->first();
            if(!empty($checkEmail))
            {
                $response['data']['message']    = 'Email already taken!';
                return $response;
            }

            DB::beginTransaction();
            // try 
            {
                $file_data          = $coverLetter;
                $randName           = "CoverLetter_".time();
                $coverLetterPath    = uploadFile($file_data,$randName);

                $file_data  = $cv;
                $randName   = "CV".time();
                $cvPath     = uploadFile($file_data,$randName);

                if($coverLetterPath=="Some Error" || $cvPath=="Some Error" )
                {
                    // Here we can also delete file if any single is uploaded.
                    $response['data']['message']    = 'Error occured in uploading your files. Please try again later.';
                }
                else
                {
                    $roleId = Roles::findByAttr('label',User::USER_APPLICANT)->id;
                    
                    // First Enter Data in users Table
                    $user = User::create([
                        'email'     => $email,
                        'password'  => bcrypt($password),
                        'roleId'    => $roleId,
                    ]);

                    

                    $applicant = Applicant::create([
                        'name'              => $name,
                        'phoneNumber'       => $phoneNumber,
                        'dob'               => $dob,
                        'coverLetterPath'   => $coverLetterPath,
                        'cvPath'            => $cvPath,
                        'userId'            => $user->id,
                    ]);

                    DB::commit();
                    $response['data']['message']    = 'Request Successfull';
                    $response['data']['code']       = 200;
                    $response['status']             = true;
                }
            }
            // catch (\Exception $e) 
            {
               DB::rollBack();
            }
        }
        return $response;
    }

    

    public function logout(Request $request)
    {

        // validation user from token.
        $user = JWTAuth::toUser($request->token);
        $response = [
                'data' => [
                    'code' => 400,
                    'message' => 'Invalid Token! User Not Found.',
                ],
                'status' => false
            ];
        if(!empty($user))
        {
            // if user is valid then expire its token.
            JWTAuth::invalidate($request->token);

            $response['data']['message'] = 'Logout successfully.';
            $response['data']['code'] = 200;
            $response['status'] = true;
        }
        return $response;
    }
}
