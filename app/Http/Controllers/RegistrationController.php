<?php

namespace App\Http\Controllers;

use App\Services\ProcessImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\Jobs\CreateUserJob;
use Carbon\Carbon;
use App\Models\Media;
use Auth;


/*
|--------------------------------------------------------------------------
| Registration Controller
|--------------------------------------------------------------------------
|
| Handles all operation associated with the Registration Routes
| the store method creates a new user, using a job to handle
| the registration, during the job registration, a mail
| to the user's mail in another job to confirm their
| user status.
|
| The RegistrationController has two methods index method and
| store method, store takes in new user and register's them
| index get the view of the application.
|
*/

class RegistrationController extends Controller
{
    public function index(){
        return view('registration.index');
    }

    public function store(RegisterUserRequest $request){

        if(Auth::check()){

        }

        //$newUserProfileImagePath = $profileImagePath = App::make('ProcessImage')->execute($request->file('profileimage'), 'images/profileimages/', 180, 180);
        $newUserBirthday =Carbon::createFromDate($request->year, $request->month, $request->day);
        //registering a new user

        /*
        $this->dispatch(new CreateUserJob($request->all() + [
                'birthday'=> $newUserBirthday,                //'profileImagePath'=> $newUserProfileImagePath,
            ]
        ));
         *
         */

        $user =new User([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        $user->save();

        $profile=new \App\Models\Profile(
            ['birthday'=>$newUserBirthday,
                'first_name'=>$request->firstname,
                'last_name'=>$request->lastname,
                'gender'=>$request->gender,
            ]
        );

        $user->profile()->save($profile);

        Auth::login($user);

        return redirect()->route('register-steps');


    }

    public function steps(){
        return view('registration.regsteps',['no_app'=>true]);
    }

    public function pic(Request $req){
        if($req->ajax()){
            $data=$req->image;



            $profileUrl=(new ProcessImage())->saveProfileAjax($data, 'images/profileimages/');

            $media=new Media([
                'type'=>'png',
                'url'=>$profileUrl
            ]);

            Auth::user()->profile->media()->save($media);

            if(Auth::user()->profile->profileMedia()->associate($media)){
                Auth::user()->profile->save();
                return Response::json(
                    ['message'=>"completed"]
                );
            }
            else {
                return Response::json(['message'=>'not uploaded']);
            }

        }


    }

    public function details(Request $req){
        $profile=Auth::user()-profile;
        if($profile){
            $profile->about=$req->about;

            return Response::json(
                ['message'=>'Profile Updated completed']
            );
        }else {
            return Response::json(
                ['message'=> 'Profile Couldn\'nt be updated']
            );
        }

    }
}
