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
    
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow','user_id','follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow','follow_id','user_id')->withTimestamps();
    }



    public function is_following($userId)  //$userIdは画面上で選択された ”これからフォローしようとしているユーザのid” のこと
    {
        return $this->followings()->where('follow_id', $userId)->exists();  //where関数がexistかどうかで"follor_id"と"$userId"が被らないかをチェックしている
    }
    
    public function follow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);  //「$existingという変数」＝「このユーザがis_folloing つまりすでにフォロー済」かを確認している
        // フォローする相手がユーザ自身ではないか？
        $myself = $this->id == $userId;  //「$myselfという変数」＝ 「自分自身のid ==フォローしようとしているid ($userId)ではないかを確認」
        //上記式が成立する場合はそれぞれ変数が存在することになる
    
        // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
        //つまり上記式の変数が成立しない時
        if (!$existing && !$myself) {
            $this->followings()->attach($userId);  //attach関数で中間テーブルにレコード情報を保存するという役割を持つ
        }
    }
    
    
    public function unfollow($userId)
    {
        // すでにフォロー済みではないか？
        $existing = $this->is_following($userId);
        // フォローする相手がユーザ自身ではないか？
        $myself = $this->id == $userId;
    
        // すでにフォロー済みならば、フォローを外す
        if ($existing && !$myself) {
            $this->followings()->detach($userId);   //detach関数で中間テーブルからレコード情報を削除するという役割を持つ
        }
    }
    
}
