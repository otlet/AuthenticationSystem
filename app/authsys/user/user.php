<?php
/**
 * Author: PanOtlet
 */

namespace authsys\user;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent{

    protected $table = 'users';
    protected $fillable = [
        'email',
        'username',
        'password',
        'active',
        'active_hash',
        'remember_identifier',
        'remember_token',
    ];

    public function getFullName(){
        if (!$this->first_name || !$this->last_name){
            return "{$this->username}";
        }

        return "{$this->first_name} {$this->last_name}";
    }

    public function activateAccount(){
        $this->update([
            'active'        =>  true,
            'active_hash'   =>  null
        ]);
    }

    public function getAvatarUrl($option = []){
        $size = isset($option['size'])? $option['size']: 45;
        return "http://www.gravatar.com/avatar/".md5($this->email).'?s='.$size.'&d=retro';
    }
}