<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'project_id',
        'status_code',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project');
    }
    
}