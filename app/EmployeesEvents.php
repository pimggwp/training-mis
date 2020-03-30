<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeesEvents extends Model
{

    protected $fillable = [
        'employee_id', 'event_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

}
