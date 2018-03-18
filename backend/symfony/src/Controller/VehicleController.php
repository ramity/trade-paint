<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//scraping deps
use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;

class VehicleController extends Controller
{
    /**
     * @Route("/vehicle", name="vehicle_index")
     */
    public function index()
    {
        return $this->render('vehicle/index.html.twig', [

        ]);
    }

    /**
     * @Route("/vehicle/scrape", name="vehicle_scrape")
     */
    public function scrape()
    {
        $client = new Client();

        //get auto list results
        $maxPrice   = 10000;
        $radius     = 100;
        $city       = "Fayetteville";
        $state      = "AR";
        $bodyStyle  = [];

        //(empty = all)
        //convertible
        //coupe
        //crossover
        //hatchback
        //minivan
        //passenger_cargo_van
        //sedan
        //suv
        //truck
        //wagon

        $bodyStyle[] = "truck";

        //create the location from the given params
        $location   = "$state, $city";
        $location   = str_replace($location, " ", "+");
        $location   = urlencode($location);

        //generate the getString
        $getString  = "radius=$radius&";
        $getString .= "price_max=$maxPrice&";
        $getString .= "location=$location&";

        //add bodyStyle options
        foreach($bodyStyle as $bodyStyleItem)
        {
            $getString .= urlencode("body_style[]") . "=$bodyStyleItem&";
        }

        //remove the last ampersand
        $getString = substr($getString, 0, -1);

        //get url
        $crawler = $client->request("GET", "https://www.autolist.com/listings#$getString");

        var_dump($crawler->html());
        die();

        //get the number of pages
        $pages = $crawler->filter("div#pagination > li")->eq(6)->text();

        echo $pages;
        die();

        return $this->render('vehicle/scrape.html.twig', [

        ]);
    }
}
