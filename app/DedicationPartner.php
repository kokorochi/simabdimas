<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DedicationPartner extends Model
{
    protected $fillable = [
        'id',
        'item',
        'name',
        'territory',
        'city',
        'province',
        'distance',
    ];

    public $timestamps = false;

    public function propose()
    {
        return $this->belongsTo(Propose::class);
    }
}
