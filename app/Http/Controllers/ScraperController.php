<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

class ScraperController extends Controller
{
    //

    /**
     * Homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function scrape(Request $request)
    {  
        
        $url = $request->input('url');

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        // $output contains the output string
        $html = curl_exec($ch);

        // https://www.theiconic.com.au/comfort-stretch-high-rise-stove-pipe-jeans-916167.html
        // https://www.asos.com/au/asos-design/asos-design-utility-belted-jacket/prd/12482467?clr=white&colourWayId=16446523&SearchQuery=&cid=13504
        // https://www.wittner.com.au/edun-light-oyster-suede-leather-lace-up-sneaker-00.html
        // https://static.zara.net/photos///2019/I/0/2/p/5662/655/401/2/w/1920/5662655401_1_1_1.jpg?ts=1565349655111
        // https://www.zara.com/au/en/tuxedo-blazer-p05662655.html?v1=20903767&v2=1278745
        // https://www.countryroad.com.au/shop/woman/clothing/best-sellers/60242099-129/Darted-Culotte.html
        // https://www.nike.com/au/t/air-max-200-shoe-7HGW5r/AQ2568-101
        // https://c.static-nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/eybkwkfhup8oelqut1y0/air-max-200-shoe-7HGW5r.jpg
        // https://www.ninewest.com.au/p/tornaydo/906357-17-5-nw.html#start=1
        // https://www.adidas.com.au/tape-track-jacket/EC0743.html

        if(strpos($url, 'asos')) {
            $explode_url = explode("/", $url);
            $slug = $explode_url[5];
            $id = substr($explode_url[7], 0, 8);
            $thumbnails = array(
                'https://images.asos-media.com/products/' . $slug . '/' . $id . '-2?$XXL$&wid=330&fit=constrain',
                'https://images.asos-media.com/products/' . $slug . '/' . $id . '-3?$XXL$&wid=330&fit=constrain',
                'https://images.asos-media.com/products/' . $slug . '/' . $id . '-4?$XXL$&wid=330&fit=constrain');
            echo json_encode($thumbnails);
        } else {

            // $html = file_get_contents($url);

            // The Iconic - img1
            // Whittner - catalog

            $crawler = new Crawler($html);
            $result = $crawler->filterXpath('//img')
            ->extract(array('src'));
            $thumbnails = array();

            $check_string = NULL;

            switch($url) {
                case strpos($url, 'iconic') == true:
                    $check_string = 'img1';
                    break;
                case strpos($url, 'whittner') == true:
                    $check_string = '/image';
                    break;
                case strpos($url, 'nike') == true:
                     $check_string = '/images';
                    break;
                case strpos($url, 'zara') == true:
                    $check_string = 'photos';
                    break;
                case strpos($url, 'ninewest') == true:
                    $check_string = 'sw=568&sh=568';
                    break;
                default: 
                    $check_string = NULL;
            }

            foreach ($result as $image) {
                
                if($check_string !== NULL) {
                    if(strpos($image, $check_string) == true) {
                        array_push($thumbnails, $image);
                    }
                } else {
                    array_push($thumbnails, $image);
                }

                // if(strpos($image, $check_string)) {
                //     array_push($thumbnails, $image);
                // }
            }

        echo json_encode($thumbnails);

        }

        // close curl resource to free up system resources
        curl_close($ch); 
    

        //https://img1.theiconic.com.au/zvOmgvMBh9uC9pYHVD692eVmbqE=/634x811/filters:quality(95):fill(ffffff)/http%3A%2F%2Fstatic.theiconic.com.au%2Fp%2Ftommy-hilfiger-7714-634188-1.jpg
        //https://img1.theiconic.com.au/zvOmgvMBh9uC9pYHVD692eVmbqE=/634x811/filters:quality(95):fill(ffffff)/http%3A%2F%2Fstatic.theiconic.com.au%2Fp%2Ftommy-hilfiger-7714-634188-1.jpg


        
    }

    /**
     * Homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function scrapeContent(Request $request)
    {  
        
        $url = $request->input('url');

        // ASOS
        // product-colour class for colour
        // url slug for type (last word)

        
    }
    
}
