<?php
/*
 * Abraham Williams (abraham@abrah.am) http://abrah.am
 *
 * The first PHP Library to support OAuth for Twitter's REST API.
 */
defined('BASEPATH') OR exit('No direct script access allowed');


include 'SpellCorrector.php';

class Pencarian
{	
	public $CI;
	public $error;
	public $stem;
	public $perbaiki = 0;
	
	public function __construct()
	{
		$this->CI = get_instance();
		$this->CI->load->model('cari_model');
		$this->stem = $this->CI->load->library("stem");
		$this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}
	
	function pre_search($query) {
		$stopword 	= explode(PHP_EOL, file_get_contents("stopword.txt"));
		$query 		= str_replace($stopword,"",$query);
		$kata		= explode(" ",$query);
		foreach($kata as $kata2){
			$benar = SpellCorrector::correct($kata2)." ";
			if($benar!=$kata2){
				$this->perbaiki = 1;
			}
			
			$katas[] = trim($this->CI->stem->stemming($benar));
		}
		
		return $katas;
	}
	
	function query($kata,$tipe,$hal=1){
		$this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		
		$get 	= $kata;
		$id 	= explode(" ",$get);
		
		$perbaiki = 0;
		
		foreach($id as $_keyword){
			$benar = SpellCorrector::correct($_keyword)." ";
			if($benar!=$_keyword){
				$perbaiki = 1;
			}
			
			$keywords[] = $this->stem->stemming($benar);
		}
		
		$gets = "";
		foreach($keywords as $key){
			$gets = $get." ".$key;
		}

		$get = trim($get);
		$jumlah = 6;
		$data3 	= $this->CI->cari_model->cari_keyword_group($id);  
		$jumlah_dokumen_ditemukan = count($data3); 
		
		$perhalaman = 5;
		
		if($jumlah_dokumen_ditemukan > $perhalaman) {
			$get_url = $get.$hal;
		} else{
			$get_url =$get;
		}
	
		if ( ! $output = $this->cache->get($get_url)) {
		
			$data 	= $this->CI->cari_model->cari_keyword($id);
			$document_frekuensi = count($data);
			$output =  array();
			foreach($data as $hasil){
				$output[$hasil['document_id']] = 
				$output[$hasil['document_id']]+($hasil['frekuensi'] * log($jumlah + 1 / $document_frekuensi + 1, 2));
			}
			arsort($output); 
			
			if($jumlah_dokumen_ditemukan > $perhalaman){
				
				//$x 		= ceil($jumlah_dokumen_ditemukan / $perhalaman);
				$i 		= 0;
				$n 		= 0;
				foreach($output as $key=>$value) {
					
					if(($i % 5 )==0){
						$n++;
					}
					
					$datax[$n][] = array($key=>$value);
					$i++;
				}
				//print_r($datax);
				
				foreach($datax as $key=>$value){
					$this->cache->save($get.$key, $value, 300);
				}
				
				$output = $datax[$hal];
			} else {
				$i = 0;
					foreach($output as $key=>$value) {
					
					$datax[] = array($key=>$value);
					$output = $datax;
				$i++;
				}
				$this->cache->save($get, $datax, 300);
			}
		}
	}
	
	
	function indexing($dokumen,$judul,$tipe){
		$dokumen = "6";
		$judul		= $this->input->post('judul');
		$isi 		= $this->input->post('isi');

		//stopword removal
		$stopword 	= explode(PHP_EOL, file_get_contents("stopword.txt"));
		//$isi 		= str_replace($stopword,"",$isi);
		//$judul 		= str_replace($stopword,"",$judul);
		
		//buat jadi keyword
		$isi_keyword 	= explode(" ",$isi);
		$judul_keyword 	= explode(" ",$judul);
		$keyword_index 	=  array();
		$data =  array();
		$x = 0;
		foreach($isi_keyword as $ikey){
			$ikey = strtolower(str_replace(".","",$ikey));
			if(in_array($ikey,$stopword)){
				unset($isi_keyword[$x]);
			} else {
				//$isi_keyword[$x] = $pengakar->stem($ikey);
				if(array_key_exists($ikey,$keyword_index)){
					$keyword_index[$ikey]++;	
				} else {
					$keyword_index[$ikey] = 1;
				}
			}
			$x++;
		}
		
		foreach($keyword_index as $keyword=>$frekuensi){
			$result	= $this->cari_model->keyword($keyword);
			if(count($result) > 0){
				$id = $result[0]['id'];
			} else  {
				$id	= $this->cari_model->tambah_keyword(array("id"=>"","nama"=>$keyword));
			}
			
			$this->cari_model->tambah_term(
			array("id"=>"","keyword_id"=>$id,"document_id"=>$dokumen,"frekuensi"=>$frekuensi));
			
			//$data[] = array("frekuensi"=>$frekuensi,"keyword"=>$keyword);
		}
		
		echo "<pre>";
		//proses stemming
		//print_r($isi_keyword);
		print_r($data);
	}
		
}