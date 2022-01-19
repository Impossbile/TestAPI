<?php

namespace App\Models;

use App\Http\Resources\DeskListResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = ['name','email'];
    public function desklist(){


        return $this->belongsTo(DeskList::class);
    }
}
