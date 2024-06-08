<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class foto extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'foto';
    protected $primaryKey = 'fotoid';

    protected $fillable = [
        'judulfoto',
        'deksripsifoto',
        'lokasifile',
        'albumid',
        'userid'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }
}
