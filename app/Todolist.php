<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Multicaret\Acquaintances\Traits\CanBeSubscribed;

class Todolist extends Model
{
    use CanBeSubscribed;

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
