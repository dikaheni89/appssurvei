<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Berita_model extends Model
{
	protected $table = 'tbl_berita';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['kategorimenu_id', 'title', 'seo', 'headline', 'deskripsi', 'image']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertberita($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    function deletedberita($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    function updateberita($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }
    
    function getberitabyid($id)
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
                ->where('tbl_berita.deleted_at', null)
                ->countAllResults();
        return $query;
    }

    function allberita($limit,$start,$col,$dir)
    {   
        $result = $this->table($this->table)
                ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                ->where('tbl_berita.deleted_at', null)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                ->where('tbl_berita.deleted_at', null)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->get()
                ->getResult();
        }else{
            $result = array();
        }
        
        return $result;
    }

    function berita_search($limit,$start,$search,$col,$dir)
    {

        $query = $this->table($this->table)
                ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                ->where('tbl_berita.deleted_at', null)
                ->like('tbl_berita.title',$search)
                ->orlike('tbl_berita.headline',$search)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($query > 0){
             $query = $this->table($this->table)
                    ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                    ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                    ->where('tbl_berita.deleted_at', null)
                    ->like('tbl_berita.title',$search)
                    ->orlike('tbl_berita.headline',$search)
                    ->limit($limit,$start)
                    ->orderby($col,$dir)
                    ->get()
                    ->getResult();
        }else{
            $query = array();
        }
        return $query;
    }

    function berita_search_count($search)
    {
       $query = $this->table($this->table)
                ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                ->where('tbl_berita.deleted_at', null)
                ->like('tbl_berita.title',$search)
                ->orlike('tbl_berita.headline',$search);
        return $query->countAllResults();
    } 

    function webberita()
    {   
        $result = $this->table($this->table)
                ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                ->where('tbl_berita.deleted_at', null)
                ->limit(4)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                ->where('tbl_berita.deleted_at', null)
                ->limit(4)
                ->get()
                ->getResult();
        }else{
            $result = array();
        }
        
        return $result;
    }

    function getdetailberita($id)
    {
         $query = $this->table($this->table)
                ->select('tbl_berita .*, tbl_kategorimenus.title as kategori')
                ->join('tbl_kategorimenus', 'tbl_kategorimenus._id=tbl_berita.kategorimenu_id')
                ->where('tbl_berita.deleted_at', null)
                ->where('tbl_berita.seo',$id)
                ->get();
        return $query->getRow();
    }

}