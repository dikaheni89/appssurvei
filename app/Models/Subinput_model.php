<?php namespace App\Admin\Models;

use CodeIgniter\Model;

/**
* 
*/
class Subinput_model extends Model
{
	protected $table = 'tbl_subinput';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['idinput', 'nm_subinput']; 

    public function getcombosubinput()
    {
        $query=$this->table($this->table)
                ->get();
        return $query->getResultArray();
    }

    public function getcombosubinputs($id)
    {
        $query=$this->table($this->table)
                ->where('idinput',$id)
                ->get();
        return $query->getResultArray();
    }

    public function insertsubinput($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function updatesubinput($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    public function deletesubinput($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }


    public function getsubinput()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tbl_subinput._id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $search = isset($_POST['search_subinput']) ? strval($_POST['search_subinput']) : '';
        $offset = ($page-1)*$rows;
        $result = array();
        $query = $this->table($this->table)
                ->Where('nm_subinput ~* \''.$search.'\'')
                ->countAllResults();
        $result['total'] = $query;

        //
        $query = $this->table($this->table)
                ->Where('nm_subinput ~* \''.$search.'\'')
                ->orderBy($sort,$order)
                ->limit($rows,$offset)
                ->get();
        // $query=get();    

        $item = $query->getResultArray();    
        $result = array_merge($result, ['rows' => $item]);
        return $result;
    }

    function getsubinputbyid($id)
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

    function allsubinput($limit,$start,$col,$dir)
    {   
        $result = $this->table($this->table)
                ->select('tbl_subinput .*, tbl_input.nm_input')
                ->join('tbl_input', 'tbl_input._id=tbl_subinput.idinput')
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->select('tbl_subinput .*, tbl_input.nm_input')
                ->join('tbl_input', 'tbl_input._id=tbl_subinput.idinput')
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->get()
                ->getResult();
        }else{
            $result = array();
        }
        return $result;
    }

    function subinput_search($limit,$start,$search,$col,$dir)
    {

        $query = $this->table($this->table)
                ->select('tbl_subinput .*, tbl_input.nm_input')
                ->join('tbl_input', 'tbl_input._id=tbl_subinput.idinput')
                ->like('tbl_subinput.nm_subinput',$search)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($query > 0){
             $query = $this->table($this->table)
                    ->select('tbl_subinput .*, tbl_input.nm_input')
                    ->join('tbl_input', 'tbl_input._id=tbl_subinput.idinput')
                    ->like('tbl_subinput.nm_subinput',$search)
                    ->limit($limit,$start)
                    ->orderby($col,$dir)
                    ->get()
                    ->getResult();
        }else{
            $query = array();
        }
        return $query;
    }

    function subinput_search_count($search)
    {
       $query = $this->table($this->table)
                ->select('tbl_subinput .*, tbl_input.nm_input')
                ->join('tbl_input', 'tbl_input._id=tbl_subinput.idinput')
                ->like('tbl_subinput.nm_subinput',$search);
        return $query->countAllResults();
    }

}