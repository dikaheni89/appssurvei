<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Halaman_model extends Model
{
	protected $table = 'tbl_halaman';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['title', 'seo', 'deskripsi', 'image']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function inserthalaman($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    function deletedhalaman($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    function updatehalaman($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }
    
    function gethalamanbyid($id)
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

    function gethalaman()
    {
        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->get();
        return $query->getResultArray();
    }

    function allhalaman($limit,$start,$col,$dir)
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

    function halaman_search($limit,$start,$search,$col,$dir)
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

    function halaman_search_count($search)
    {
       $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('title',$search);
        return $query->countAllResults();
    }

    function webprofil()
    {   
        $result = $this->table($this->table)
                ->where('deleted_at', null)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->where('deleted_at', null)
                ->get()
                ->getResult();
        }else{
            $result = array();
        }
        
        return $result;
    }

    function webprofildetail($id)
    {   
        $query = $this->table($this->table)
            ->where('deleted_at', null)
            ->where('seo',$id)
            ->get();
        return $query->getRow();
    }
}