<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageData;
use App\Models\StringData;
use Illuminate\Support\Arr;

class ParserController extends Controller
{
    public function insert(Request $request) {
    	$rules = [
    		'file' => ['required', 'file', 'mimes:xml']
    	];
    	$request->validate($rules);

    	$xmlObject = simplexml_load_file($request->file('file'));
    	
    	$json = json_encode($xmlObject);
    	$decode = json_decode($json, true);
    	$array = $decode['@attributes'];
    	
    	$string1 = '
    		<?xml version="1.0" encoding="utf-8"?>
			<ContentRoot SchemaVersion="'. $array['SchemaVersion'] .'" CreationDate="'. $array['CreationDate'] .'" xmlns="http://www.peakwork.de/edf/content">
    	';
		$string2 = $xmlObject->BasicData->asXML();
		$string3 = $xmlObject->DescriptiveData->asXML(); 

		$stringData = StringData::create([
			'string1' => $string1,
			'string2' => $string2,
			'string3' => $string3
		]);

		foreach ($xmlObject->MultiMedia->Images->Image as $image) {
			$encode = json_encode($image);
			$decode2 = json_decode($encode, true);
			$imgArray = $decode2['@attributes'];

			if(!Arr::has($imgArray, 'Teaser') || $imgArray['Teaser'] === false) {
				$teaser = false;
			} else {
				$teaser = true;
			}

			ImageData::create([
				'url' => $image->URL,
				'image_id' => $imgArray['ID'],
				'category' => $imgArray['Category'],
				'teaser' => $teaser,
				'sort_index' => $imgArray['SortIndex'],
				'hotel_id' => $stringData->id
			]);
		}

		return redirect()->route('interface', $stringData->id);
    }

    public function interface($id) {
    	$imageData = ImageData::where('hotel_id', $id)->get();

    	return view('interface', compact('imageData'));
    }

    public function update(Request $request, $id) {
    	$i = 0;

    	foreach ($request->id as $imgId) {
    		$image = ImageData::where('hotel_id', $id)->where('image_id', $imgId)->first();
    		$image->update([
    			'category' => $request->category[$i]
    		]);
    		++$i;
    	}

    	return redirect()->route('generateCode', $id);
    }

    public function generateCode($id) {
    	$stringData = StringData::where('id', $id)->firstOrFail();
    	$imageData = ImageData::where('hotel_id', $id)->get();
    	$closeTag = '</ContentRoot>';

    	return view('code')->with([
    		'stringData' => $stringData,
    		'imageData' => $imageData,
    		'closeTag' => $closeTag
    	]);
    }
}
