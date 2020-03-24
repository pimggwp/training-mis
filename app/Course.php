<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code', 'group_id', 'name', 'instructor',
    ];

    public function Course_group()
    {
        return $this->belongsTo(courseGroup::class, 'group_id');
    }
}
