<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use App\Exceptions\ErrorProc;

class ScrapeController extends Controller
{
// сделать условие, чтобы при пустом поиске получать: "Введите название"

public function submit(Request $request) {
if($request->input('Search')=='') {
  return view('homepage');
}
$counter=0;
$states = [];
$bigstates=[];
$data=[];
$data_price=[];
$client = new Client();
// STEAM PARSE
try{

$crawler = $client->request('GET', 'https://store.steampowered.com/search');
$form = $crawler->selectButton('Search')->form();
$crawler = $client->submit($form,['term'=>$request->input('Search')]);
$data=$crawler->
filter('#search_result_container a div[class="responsive_search_name_combined"] div[class="col search_name ellipsis"]')->text();
array_push($states,$data);
$data_price=$crawler->
filter('#search_result_container a div[class="responsive_search_name_combined"] div[class="col search_price_discount_combined responsive_secondrow"]')->text();
array_push($states,$data_price);
$link_steam=$crawler->filter('#search_result_container a')->link();
array_push($states,$link_steam->getUri());
array_push($bigstates,$states);
} catch (\Exception $e) {
  $counter+=1;
  echo "<font color='red'>Игра в каталоге STEAM не найдена<br/></font>";
  view('homepage');
}
//ZAKA-ZAKA PARSE
try {

$value=0.0136;
$states=array();
$crawler = $client->request('GET', 'https://zaka-zaka.com/search');
$form = $crawler->selectButton('')->form();
$crawler = $client->submit($form,['ask'=>$request->input('Search')]);
$data=$crawler->
filter('.search-result a[class="game-block"] div[class="game-block-name"]')->text();
array_push($states,$data);
$data_price=$crawler->
filter('.search-result a[class="game-block"] div[class="game-block-prices"] div[class="game-block-price"]')->text();
$data_price=substr($data_price,0,-1);
$data_price=intval($data_price);
$data_price=$data_price * $value;
array_push($states,"$".$data_price);
$link_steam=$crawler->filter('.search-result a')->link();
array_push($states,$link_steam->getUri());
array_push($bigstates,$states);
} catch (\Exception $e) {
  $counter+=1;
  echo "<font color='red'>Игра в каталоге zaka-zaka не найдена<br/></font>";
  view('homepage');
}
//GAMEONLINE
try {

$value=0.4;
$states=array();
$crawler = $client->request('GET', 'https://game-online.by/find/?findtext='.$request->input('Search').'&price_before_new=&price_after_new=&price_before=&price_after=');
$data=$crawler->
filter('.ok-product__title a')->text();
array_push($states,$data);
$data_price=$crawler->
filter('.ok-product__price-block span[class="ok-product__price-new"]')->text();
$data_price=intval($data_price);
$data_price=$data_price * $value;
array_push($states,"$".$data_price);
$link_steam=$crawler->filter('.ok-product__title a')->link();
array_push($states,$link_steam->getUri());
array_push($bigstates,$states);
 } catch (\Exception $e) {
   $counter+=1;
  echo "<font color='red'>Игра в каталоге game-online не найдена<br/></font>";
  view('homepage');
}
//GABESTORE
try {

$value =0.0136;
$states=array();
$game=$request->input('Search');
$game=str_replace(" ","+",$game);
$crawler = $client->request('GET', 'https://gabestore.ru/result?ProductFilter%5Bsearch%5D='.$game);
$data=$crawler->
filter('.shop-item a[class="shop-item__name"]')->text();
array_push($states,$data);
$data_price=$crawler->
filter('.shop-item__price div[class="shop-item__price-current"]')->text();
$data_price=substr($data_price,0,-2);
$data_price=intval($data_price);
$data_price=$data_price * $value;
array_push($states,"$".$data_price);
$link_steam=$crawler->filter('.shop-item a')->link();
array_push($states,$link_steam->getUri());
array_push($bigstates,$states);
} catch (\Exception $e) {
  $counter+=1;
  echo "<font color='red'>Игра в каталоге GabeStore не найдена<br/></font>";
  view('homepage');
}
//Igro-Shop
try {

$value =0.0136;
$states=array();
$crawler = $client->request('GET', 'https://www.igroshop.com');
$form = $crawler->selectButton('')->form();
$crawler = $client->submit($form,['q'=>$request->input('Search')]);
$data=$crawler->
filter('.product-title-wrap a')->text();
array_push($states,$data);
$data_price=$crawler->
filter('.price')->text();
$data_price=substr($data_price,0,-1);
$data_price=intval($data_price);
$data_price=$data_price * $value;
array_push($states,"$".$data_price);
$link_steam=$crawler->filter('.product-title-wrap a')->link();
array_push($states,$link_steam->getUri());
array_push($bigstates,$states);
} catch (\Exception $e) {
  $counter+=1;
  echo "<font color='red'>Игра в каталоге Igro-Shop не найдена<br/></font>";
}

//div[class="row l-child-col-indent"] div[class="col-md-4 col-sm-4"] div[class="ok-product  "] div[class="ok-product__main "] div[class="ok-product__section"]


// $form = $crawler->selectButton('.btn btn--primary')->form();
// $crawler = $client->submit($form->form(),['search'=>$request->input('Search')]);

// $crawler = $client->submit($form,['search'=>$request->input('Search')]);
if($counter==5){
    return view('homepage');
}
else return view('home',['data'=>$bigstates]);
//---------
  }
}
