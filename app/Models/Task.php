<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','description','priority'];

    public function parent() {
        return $this->belongsToOne(static::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function time_logs()
    {
        return $this->hasMany(TimeLog::class);
    }

}
