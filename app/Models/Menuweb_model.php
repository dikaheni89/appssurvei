<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Menuweb_model extends Model
{
	protected $table = 'tbl_menusweb';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['title', 'uri', '_parent', 'order']; 
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertmenu($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    public function insertMenuweb($data)
    {
        $query = $this->table($this->table)->insert($data);
        $result = array(
            'id'    => (int)$this->insertId()
        );
        return $result;
    }

    function deletedmenu($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    function updatemenu($data,$id)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    public function geturutanmenu()
    {
        $query = $this->table($this->table)
                 ->where('deleted_at', null)
                 ->countAllResults();
        return $query;
    }

    function getmenu()
    {
        $query = $this->table($this->table)
                ->where('deleted_at', null)
                ->orderby('order')
                ->get();
        return $query->getResult();
    }

    function view_where($data)
    {
        $query = $this->table($this->table)
                ->where('_id', $data)
                ->where('deleted_at', null)
                ->get();
        return $query->getRowArray();
    }

    function main_menu()
    {
        $data=array();
        $query = $this->table($this->table)
                 ->select('_id')
                 ->where('_parent', 0)
                 ->where('deleted_at', null)
                 ->get();
        foreach ($query->getResultArray() as $row)
        {
            $data[] =$row['_id'];
        }
        $result = $this->table($this->table)
                ->whereIn('_id', $data)
                ->where('_parent', 0)
                ->where('deleted_at', null)
                ->orderBy('order','ASC')
                ->get();

        return $result;
    }

    public function getSubMenus($is_main)
    {
        $result = $this->table($this->table)
                ->where('deleted_at', null)
                ->where('_parent', $is_main)
                ->orderBy('order','ASC')
                ->get();
        return $result;
    }

    public function getIndukMenu($id){
        $result = $this->table($this->table)
                ->where('deleted_at', null)
                ->where('_parent', $id)
                ->orderBy('order','ASC')
                ->get();

        return $result;
    }
}