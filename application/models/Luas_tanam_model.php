<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Luas_tanam_model extends CI_Model {
 
    var $table = 'panen';
    var $bulan;
    var $id;
    var $tahun;
    var $column_order = array(null, 'kecamatan','tambah_tanam','bulan','tahun','tanggal_input'); //set column field database for datatable orderable
    var $column_search = array('kecamatan','tambah_tanam','bulan','tahun','tanggal_input'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->kondisi();
        $this->db->from($this->table);
    
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    private function _get_datatables_query2()
    {
        $this->kondisi();
        $this->db->from('data');
    
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($bulan,$tahun,$id)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->id = $id;

        $this->_get_datatables_query();
        $this->kondisi();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
    
        $query = $this->db->get();
        return $query->result();
    }

    function get_datatables2($bulan,$tahun,$id)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->id = $id;

        $this->_get_datatables_query2();
        $this->kondisi();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
    
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {

        $this->_get_datatables_query();

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
      $this->kondisi();
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function kondisi(){
        if($this->bulan != "semua") {
            $this->db->where("bulan",$this->bulan);
        }
      
         $this->db->where("tahun",$this->tahun);
         $this->db->where("komoditas",$this->id);

    }


 
}
