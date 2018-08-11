<?php
class Dashboard_model extends CI_Model {


	public function data_kecamatan()
	{
		
		$this->db->select('a.*');
		$this->db->from('kecamatan a');
		$query = $this->db->get();
	    return $query->result_array(); 
	}

	
	function data_tanam2($bulan,$tahun,$komoditas) {
		$this->db->select('a.tambah_tanam,a.id,a.kecamatan as id_kecamatan,b.nama as kecamatan');
		$this->db->from('data a');
		$this->db->join('kecamatan b', 'a.kecamatan = b.id');
		$this->db->join('desa c', 'a.desa = c.id');
		$this->db->join('info_lahan d', 'a.lahan = d.id');
		if($bulan!="semua") {
			$this->db->where("a.bulan='$bulan'");
		}
		$this->db->where("a.tahun='$tahun'");
		$this->db->where("a.komoditas='$komoditas'");

		$query = $this->db->get();
	    return $query->result_array(); 
	}

	function data_tanam($bulan,$tahun,$komoditas) {
		$this->db->select('a.tambah_tanam,a.id,a.kecamatan as id_kecamatan,b.nama as kecamatan');
		$this->db->from('panen a');
		$this->db->join('kecamatan b', 'a.kecamatan = b.id');
		if($bulan!="semua") {
			$this->db->where("a.bulan='$bulan'");
		}
		$this->db->where("a.tahun='$tahun'");
		$this->db->where("a.komoditas='$komoditas'");

		$query = $this->db->get();
	    return $query->result_array(); 
	}
	function data_luas_panen($bulan,$tahun,$komoditas) {
		$this->db->select('a.luas_panen,a.id,a.kecamatan as id_kecamatan,b.nama as kecamatan');
		$this->db->from('panen a');
		$this->db->join('kecamatan b', 'a.kecamatan = b.id');
		if($bulan!="semua") {
			$this->db->where("a.bulan='$bulan'");
		}
		$this->db->where("a.tahun='$tahun'");
		$this->db->where("a.komoditas='$komoditas'");

		$query = $this->db->get();
	    return $query->result_array(); 
	}

	function data_panen($bulan,$tahun,$komoditas) {
	
		$this->db->select('a.berat,a.id,a.kecamatan as id_kecamatan,b.nama as kecamatan');
		$this->db->from('panen a');
		$this->db->join('kecamatan b', 'a.kecamatan = b.id');
		if($bulan!="semua") {
			$this->db->where("a.bulan='$bulan'");
		}
		
		$this->db->where("a.tahun='$tahun'");
		$this->db->where("a.komoditas='$komoditas'");

		$query = $this->db->get();
	    return $query->result_array(); 
	}

	function nama_kecamatan($id) {
		$this->db->select('a.nama');
		$this->db->from('kecamatan a');
	
		$this->db->where("a.id='$id'");
		$query = $this->db->get();
	    return $query->result_array(); 
	}

	function data_petugas($id) {
		$this->db->select('*');
		$this->db->from('users');
	
		$this->db->where("user_id='$id'");
		$query = $this->db->get();
	    return $query->result_array(); 
	}


	function dinamika($tahun) {
		$this->db->select('a.*');
		$this->db->from('dinamika_budidaya a');
		$this->db->where("a.tahun='$tahun'");
	
		
		$query = $this->db->get();
	    return $query->result_array(); 
	}

	public function data_kemoditas()
	{
		
		$this->db->select('a.*');
		$this->db->from('komoditas a');
		$query = $this->db->get();
	    return $query->result_array(); 
	}
	
	function count_kelompok_tani($kecamatan) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'b.kecamatan=c.id');
		$this->db->where("c.id='$kecamatan'");
		echo $this->db->count_all_results(); 
	}

	function aset_by_id($id){
		$this->db->select('*');
		$this->db->from('hibah');
		$this->db->where("id='$id'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function unit_usaha_by_id($id){
		$this->db->select('*');
		$this->db->from('unit_usaha_gapoktan');
		$this->db->where("id='$id'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function aktivitas_by_id($id){
		$this->db->select('*');
		$this->db->from('aktivitas');
		$this->db->where("id='$id'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function detail_aktivitas($id) {
		$this->db->select('a.*,b.user_name,b.user_lastname');
		$this->db->from('aktivitas a');
			$this->db->join('users b', 'b.user_id=a.user_id');

		$this->db->where("a.id='$id'");
		$query = $this->db->get();
		return $query->result_array();
	}
	function penghargaan_by_id($id){
		$this->db->select('*');
		$this->db->from('penghargaan');
		$this->db->where("id='$id'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function penghargaan_by_user_id($id){
		$this->db->select('*');
		$this->db->from('penghargaan');
		$this->db->where("user_id='$id'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function count_gapoktan($kecamatan) {
		$this->db->select('a.*');
		$this->db->from('gapoktan a');
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'b.kecamatan=c.id');
		$this->db->where("c.id='$kecamatan'");
		echo $this->db->count_all_results(); 
	}
	
	
	function count_kelompok_tani_by_tahun($tahun) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->where("a.tahun_berdiri='$tahun'");
		return $this->db->count_all_results(); 
	}
	
	function count_kelompok_tani_by_kelas($kelas) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->where("a.kelas='$kelas'");
		return $this->db->count_all_results(); 
	}

	
	function count_kelompok_tani_by_komoditas($komoditas) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->where("a.komoditas='$komoditas'");
		return $this->db->count_all_results(); 
	}
	function count_kelompok_tani_by_tanah($tanah) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->where("a.komoditas='$tanah'");
		return $this->db->count_all_results(); 
	}
	

	function nama_desa($id) {
		$this->db->select('a.*');
		$this->db->from('desa a');
		$this->db->where("a.id='$id'");
		$query = $this->db->get();
		 return $query->result_array();
	}


	function desa_by_kecamatan($id) {
		$this->db->select('a.nama, a.id');
		$this->db->from('desa a');
		$this->db->where("a.kecamatan='$id'");
		$query = $this->db->get();
		 return $query->result_array();
	}

	function gapoktan_by_kecamatan($kecamatan) {
		$this->db->select('a.*,b.nama as nama_desa,c.nama as nama_kecamatan');
		$this->db->from('gapoktan a');
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'a.kecamatan=c.id');
		$this->db->where("c.id='$kecamatan'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function gapoktan_by_user_id($user_id) {
		$this->db->select('a.*');
		$this->db->from('gapoktan a');
	
		$this->db->where("a.id_user='$user_id'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function poktan_by_user_id($user_id) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
	
		$this->db->where("a.id_user='$user_id'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function gapoktan_tani_by_desa($desa) {
		$this->db->select('a.*');
		$this->db->from('gapoktan a');
		$this->db->where("a.desa='$desa'");
		$query = $this->db->get();
		return $query->result_array();
	}



	function kelompok_tani_by_kecamatan($kecamatan) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'b.kecamatan=c.id');
		$this->db->where("c.id='$kecamatan'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function kelompok_tani_by_desa($desa) {
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->where("a.desa='$desa'");
		$query = $this->db->get();
		return $query->result_array();
	}

	function nama_kelompok_tani($id) {
		$this->db->select('*');
		$this->db->from('kelompok_tani');
		$this->db->where("url='$id'");
		$query = $this->db->get();
		 return $query->result_array();
	}
	
	


	
	public function data_desa()
	{
		
		$query = $this->db->get('desa');
	    return $query->result_array(); 
	}


	
	public function kelompok_tani($perhalaman,$offset=NUL)
	{
		$this->db->select('a.*,b.nama as nama_desa,c.nama as nama_kecamatan');
	
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'b.kecamatan = c.id');
		
		$query = $this->db->get('kelompok_tani a',$perhalaman,$offset);
		
	    return $query->result_array(); 
	}

	
	public function gapoktan($perhalaman,$offset=NULL)
	{
		$this->db->select('a.*,b.nama as nama_desa,c.nama as nama_kecamatan');
		
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'b.kecamatan = c.id');
		$this->db->order_by("id", "desc");	
		$query = $this->db->get('gapoktan a',$perhalaman,$offset);
	    return $query->result_array(); 
	}

	public function semua_gapoktan()
	{
		$this->db->select('*');
		$query = $this->db->get('gapoktan');
	    return $query->result_array(); 
	}

	public function semua_kelompok_tani()
	{
		$this->db->select('*');
		$query = $this->db->get('kelompok_tani');
	    return $query->result_array(); 
	}



	 
	 public function jumlah_gapoktan()
	{
		$this->db->select('a.id');
		$this->db->from('gapoktan a');
		
		$query = $this->db->get();
	    return $query->result_array(); 
	}


public function gapoktan_data()
	{
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');

		$query = $this->db->get();
	    return $query->result_array(); 
	}
	public function jumlah_poktan()
	{
		$this->db->select('a.id');
		$this->db->from('kelompok_tani a');
		
		$query = $this->db->get();
	    return $query->result_array(); 
	}
	 
	public function kelompok_tani_search($nama="",$kecamatan="",$desa="")
	{
		
		$this->db->select('a.*,b.nama as nama_desa,c.nama as nama_kecamatan');
		$this->db->from('kelompok_tani a');
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'b.kecamatan = c.id');
		$this->db->like('a.nama', $nama);
		
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function gapoktan_nama($nama="")
	{
		
		$this->db->select('a.id,a.kecamatan,a.desa,id_user');
		$this->db->from('gapoktan a');

		$this->db->where("a.nama='$nama'");
		
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}
public function poktan_nama($nama="",$gapoktan)
	{
		
		$this->db->select('a.id,a.kecamatan,a.desa,id_user');
		$this->db->from('kelompok_tani a');
$this->db->where("a.gapoktan='$gapoktan'");
		$this->db->like("a.nama",$nama);
		
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}
	public function gapoktan_search($nama="",$kecamatan="",$desa="")
	{
		
		$this->db->select('a.*,b.nama as nama_desa,c.nama as nama_kecamatan');
		$this->db->from('gapoktan a');
		$this->db->join('desa b', 'a.desa = b.id');
		$this->db->join('kecamatan c', 'b.kecamatan = c.id');
		$this->db->like('a.nama', $nama);
		
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}
	
	public function hibah()
	{
		$this->db->select('a.*');
		//$this->db->select('a.*,b.nama as nama_kelompok_tani,c.nama');
		$this->db->from('hibah a');
		//$this->db->join('kelompok_tani b', 'a.kelompok_tani = b.id');
		$this->db->join('barang_hibah c', 'a.barang=c.id');
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function hibah_by_kecamatan($kecamatan,$awal="",$akhir="")
	{
	
		$this->db->select('a.*,b.nama as nama_kelompok_tani,c.nama');
		$this->db->from('hibah a');
		$this->db->join('kelompok_tani b', 'a.kelompok_tani = b.id');
		$this->db->join('barang_hibah c', 'a.barang=c.id');
		if($awal!="" and $akhir!=""){
			$this->db->where("a.tahun >= $awal AND a.tahun <=$akhir");
		}
		$this->db->where("b.kecamatan='$kecamatan'");
		$this->db->group_by("a.id");
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function hibah_by_desa($desa,$awal="",$akhir="")
	{
		$this->db->select('a.*,b.nama as nama_kelompok_tani,c.nama');
		$this->db->from('hibah a');
		$this->db->join('kelompok_tani b', 'a.kelompok_tani = b.id');
		$this->db->join('barang_hibah c', 'a.barang=c.id');
		
		$this->db->where("b.desa='$desa'");
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function hibah_by_desa_($desa)
	{
		$this->db->select('a.barang,a.jumlah');
		$this->db->from('hibah a');
	
		$this->db->join('users b', 'a.user_id=b.user_id');

		$this->db->where("b.user_id='$desa'");
		//$this->db->group_by("a.barang");
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function hibah_by_kecamatan_($kecamatan)
	{
	
		$this->db->select('a.barang,a.jumlah');
		$this->db->from('hibah a');
	
		$this->db->join('users b', 'a.user_id=b.user_id');

		$this->db->where("b.kecamatan='$kecamatan'");
		//$this->db->group_by("a.barang");
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}


public function hibah_by_kelompok_tani($id,$awal="",$akhir="")
	{

		$this->db->select('a.*,b.*');
		$this->db->from('hibah a');
	$this->db->join('barang_hibah b', 'a.barang = b.id');
		$this->db->where("a.user_id='$id'");
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}
	public function hibah_by_gapoktan($id,$awal="",$akhir="")
	{

		$this->db->select('a.*,b.*');
		$this->db->from('hibah a');
	$this->db->join('barang_hibah b', 'a.barang = b.id');
		$this->db->where("a.user_id='$id'");
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}
	
	public function aktivitas()
	{
		$this->db->select('a.*,b.user_name,b.user_lastname');
		$this->db->from('aktivitas a');
		$this->db->join('users b', 'a.user_id = b.user_id');
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}
	public function aktivitas_by_kecamatan($kecamatan,$awal="",$akhir="")
	{
		$this->db->select('a.*,b.user_name,b.user_lastname');
		//$this->db->select('a.*,b.nama as nama_kelompok_tani');
		$this->db->from('aktivitas a');

		$this->db->join('users b', 'a.user_id = b.user_id');
		if($awal!="" and $akhir!=""){
			$this->db->where("a.tahun >= $awal AND a.tahun <=$akhir");
		}
		$this->db->where("b.kecamatan='$kecamatan'");
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function aktivitas_by_desa($desa,$awal="",$akhir="")
	{
		$this->db->select('a.*,b.user_name,b.user_lastname');
	
		$this->db->from('aktivitas a');

		$this->db->join('users b', 'a.user_id = b.user_id');
		if($awal!="" and $akhir!=""){
			$this->db->where("a.tahun >= $awal AND a.tahun <=$akhir");
		}
		$this->db->where("b.desa='$desa'");
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function aktivitas_by_kelompok_tani($id,$awal="",$akhir="")
	{
		$this->db->select('a.*');
		$this->db->from('aktivitas a');

		
	
		$this->db->where("a.user_id='$id'");
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

public function aktivitas_by_gapoktan($id,$awal="",$akhir="")
	{
		$this->db->select('a.*');
		$this->db->from('aktivitas a');

		
		$this->db->where("a.user_id='$id'");
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

public function unit_usaha($gapoktan)
	{
		$this->db->select('a.*');
		$this->db->from('unit_usaha_gapoktan a');

		
		$this->db->where("a.gapoktan='$gapoktan'");
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function keuangan($gapoktan)
	{
		$this->db->select('a.*');
		$this->db->from('keuangan a');

		
		$this->db->where("a.gapoktan='$gapoktan'");
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}

	public function petani_anggota($poktan)
	{
		$this->db->select('a.*');
		$this->db->from('petani a');

		
		$this->db->where("a.kelompok_tani='$poktan'");
	
		$query = $this->db->get();
		
	    return $query->result_array(); 
	}


	public function penghargaan_kelompok_tani($poktan)
	{
		$this->db->select('a.*');
		$this->db->from('penghargaan a');		
		$this->db->where("a.kelompok_tani='$poktan'");
		$query = $this->db->get();
	    return $query->result_array(); 
	}

	public function kelompok_tani_gapoktan($gapoktan)
	{
		$this->db->select('a.*');
		$this->db->from('kelompok_tani a');
		$this->db->where("a.gapoktan='$gapoktan'");
		$query = $this->db->get();
	    return $query->result_array(); 
	}

	
	
	

	
	
	function komoditas(){
		$query = $this->db->get('komoditas'); 
		return $query->result_array(); 		
	}
	
	function tanah(){
		$query = $this->db->get('tanah'); 
		return $query->result_array(); 		
	}

	
    
	
}
?>
