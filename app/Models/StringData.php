<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImageData;

class StringData extends Model
{
    use HasFactory;

    protected $fillable = ['string1', 'string2', 'string3'];

    public function ImageData() {
    	return $this->hasMany(ImageData::class);
    }
}
