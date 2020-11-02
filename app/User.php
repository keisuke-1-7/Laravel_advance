<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [  //create()でレコード作成する時にここで指定している項目が登録できる
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [  //作成した時に隠しておきたい項目をここに記載しておくことで、表示されなくすることができる
        'password', 'remember_token',
    ];
    
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
