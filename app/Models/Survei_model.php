<?php namespace App\Models;

use CodeIgniter\Model;

/**
* 
*/
class Survei_model extends Model
{
	protected $table = 'tbl_survei';
    protected $primaryKey   = '_id';
    protected $allowedFields = ['idkategorisurvei','idnmsurvei','idinput','idsubinput','jumlah','tgl_survei','status']; 
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $deletedField  = 'deleted_at';

    public function insertsurvei($data)
    {
        $query = $this->table($this->table)->insert($data);
        return $query ? true : false;
    }

    function deletedsurvei($id)
    {
        $query = $this->table($this->table)
                ->where('_id',$id)
                ->delete();
        return $query ? true : false;
    }

    function updatesurvei($id,$data)
    {
        $query = $this->table($this->table)->set($data)->where('_id',$id)->update();
        return $query ? true : false;
    }

    function getfield($table,$field,$key,$value){
        $result = $this->db->table($table)
        		  ->where($key,$value)
        		  ->get()
        		  ->getRowArray();
        return $result[$field];
    }

    function getpelaporanbyid($id)
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
                ->where('tbl_survei.deleted_at', null)
                ->countAllResults();
        return $query;
    }

    function allsurvei($limit,$start,$col,$dir)
    {   
        $result = $this->table($this->table)
                ->select('tbl_survei .*, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput')
                ->where('deleted_at', null)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($result > 0){
            $result = $this->table($this->table)
                ->select('tbl_survei .*, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput')
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

    function survei_search($limit,$start,$search,$col,$dir)
    {
        $query = $this->table($this->table)
                ->select('tbl_survei .*, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput')
                ->where('deleted_at', null)
                ->like('tbl_namasurvei.nm_survei',$search)
                ->like('tbl_kategorisurvei.kt_survei',$search)
                ->like('tbl_input.nm_input',$search)
                ->like('tbl_subinput.nm_subinput',$search)
                ->limit($limit,$start)
                ->orderby($col,$dir)
                ->countAll();
        if ($query > 0){
             $query = $this->table($this->table)
                    ->select('tbl_survei .*, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                    ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei')
                    ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei')
                    ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput')
                    ->join('tbl_input','tbl_input._id=tbl_survei.idinput')
                    ->where('deleted_at', null)
                    ->like('tbl_namasurvei.nm_survei',$search)
                    ->like('tbl_kategorisurvei.kt_survei',$search)
                    ->like('tbl_input.nm_input',$search)
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

    function survei_search_count($search)
    {
       $query = $this->table($this->table)
                ->select('tbl_survei .*, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput')
                ->where('deleted_at', null)
                ->like('tbl_namasurvei.nm_survei',$search)
                ->like('tbl_kategorisurvei.kt_survei',$search)
                ->like('tbl_input.nm_input',$search)
                ->like('tbl_subinput.nm_subinput',$search);
        return $query->countAllResults();
    }

    public function getchartsurvei($start,$end)
    {
        $query = $this->table($this->table)
                ->select('tbl_survei .*, SUM(tbl_survei.jumlah) as jml, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput')
                ->Where('tbl_survei.deleted_at', null)
                ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
                ->groupBy('tbl_survei.idkategorisurvei')
                ->get()->getResult(); 
        return $query;
    }

    public function getchartsurveidetail($start,$end,$idkategorisurvei)
    {
        $query = $this->table($this->table)
                ->select('tbl_survei .*, SUM(tbl_survei.jumlah) as jml, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput')
                ->Where('tbl_survei.deleted_at', null)
                ->Where('tbl_survei.idkategorisurvei', $idkategorisurvei)
                ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
                ->groupBy('tbl_survei.idnmsurvei')
                ->get(); 
        return $query;
    }

    // public function getchartsurveipendidikan($start,$end)
    // {
    //     $query = $this->table($this->table)
    //             ->select('tbl_survei .*, tbl_pendidikan.pendidikan, SUM(tbl_survei.jml_pria) as sumpria, SUM(tbl_survei.jml_perempuan) as sumperempuan')
    //             ->join('tbl_pendidikan','tbl_pendidikan._id=tbl_survei.idpendidikan','LEFT')
    //             ->Where('tbl_survei.deleted_at', null)
    //             ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
    //             ->where('tbl_survei.status', 1)
    //             ->groupBy('tbl_survei.idpendidikan')
    //             ->get()->getResult(); 
    //     return $query;
    // }

    // public function getchartsurveidetailpendidikan($start,$end,$idpendidikan)
    // {
    //     $query = $this->table($this->table)
    //             ->select('tbl_survei .*, tbl_pendidikan.pendidikan, SUM(tbl_survei.jml_pria) as sumpria, SUM(tbl_survei.jml_perempuan) as sumperempuan')
    //             ->join('tbl_pendidikan','tbl_pendidikan._id=tbl_survei.idpendidikan','LEFT')
    //             ->Where('tbl_survei.deleted_at', null)
    //             ->Where('tbl_survei.idpendidikan', $idpendidikan)
    //             ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
    //             ->groupBy('tbl_survei.idpendidikan')
    //             ->get()->getResult(); 
    //     return $query;
    // }

    // public function getchartsurveiusia($start,$end)
    // {
    //     $query = $this->table($this->table)
    //             ->select('tbl_survei .*, tbl_usia.usia, SUM(tbl_survei.jml_pria) as sumpria, SUM(tbl_survei.jml_perempuan) as sumperempuan')
    //             ->join('tbl_usia','tbl_usia._id=tbl_survei.idusia','LEFT')
    //             ->Where('tbl_survei.deleted_at', null)
    //             ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
    //             ->where('tbl_survei.status', 2)
    //             ->groupBy('tbl_survei.idusia')
    //             ->get()->getResult(); 
    //     return $query;
    // }

    // public function getchartsurveidetailusia($start,$end,$idusia)
    // {
    //     $query = $this->table($this->table)
    //             ->select('tbl_survei .*, tbl_usia.usia, SUM(tbl_survei.jml_pria) as sumpria, SUM(tbl_survei.jml_perempuan) as sumperempuan')
    //             ->join('tbl_usia','tbl_usia._id=tbl_survei.idusia','LEFT')
    //             ->Where('tbl_survei.deleted_at', null)
    //             ->Where('tbl_survei.idusia', $idusia)
    //             ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
    //             ->groupBy('tbl_survei.idusia')
    //             ->get()->getResult(); 
    //     return $query;
    // }

    // public function getchartsurveikerja($start,$end)
    // {
    //     $query = $this->table($this->table)
    //             ->select('tbl_survei .*, tbl_kerja.kerja, SUM(tbl_survei.jml_pria) as sumpria, SUM(tbl_survei.jml_perempuan) as sumperempuan')
    //             ->join('tbl_kerja','tbl_kerja._id=tbl_survei.idkerja','LEFT')
    //             ->Where('tbl_survei.deleted_at', null)
    //             ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
    //             ->where('tbl_survei.status', 3)
    //             ->groupBy('tbl_survei.idkerja')
    //             ->get()->getResult(); 
    //     return $query;
    // }

    // public function getchartsurveidetailkerja($start,$end,$idusia)
    // {
    //     $query = $this->table($this->table)
    //             ->select('tbl_survei .*, tbl_kerja.kerja, SUM(tbl_survei.jml_pria) as sumpria, SUM(tbl_survei.jml_perempuan) as sumperempuan')
    //             ->join('tbl_kerja','tbl_kerja._id=tbl_survei.idkerja','LEFT')
    //             ->Where('tbl_survei.deleted_at', null)
    //             ->Where('tbl_survei.idkerja', $idusia)
    //             ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
    //             ->groupBy('tbl_survei.idkerja')
    //             ->get()->getResult(); 
    //     return $query;
    // }

    public function getchartsurveiweb()
    {
        $query = $this->table($this->table)
                ->select('tbl_survei .*, SUM(tbl_survei.jumlah) as jml, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei','LEFT')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei','LEFT')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput','LEFT')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput','LEFT')
                ->Where('tbl_survei.deleted_at', null)
                // ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
                ->groupBy('tbl_survei.idkategorisurvei')
                ->get()->getResult(); 
        return $query;
    }

    public function getchartsurveidetailweb($idkategorisurvei)
    {
        $query = $this->table($this->table)
                ->select('tbl_survei .*, SUM(tbl_survei.jumlah) as jml, tbl_namasurvei.nm_survei, tbl_kategorisurvei.kt_survei, tbl_input.nm_input, tbl_subinput.nm_subinput')
                ->join('tbl_namasurvei','tbl_namasurvei._id=tbl_survei.idnmsurvei','LEFT')
                ->join('tbl_kategorisurvei','tbl_kategorisurvei._id=tbl_survei.idkategorisurvei','LEFT')
                ->join('tbl_subinput','tbl_subinput._id=tbl_survei.idsubinput','LEFT')
                ->join('tbl_input','tbl_input._id=tbl_survei.idinput','LEFT')
                ->Where('tbl_survei.deleted_at', null)
                ->Where('tbl_survei.idkategorisurvei', $idkategorisurvei)
                // ->where('tbl_survei.tgl_survei BETWEEN "'. $start . '" and "'. $end .'"')
                ->groupBy('tbl_survei.idnmsurvei')
                ->get(); 
        return $query;
    }

}