<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Videos_model extends Model
{
	protected $table = 'tbl_videos';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['title', 'uri']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertvideo($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    function deletedvideo($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    function updatevideo($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }
    
    function getvideobyid($id)
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

    function allvideos($limit,$start,$col,$dir)
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

    function videos_search($limit,$start,$search,$col,$dir)
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

    function videos_search_count($search)
    {
       $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->like('title',$search);
        return $query->countAllResults();
    } 

    function webvideos()
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

}