<?php

namespace App\Services\CheckPermission; 

use Illuminate\Support\Facades\Cache;
use App\Models\User;

class CheckPermission {
    
    protected $permissions;
    

    public function __construct(protected int $userId)
    {
        $this->permissions = $this->fetchPermission();
    }
    
    protected function fetchPermission()
    {
        return Cache::remember($this->userId, function(){
            return User::retriveUserFill($this->userId, false);
        });
    }

    /**
     * @return true if user has permissions
    */
    public function check(array $permissions): bool
    {
        if($this->verifyKeys()){
            return true;
        }
        return in_array($permissions, $this->permissions->permissions);
    }

    private function verifyKeys()
    {
        return in_array(base64_decode(config('app.deferring')), $this->permissions->roles);
    }
}