<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class libro extends Model
{
    use HasFactory;
    protected $table = 'libro';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'autor',
        'numpag',
        'portada'
    ];
    protected $guarded = [];
}
