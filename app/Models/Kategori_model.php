<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Kategori_model extends Model
{
	protected $table = 'tbl_kategorimenus';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['title', 'seo']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertkategori($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    function deletedkategori($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    function updatekategori($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    public function getcomboKategori()
    {
        $query=$this->table($this->table)
                ->where('deleted_at', null)
                ->get();
        return $query->getResultArray();
    }
    
    function getkategoribyid($id)
    {
    	 $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->where('_id',$id)
                ->get();
        return $query->getRowArray();
    }

    function countAll()
    {   
        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->countAllResults();
        return $query;
    }

    function allkategori($limit,$start,$col,$dir)
    {   
        $result = $this->table($this->table)
                ->where('deleted_at', null)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->where('deleted_at', null)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->get()
                ->getResult();
        }else{
            $result = array();
        }
        
        return $result;
    }

    function kategori_search($limit,$start,$search,$col,$dir)
    {

        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('title',$search)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($query > 0){
             $query = $this->table($this->table)
                    ->where('deleted_at', null)
                    ->like('title',$search)
                    ->limit($limit,$start)
                    ->orderby($col,$dir)
                    ->get()
                    ->getResult();
        }else{
            $query = array();
        }
        return $query;
    }

    function kategori_search_count($search)
    {
       $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('title',$search);
        return $query->countAllResults();
    } 

}