<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StringData;

class ImageData extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'image_id', 'category', 'teaser', 'sort_index', 'hotel_id'];

    public function StringData() {
    	return $this->belongsTo(StringData::class);
    }

    public function string() {
    	if($this->teaser == true) {
    		$teaser = "Teaser='true'";
    	} else {
    		$teaser = "";
    	}

    	$string = "
    		<Image ID='". $this->image_id ."' Category='". $this->category ."' ". $teaser ." SortIndex='". $this->sort_index ."'>
        		<URL>". $this->url ."</URL>
      		</Image>
    	";

        return $string;
    }
}
