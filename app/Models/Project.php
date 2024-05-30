<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 
        'description', 
        'start_date', 
        'end_date'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function teamMembers()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
