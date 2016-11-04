<?php

namespace App\Repositories\User;

use App\Models\User;
use Auth;

class EloquentUserRepository implements UserRepository
{
    public function getPaginatedFollowers(User $id, $no){
        $followers=$id->followers()->paginate($no);
        return $followers;
    }

    public function getPaginatedLeadersid(User $id,$no)
    {
        $leaders=$id->leaders()->paginate($no);
        return $leaders;

    }
}
