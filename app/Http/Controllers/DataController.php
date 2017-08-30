<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JSONFileController;

use Illuminate\Http\Request;
use Goutte\Client;

class DataController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$final_array_result = array();
		$final_size = 0;

		//Starting to  scrape
        $client = new Client();
        //Not checking SSL -> Because of an SSL error when it was connected.
	    $guzzleClient = new \GuzzleHttp\Client(['timeout' => 90,'verify' => false]);
		$client->setClient($guzzleClient);
		//Connect to the website
        $crawler = $client->request('GET', "https://www.black-ink.org/");
        //Going post by post thanks to $node
        $final_array_result['results'] = $crawler->filter('.post')->each(function ($node) 
        {
        	//We filter all the nodes or post if the category contains Digitalia
        	if (strpos($node->filter('.category')->text(), 'Digitalia') !== false){
        		//Storage the information from the post
        		$link      = $node->filter('.entry-summary > ul > li > a')->attr('href') . "<br/>";
        		$text_link = $node->filter('.entry-summary')->text(). "<br/>";
        		$m_description = "";
        		$k_words = "";
        		$f_size = 0;
        		
        		//New scrape link of the post to get the meta-description, keywords and filesize
        		$nuevo_client = new Client();
		        $meta_result = $nuevo_client->request('GET', $link);

			    foreach ($nuevo_client->getResponse()->getHeaders() as $key=>$value){
			    	if ($key=="Content-Length"){
			    		//$f_size = $value[0] /1000 . "KB";
			    		$f_size = intval($value[0]);
			    	}
			    }

				try {
				     $m_description = $meta_result->filter('meta[name=description]')->first()->attr('content');
				     $k_words = $meta_result->filter('#keywords')->text();
				     										  
				} 
				catch (\InvalidArgumentException $e) {
				     // Handle the current node list is empty..
				}
        	}

        	//We put all the information in the format asked to return it
        	$information_one_post = array(
			                		     "url"  => $link,
									     "link" => $text_link,
									     "meta description" => $m_description,
									     "keywords" => $k_words,
									     "filesize" => $f_size,
		            			    	 );

            return $information_one_post;
        });

        //Once we have the information abbout all the post we to know the total size
        //and change the format to be the one required.
        for ($i=0; $i<count($final_array_result['results']);$i++)
        {
        	foreach ($final_array_result['results'][$i] as $k_to_print => $v_to_print)
        	{
        		if ($k_to_print=="filesize"){
        			$final_size +=$v_to_print;
        			$v_temp = $v_to_print;
        			$final_array_result['results'][$i]["filesize"] = $v_temp/1000 . "KB";
        		}
        	}
	    }

	    $final_array_result['total'] = $final_size / 1000 . "KB";

	    $json = new JSONFileController();
	    $json->downloadJSONFile($final_array_result);

		return view('data')->with('result', $final_array_result); 
	}

}
