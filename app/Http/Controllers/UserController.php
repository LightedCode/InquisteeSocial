<?php

namespace App\Http\Controllers;

use App\Repositories\Profiles\ProfilesRepository;
use App\Models\Media;
use App\Repositories\Status\StatusCommendRepository;
use Illuminate\Http\Request;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| User Controller
|--------------------------------------------------------------------------
|
| This controller handles all activities with the user and his profile
|
*/

class UserController extends Controller
{

    public function show(
        ProfilesRepository $profilesRepository,
        StatusCommendRepository $statusCommendRepository,
        $user
    ){
        $user=User::where('username',$user)->first();
        $userProfiles=$profilesRepository->getUserProfile($user);
        $statusCommend=$statusCommendRepository->getStatusAndCommendsUser($user);

        //collecting the users posts
        return view('users.index',[
            'profile'=>$userProfiles,
            'posts'=>[
                'Status'=>$statusCommend['Status'],
                'Commend'=>$statusCommend['Commends']
            ]
        ]);
    }


    //when user edits their profile view.
    public function edit(Request $request){
        //get the user id from the request and
        //check if the user to be edited is
        //currently authenticated

        //note if a user enter's a new profile pic
        //then we'll have to first insert the new
        //picture into the database and place it into
        //the the right folder in public.

        if(Auth::user()->id == $request->id){
            //perform the updating of the profile information
            $user=User::find($request->id);
            /*
            |----------------------------------------------
            | before we continue, what can user edit?
            |----------------------------------------------
            |
            | A user can edit the following.
            |  -Their user name
            |  -Their profile picture
            |  -Their description
            |  -Their firstname/lastname
            |  -their likes in any category
            |
            | hmm, I think that's all
            |
            */
            $profileUpdate=[];

            if(isset($request)){
                if(!empty($request->username)){
                    $user->username=$request->username;
                    $user->save;
                }

                if(!empty($request->file( 'profileimage'))){
                    $newUserProfileImagePath = $profileImagePath = App::make('ProcessImage')->execute($request->file('profileimage'), 'images/profileimages/', 180, 180);
                    $newProfilePic=new \Media(
                    [
                        'profiles_id'=>$user->profile->id,
                        'type'=>App::make('ProcessImage')->getExtension($request->file('profileimage')),
                        'url'=>$newUserProfileImagePath
                    ]);

                    $profileUpdate['profile_pic']=$newProfilePic->id;

                }

                if(!empty($request->about)){
                    $profileUpdate['about']=$request->about;
                }

                if(!empty($request->firstname)){
                    $profileUpdate['firstname']=$request->firstname;
                }

                if(!empty($request->lastname)){
                    $profileUpdate['lastname']=$request->lastname;
                }

                if(!empty($request->file('coverpic'))){
                    $newCoverPicImagePath = $profileImagePath = App::make('ProcessImage')->execute($request->file('coverpic'), 'images/coverpics/');
                    $newCoverPic=new \Media(
                    [
                        'profiles_id'=>$user->profile->id,
                        'type'=>App::make('ProcessImage')->getExtension($request->file('coverpic')),
                        'url'=>$newCoverPicImagePath
                    ]);

                    $newCoverPic->save;

                    $profileUpdate['cover_pic']=$newCoverPic->id;
                }


                $user->profile->save($profileUpdate);


            }

        }

    }

    public function follow(User $user){
        //create a following relationship between a the Auth user and another user_id
        $userMe=Auth::user();
        $userMe->leaders()->save($user);

        return response()->json(true);
    }

    public function unfollow(User $user){
        //destroying the relationship between Auth and his leader
        $userMe=Auth::user();
        $badLeader=$userMe->leader()->where('leader',$user->id);
        $badLeader->forceDelete();

        return response()->json(true);
    }

    public function interested(User $user){
        //create an interest relationship between a the Auth user and another user_id
        $userMe=Auth::user();
        $userMe->interestedIn()->save($user);

        return response()->json(true);
    }

    public function uninterested(){
        //destroying the relationship between Auth and his leader
        $userMe=Auth::user();
        $unResponsiveBoyOrGirl=$userMe->interestedIn()->where('subject',$user->id);
        $unResponsiveBoyOrGirl->forceDelete();

        return response()->json(true);
    }


}
