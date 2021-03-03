<?php namespace App\Admin\Models;

use CodeIgniter\Model;

/**
* 
*/
class Input_model extends Model
{
	protected $table = 'tbl_input';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['idnmsurvei', 'nm_input']; 

    public function getcomboinput()
    {
        $query=$this->table($this->table)
                ->select('tbl_input .*, tbl_namasurvei.nm_survei')
                ->join('tbl_namasurvei', 'tbl_namasurvei._id=tbl_input.idnmsurvei')
                ->get();
        return $query->getResultArray();
    }

    public function getcomboinputs($id)
    {
        $query=$this->table($this->table)
                ->where('idnmsurvei',$id)
                ->get();
        return $query->getResultArray();
    }

    public function insertinput($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updateinput($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    public function deleteinput($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }


    public function getinput()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_input._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_input']) ? strval($_POST['search_input']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->Where('nm_input ~* \''.$search.'\'')
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->table($this->table)
                ->Where('nm_input ~* \''.$search.'\'')
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();
        // $query=get();    

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getinputbyid($id)
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

    function allinput($limit,$start,$col,$dir)
    {   
        $result = $this->table($this->table)
                ->select('tbl_input .*, tbl_namasurvei.nm_survei')
                ->join('tbl_namasurvei', 'tbl_namasurvei._id=tbl_input.idnmsurvei')
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->select('tbl_input .*, tbl_namasurvei.nm_survei')
                ->join('tbl_namasurvei', 'tbl_namasurvei._id=tbl_input.idnmsurvei')
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->get()
                ->getResult();
        }else{
            $result = array();
        }
        
        return $result;
    }

    function input_search($limit,$start,$search,$col,$dir)
    {

        $query = $this->table($this->table)
                ->select('tbl_input .*, tbl_namasurvei.nm_survei')
                ->join('tbl_namasurvei', 'tbl_namasurvei._id=tbl_input.idnmsurvei')
                ->like('tbl_input.nm_input',$search)
                ->like('tbl_namasurvei.nm_survei',$search)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($query > 0){
             $query = $this->table($this->table)
                    ->select('tbl_input .*, tbl_namasurvei.nm_survei')
                    ->join('tbl_namasurvei', 'tbl_namasurvei._id=tbl_input.idnmsurvei')
                    ->like('tbl_input.nm_input',$search)
                    ->like('tbl_namasurvei.nm_survei',$search)
                    ->limit($limit,$start)
                    ->orderby($col,$dir)
                    ->get()
                    ->getResult();
        }else{
            $query = array();
        }
        return $query;
    }

    function input_search_count($search)
    {
       $query = $this->table($this->table)
                ->select('tbl_input .*, tbl_namasurvei.nm_survei')
                ->join('tbl_namasurvei', 'tbl_namasurvei._id=tbl_input.idnmsurvei')
                ->like('tbl_input.nm_input',$search)
                ->like('tbl_namasurvei.nm_survei',$search);
        return $query->countAllResults();
    }

}