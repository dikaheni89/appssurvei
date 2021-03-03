<?php namespace App\Admin\Models;

use CodeIgniter\Model;

/**
* 
*/
class Namasurvei_model extends Model
{
	protected $table = 'tbl_namasurvei';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['nm_survei']; 

    public function getcombonamasurvei()
    {
        $query=$this->table($this->table)
                ->get();
        return $query->getResultArray();
    }

    public function insertnamasurvei($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updatenamasurvei($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    public function deletenamasurvei($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }


    public function getKerja()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_namasurvei._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_namasurvei']) ? strval($_POST['search_namasurvei']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->Where('nm_survei ~* \''.$search.'\'')
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->table($this->table)
                ->Where('nm_survei ~* \''.$search.'\'')
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();
        // $query=get();    

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getnamasurveibyid($id)
    {
         $query = $this->table($this->table)
                ->where('_id',$id)
                ->get();
        return $query->getRowArray();
    }

    function countAll()
    {   
        $query = $this->table($this->table)
                ->countAllResults();
        return $query;
    }

    function allnamasurvei($limit,$start,$col,$dir)
    {   
        $result = $this->table($this->table)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->get()
                ->getResult();
        }else{
            $result = array();
        }
        
        return $result;
    }

    function namasurvei_search($limit,$start,$search,$col,$dir)
    {

        $query = $this->table($this->table)
                ->like('nm_survei',$search)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($query > 0){
             $query = $this->table($this->table)
                    ->like('nm_survei',$search)
                    ->limit($limit,$start)
                    ->orderby($col,$dir)
                    ->get()
                    ->getResult();
        }else{
            $query = array();
        }
        return $query;
    }

    function namasurvei_search_count($search)
    {
       $query = $this->table($this->table)
                ->like('nm_survei',$search);
        return $query->countAllResults();
    }

}