<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 
    ];

    public function getUpdateUrlAttribute()
    {
        return route('notes.update', [$this->attributes['id']]);
    }    

    public function getDestroyUrlAttribute()
    {
    	return route('notes.destroy', [$this->attributes['id']]);
    }
}
