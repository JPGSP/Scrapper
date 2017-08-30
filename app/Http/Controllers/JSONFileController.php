<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use File;

class JSONFileController extends Controller {

	public function downloadJSONFile($parameter_data){
		$data = json_encode($parameter_data);
	    $file = time() . '_file.json';
	    $destinationPath=public_path()."/json/";
	    
	    if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
	       File::put($destinationPath.$file,$data);
	    return response()->download($destinationPath.$file);
    }

}
