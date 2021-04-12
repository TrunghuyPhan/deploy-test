<?php

namespace App\Scraper;
use App\ProductCrawl;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Product;
use App\CategoryProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class menu
{

    public function scrape()
    {$url = 'https://thegioididong.com/dtdd';
        
        $client = new Client();

        $crawler = $client->request('GET', $url);  
        
        $crawler->filter('.vertion2020')->each(
         function (Crawler $node)
         {
            
           
            $brand  =  $node->filter('.spInfo')->attr('data-brand');
             

            $cate = new CategoryProduct;
            $cate->category_name = $brand;
            // $cate->product_price = $price;
            // $product->product_image = $screenshotSrc;
            
             $cate->save();
         }
        );
    }
}