<?php namespace App\Admin\Models;

use CodeIgniter\Model;

/**
* 
*/
class Kategorisurvei_model extends Model
{
	protected $table = 'tbl_kategorisurvei';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['kt_survei']; 

    public function getcombokategorisurvei()
    {
        $query=$this->table($this->table)
                ->get();
        return $query->getResultArray();
    }

    public function insertkategorisurvei($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updatekategorisurvei($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    public function deletekategorisurvei($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }


    public function getkategorisurvei()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_kategorisurvei._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_kategorisurvei']) ? strval($_POST['search_kategorisurvei']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->Where('kt_survei ~* \''.$search.'\'')
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->table($this->table)
                ->Where('kt_survei ~* \''.$search.'\'')
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();
        // $query=get();    

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getkategorisurveibyid($id)
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

    function allkategorisurvei($limit,$start,$col,$dir)
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

    function kategorisurvei_search($limit,$start,$search,$col,$dir)
    {

        $query = $this->table($this->table)
                ->like('kt_survei',$search)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($query > 0){
             $query = $this->table($this->table)
                    ->like('kt_survei',$search)
                    ->limit($limit,$start)
                    ->orderby($col,$dir)
                    ->get()
                    ->getResult();
        }else{
            $query = array();
        }
        return $query;
    }

    function kategorisurvei_search_count($search)
    {
       $query = $this->table($this->table)
                ->like('kt_survei',$search);
        return $query->countAllResults();
    }

}