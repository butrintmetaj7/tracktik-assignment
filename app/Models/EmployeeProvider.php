<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmployeeProvider extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'api_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employeeProvider) {
            $employeeProvider->api_token = Str::random(60);
        });
    }
}
