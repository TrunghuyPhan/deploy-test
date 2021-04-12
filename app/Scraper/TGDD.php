<?php

namespace App\Scraper;
use App\ProductCrawl;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class TGDD
{

    public function scrape()
    {
        $html="";
        $i=1;
        do{
           
            $url = 'https://cellphones.com.vn/tablet.html'.$html;
        
        $client = new Client();

        $crawler = $client->request('GET', $url);  
        
        $crawler->filter('ul.cols li.cate-pro-short')->each
        (
            function (Crawler $node)
             {
                //lay ten
                 $name = $node->filter('h3#product_link')->text();
                //lay slug
                 $bien = $node->filter('.lt-product-group-info a')->attr('href');
                $r = rtrim($bien,'.html');
                $slug = ltrim($r,'https://cellphones.com.vn/');
                //lay gia
                $price = $node->filter('.price-box span')->text();
                
                $price = preg_replace('/\D/', '', $price);
                //hinh
                $screenshotSrc  = $node->filter('#product_link')->attr('data-src');
                $product = new Product;
                $product->product_name = $name;
                $product->product_price = $price;
                $product->product_image = $screenshotSrc;
                $product->product_slug = $slug;
               
                //desc
                
                $url1 = $bien;
                $client = new Client();
                $crawler = $client->request('GET', $url1);  
                $crawler->filter('.blog-content')->each
                (function (Crawler $node)
                {   
                    $desc = $node->filter('p')->text();
                    session()->put("desc", $desc); 
    
               
                }
               
             );
             $product->product_desc = Session::get('desc');;
             $product->save();
             }
            
            // function (Crawler $node)
            //  {
            //     $name = $node->filter('h3')->text();

            //     $price = $node->filter('.price strong')->text();

            //     $wholeStar = $node->filter('.icontgdd-ystar')->count();
            //     $halfStar = $node->filter('.icontgdd-hstar')->count();
               
            //     $price = preg_replace('/\D/', '', $price);

            //     // $category  =  var_dump($node->filter('input')->attr('data-brand'));
            //      $screenshotSrc  = $node->filter('img')->attr('src');

            //     $product = new Product;
            //     $product->product_name = $name;
            //     $product->product_price = $price;
            //     $product->product_image = $screenshotSrc;
                
            //     $product->save();
            //  }
        );
        $i++;
        $html ='?p='.$i;
    }while($i<3);
    }
}