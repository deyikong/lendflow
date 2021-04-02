<?php

namespace Tests\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait ActingJWTUser
{
    protected $user;
    public function loggedIn(User $user = null)
    {
        $token = "";
        if ($user) {
            $token = Auth::guard('api')->fromUser($user);
        } else if (!$this->user) {
            $this->user = User::find(1);
            $token = Auth::guard('api')->fromUser($this->user);
        } else {
            $token = Auth::guard('api')->fromUser($this->user);
        }

        $this->withHeaders(['Authorization' => 'Bearer '.$token]);

        return $this;
    }
}
