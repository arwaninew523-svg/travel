<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = ['name', 'type'];

    public function tourPackages()
    {
        return $this->belongsToMany(TourPackage::class, 'package_service');
    }
}
