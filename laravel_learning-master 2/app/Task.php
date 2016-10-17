<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['name'];


    /**
     * current task's user
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
