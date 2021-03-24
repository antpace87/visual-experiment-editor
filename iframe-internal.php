<?php 
// Report all errors
error_reporting(E_ALL);
ini_set("display_errors", 1);
require 'simple_html_dom.php';


class HtmlDomParser {
	
	/**
	 * @return \simplehtmldom_1_5\simple_html_dom
	 */
	static public function file_get_html() {
		return call_user_func_array ( '\simplehtmldom_1_5\file_get_html' , func_get_args() );
	}

	/**
	 * get html dom from string
	 * @return \simplehtmldom_1_5\simple_html_dom
	 */
	static public function str_get_html() {
		return call_user_func_array ( '\simplehtmldom_1_5\str_get_html' , func_get_args() );
	}
}

$base_url = $_GET['baseUrl'];
$url = $_GET['url'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$html = curl_exec($ch);
$redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
$url = $redirectedUrl;

$parse = parse_url($url);

$base_url = $parse["scheme"] . "://" . $parse["host"];

$html = @HtmlDomParser::file_get_html($url);

if(substr($base_url, 0, 1) == "/"){
    $base_url = substr_replace($base_url ,"",-1);
}

if($html === FALSE) { 
    echo "Sorry, we do not have permission to analyze that website. ";
    return;
}
foreach($html->find('script') as $element){
    $src = $element->src;
    // echo "<script>console.log('starting src: ".$src."')</script>";
    
    if (strlen($src) > 0 && strpos($src, '//') === false){
        if(substr($src, 0, 1) !== "/"){
            $src = "/" . $src;
        }
        $element->src = $base_url . $src;
    }
    if(strlen($element->integrity) > 0){
        $element->integrity = "";
    }
    // echo "<script>console.log('final src: ".$base_url . $src."')</script>";

    // echo $element->src . "\n";
} 
foreach($html->find('link') as $element){
    $src = $element->href;
    
    if (strlen($src) > 0 && strpos($src, '//') === false){
        if(substr($src, 0, 1) !== "/"){
            $src = "/" . $src;
        }
        $element->href = $base_url . $src;
    }
    if(strlen($element->integrity) > 0){
        $element->integrity = "";
    }
   
}
foreach($html->find('a') as $element){
    $src = $element->href;
    
    if (strlen($src) > 0 && strpos($src, '//') === false){
        if(substr($src, 0, 1) !== "/"){
            $src = "/" . $src;
        }
        $element->href = $base_url . $src;
    } 
  
}
foreach($html->find('img') as $element){
    $src = $element->src;
    if (strlen($src) > 0 && strpos($src, '//') === false){
        if(substr($src, 0, 1) !== "/"){
            $src = "/" . $src;
        }

        $element->src = $base_url . $src;
    } 
   
}
foreach($html->find('source') as $element){
    $src = $element->srcset;
    $sources = explode(",",$src);
    $src = trim($sources[0]);

    if (strlen($src) > 0 && strpos($src, '//') === false){
        if(substr($src, 0, 1) !== "/"){
            $src = "/" . $src;
        }

        $element->srcset = $base_url . $src;
    } 
}

echo $html;

?>
