<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\UserRole;
use App\Models\CreateUserProfile;
use App\Http\Requests\LoginRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\ForgotPasswordOtps;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(User $user, UserRole $userRole, CreateUserProfile $userProfile,Roles $role, ForgotPasswordOtps $forgotPasswordOtp)
    {
        $this->user = $user;
        $this->userrole = $userRole;
        $this->userprofile = $userProfile;
        $this->forgotpasswordotp = $forgotPasswordOtp;
        $this->role = $role;
    }


     /** @OA\Post(
     * path="/admin-register",
     *   tags={"Register"},
     *   summary="Admin Registration",
     *   description="Returns the message and status",
     *   operationId="adminRegister",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      example="Admin",
     *                      type="string",
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      example="admin@mailinator.com",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      example="Admin1234",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="role",
     *                      example="2",
     *                      type="integer"
     *                      
     *                  )
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/


    public function adminRegister(LoginRequest $request)
    {
        $data = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $this->userrole->create([
            'user_id' =>  $data->id,
            'role_id' => $request->role
        ]);

        $adminRegistered =  $this->user->where('email', $request->email)->with('userRole')->first();
        
        $data = ([
            'status' => 'true',
            'message' => 'User Registered',
            'data' => $adminRegistered
        ]);
        return response()->json($data);
    }

    /** @OA\Post(
     * path="/register",
     *   tags={"Register"},
     *   summary="User Registration",
     *   description="Returns the message and status",
     *   operationId="userRegister",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      example="User",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      example="user@mailinator.com",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      example="User1234",
     *                      type="string"
     *                      
     *                  )
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/


    public function userRegister(LoginRequest $request)
    {
        $data = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $this->userrole->create([
            'user_id' =>  $data->id,
            'role_id' => 5
        ]);
        $userRegistered =  $this->user->where('email', $request->email)->with('userRole')->first();
        $value = $userRegistered->toArray();
        $data = ([
            'status' => 'true',
            'message' => 'User Registered',
            'data' => $value
        ]);
        return response()->json($data);
    }

    /** @OA\Post(
     * path="/login",
     *   tags={"Register"},
     *   summary="Login",
     *   description="Returns the message and status",
     *   operationId="userLogin",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      example="user@mailinator.com",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      example="User1234",
     *                      type="string"
     *                      
     *                  )
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/

    public function userLogin(Request $request)
    {
        
        $user = $this->user->where('email', $request->email)->where('password', $request->password)->count();
       
        if ($user == 1) {
            $data = ([
                'status' => 'true',
                'message' => 'successfully logged',
                'data' => $user

            ]);
        } else {
            $data = ([
                'status' => 'false',
                'message' => 'your email or password will be wrong'
            ]);
        }

        return response()->json($data);
    }

    /** @OA\Post(
     * path="/profile",
     *   tags={"Profile"},
     *   summary="Insert profile",
     *   description="Returns the message and status",
     *   operationId="profile",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      example="user@mailinator.com",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="gender",
     *                      example="male/female",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="phone_number",
     *                      example="9876543210",
     *                      type="integer"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="date_of_birth",
     *                      example="yyyy-mm-dd",
     *                      type="string"
     *                      
     *                  ),
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/

    public function profile(Request $request)
    {
        $getUserId = $this->user->where('email',$request->email)->first();
        if($getUserId == true){
        $userProfile = $this->userprofile->create([
            'user_id' =>  $getUserId->id,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number
        ]);
        $data = ([
            'status' => 'true',
            'message' => 'successfully logged',
            'data' => $userProfile

        ]);
    }else {
        $data = ([
            'status' => 'false',
            'message' => 'update your profile'
        ]);
    }
    return response()->json($data);
    }

    /** @OA\Post(
     * path="/profile-update",
     *   tags={"Profile"},
     *   summary="Update profile",
     *   description="Returns the message and status",
     *   operationId="profileUpdate",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      example="user@mailinator.com",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="gender",
     *                      example="male/female",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="phone_number",
     *                      example="9876543210",
     *                      type="integer"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="date_of_birth",
     *                      example="yyyy-mm-dd",
     *                      type="string"
     *                      
     *                  ),
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/

    public function profileUpdate(Request $request)
    {
        $getUserByEmail = $this->user->where('email',$request->email)->first();
            $userProfile = $this->userprofile->where('user_id',$getUserByEmail->id)->update([
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number
            ]);
        
        $data = ([
            'status' => 'true',
            'message' => 'profile updated',
            'data' => $userProfile

        ]);
        return response()->json($data);
    }

     /** @OA\Post(
     * path="/forgot-passwordchange",
     *   tags={"Password"},
     *   summary="To change password",
     *   description="Returns the message and status",
     *   operationId="changePassword",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      example="user@mailinator.com",
     *                      type="string"
     *                      
     *                  ),
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/


    public function changePassword(Request $request)
    {

        $user = $this->user->where('email', $request->email)->first();
        $randomNumber = random_int(100000, 999999);

        if ($user) {
            $this->forgotpasswordotp->create([
                'user_id' => $user->id,
                'otp' => $randomNumber,
                'status' => 0
            ]);
            $forgotPasswordChange = ([
                "status" => "true",
                "message" => "otp sent successfull",
                "data" => ""
            ]);
            $getDataOfLastStoredUserOtp = $this->forgotpasswordotp->where('user_id', $user->id)->latest()->first();
            $getOtp = $getDataOfLastStoredUserOtp->otp;
            Mail::to($request->email)->send(new ForgotPasswordMail($user, $getOtp));
        } else {
            $forgotPasswordChange = ([
                'status' => 'false',
                'message' => 'mail sent failed'
            ]);
        }
        return response()->json($forgotPasswordChange);
    }

    /** @OA\Post(
     * path="/verifyotp",
     *   tags={"Password"},
     *   summary="To verify otp",
     *   description="Returns the message and status",
     *   operationId="verifyOtp",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="otp",
     *                      example="xxxxxx",
     *                      type="integer"
     *                      
     *                  ),
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/


    public function verifyOtp(Request $request)
    {
        $getRecord =  $this->forgotpasswordotp->where('otp', $request->otp)->latest()->first();
        if ($getRecord == true) {

            $otpVerified = $this->forgotpasswordotp->where('otp', $request->otp)->update(['status' => '1']);

            $forgotPasswordChange = ([
                "status" => "true",
                "message" => "otp verified",
                "data" => ""
            ]);
        } else {
            $forgotPasswordChange = ([
                'status' => 'false',
                'message' => 'otp not matched'
            ]);
        }
        return response()->json($forgotPasswordChange);
    }

    /** @OA\Post(
     * path="/update-password",
     *   tags={"Password"},
     *   summary="Update new password",
     *   description="Returns the message and status",
     *   operationId="newPassword",
     *      @OA\RequestBody(
     *        @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      example="user@mailinator.com",
     *                      type="string"
     *                      
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      example="User1234",
     *                      type="string"   
     *                  ),
     *                  @OA\Property(
     *                      property="confirm_password",
     *                      example="User1234",
     *                      type="string"   
     *                  ),
     *              ),
     *          ),
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     *
     *
     **/

    public function newPassword(Request $request)
    {
        $getEmail = $this->user->where('email',$request->email)->first();
        $verifiedOtp = $this->forgotpasswordotp->where('user_id',$getEmail->id)->where('status',1)->first();
        if($verifiedOtp==true){
        
            if ($request->password == $request->confirm_password) {
                $user = $this->user->where('email',$request->email)->update(['password' => $request->password]);

                $forgotPasswordChange = ([
                    "status" => "true",
                    "message" => "Password updated",
                    "data" => ""
                ]);
            } else {
                $forgotPasswordChange = ([
                    'status' => 'false',
                    'message' => 'password not match'
                ]);
            }
        } else {
            $forgotPasswordChange = ([
                'status' => 'false',
                'message' => 'verify otp'
            ]);
        }
        return response()->json($forgotPasswordChange);
    }
}
