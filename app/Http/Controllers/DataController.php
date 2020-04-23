<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Models\CompanyData; 
use Illuminate\Http\Request;
use DB;

class DataController extends Controller
{
    
    public function index(){

    	return view('home');
    }

	public function fetchData(Request $request){

		$client = new Client();

			$url = $request['url'];

			// $inputDomain = substr( $url,-4,strpos($url, "com") );

			$inputDomain = $this->get_domain($url);

			if ($inputDomain !=  \Config::get('constants.domain')) {

				echo "string";
				return redirect('/')->with('message', 'Failed ! Domain not allowed. Please change domain from backend');
			 	
			 } 
			// print_r($inputDomain);exit();
 			// $url = 'http://www.mycorpateinfo.com/business/tumus-electric-corporation-limited-1-1';
			
			// create a crawler object from this link
			$crawler = $client->request('GET', $url);
			
			$tableData = $crawler->filterXPath('//tbody')->filter('tr')->each(function ($tr, $i) {

			   	return $tr->filter('td')->each(function ($td, $i) {
			   		return trim($td->text()); 
				}); 
			});

			$setData = $this->setDataForInsert($tableData);

			$companyDataInsert = DB::table('companyData')->insert($setData);
		return redirect('/')->with('message', 'Succesfully inserted');
	}

	public function setDataForInsert($dataArr){

			foreach ($dataArr as $data) {
	
			  foreach ($data as  $data[0]) {
					// echo "<pre>"; print_r($dt[0]);
				
				if ($data[0] == \Config::get('constants.cin')) {
					$insertData['cin']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.name')){
					$insertData['name']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.status')){
					$insertData['status']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.age')){
					$age = substr($data[1],-10);
					$date = date('Y-m-d');
					$age = date('Y-m-d',strtotime($age));
					$age = $date-$age;
					$insertData['age']= $age;
				}
				elseif($data[0] == \Config::get('constants.regno')){
					$insertData['regno']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.category')){
					$c = substr( $data[1],0,strpos($data[1], "See") );
					$insertData['category']= $c;
				}
				elseif($data[0] == \Config::get('constants.subcategory')){
					$subc = substr( $data[1],0,strpos($data[1], "See") );
					$insertData['subcategory']= $subc;
				}
				elseif($data[0] == \Config::get('constants.class')){
					$class = substr( $data[1],0,strpos($data[1], "See") );
					$insertData['class']= $class;
				}
				elseif($data[0] == \Config::get('constants.roccode')){
					$roccode = substr( $data[1],0,strpos($data[1], "See") );
					$insertData['roccode']= $roccode;
				}
				elseif($data[0] == \Config::get('constants.noofmembers')){
					$insertData['noofmembers']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.email')){
					$insertData['email']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.regoffice')){
					$insertData['regoffice']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.islisted')){
					$list = substr( $data[1],0,strpos($data[1], "See") );
					$insertData['islisted']= $list;
				}
				elseif($data[0] == \Config::get('constants.dateOfagm')){
					$insertData['dateOfagm']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.dateBalanceSheet')){
					$insertData['dateBalanceSheet']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.state')){
					$insertData['state']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.district')){
					$insertData['district']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.city')){
					$insertData['city']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.pin')){
					$insertData['pin']= $data[1];
				}
				elseif($data[0] == \Config::get('constants.section')){
					$sect = substr( $data[1],0,strpos($data[1], "See other") );
					$insertData['section']= $sect;
				}
				elseif($data[0] == \Config::get('constants.division')){
					$div = substr( $data[1],0,strpos($data[1], "See other") );
					$insertData['division']= $div;
				}
				elseif($data[0] == \Config::get('constants.maingroup')){
					$maing = substr( $data[1],0,strpos($data[1], "See other") );
					$insertData['maingroup']= $maing;
				}
				elseif($data[0] == \Config::get('constants.mainclass')){
					$insertData['mainclass']= $data[1];
				}
			  }
			}
			// echo "<pre>"; print_r($insertData);exit();

		return $insertData;

	}

	function get_domain($url)
		{
			// print_r($url);exit();
		  $pieces = parse_url($url);
		  $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
		  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
		    return $regs['domain'];
		  }
		  return false;
		}
    
}
 
