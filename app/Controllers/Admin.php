<?php namespace App\Controllers;

use App\Controllers\Menu;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
	protected $session;
    protected $baseUrl;

    public function __construct()
    {
    	$this->session = \Config\Services::session();
        $this->security = \Config\Services::security();
        $this->baseUrl = base_url();
        $this->menus = new Menu();
        helper(['url','fatih']);
        $this->sess_id=$this->session->has('uid');

        $this->usersmodel = model('App\Models\Users_model',false);
        $this->level = model('App\Models\Level_model',false);
        $this->namasurveimodel= model('App\Models\Namasurvei_model',false);
        $this->kategorisurveimodel = model('App\Models\Kategorisurvei_model',false);
        $this->inputmodel = model('App\Models\Input_model',false);
        $this->subinputmodel = model('App\Models\Subinput_model',false);

        $this->videosmodel = model('App\Models\Videos_model',false);
        $this->kategorimodel = model('App\Models\Kategori_model',false);
        $this->beritamodel = model('App\Models\Berita_model',false);
        $this->halamanmodel = model('App\Models\Halaman_model',false);
        $this->surveimodel = model('App\Models\Survei_model',false);
        $this->menuwebmodel = model('App\Models\Menuweb_model',false);
    }

    public function index()
    {
    	$data=[
	        'title'     => 'DISKOMSANTIK KABUPATEN PANDEGLANG',
	        'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN',
	        'profil'    => $this->session->get('user'),
            'survei'    => $this->surveimodel->countAll(),
            'video'     => $this->videosmodel->countAll(),
            'berita'    => $this->beritamodel->countAll(),
            'user'      => $this->usersmodel->countAll(),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = '';
        $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
        $data['css_files'][] = base_url('template/plugins/bootstrap_date_time/css/bootstrap-datetimepicker.min.css');
        $data['css_files'][] = base_url('template/plugins/daterangepicker/daterangepicker-bs3.css');
        $data['css_files'][] = base_url('template/easyui/themes/icon.css');
        $data['css_files'][] = base_url('template/easyui/texteditor.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
        $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
        $data['js_files'][] = base_url('template/easyui/jquery.texteditor.js');
        $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
        $data['js_files'][] = base_url('template/plugins/bootstrap_date_time/js/bootstrap-datetimepicker.min.js');
        $data['js_files'][] = base_url('template/plugins/bootstrap_date_time/js/locales/bootstrap-datetimepicker.id.js');
        $data['js_files'][] = base_url('template/easyui/moment.js');
        $data['js_files'][] = base_url('template/plugins/daterangepicker/daterangepicker.js');
        $data['js_files'][] = 'https://code.highcharts.com/highcharts.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/data.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/drilldown.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/accessibility.js';
        return render('admin/dashboard',$data);
    }

    // public function getchartsurvei()
    // {
    //     $start=$this->request->getPost('start');
    //     $end=$this->request->getPost('end');
    //     $res=$this->surveimodel->getchartsurvei($start,$end);
    //     $data=array();
    //     $datasub=array();
    //     $total=0;
    //     foreach ($res as $row) {
    //         $res=$this->surveimodel->getchartsurveidetail($start,$end, $row->status);
    //         $datasub1=array();
    //         foreach ($res as $r) {
    //             $total=(float)$row->sumpria+(float)$row->sumperempuan;
    //             $datasub1[]=[
    //                 $r->status == 1 ? $this->surveimodel->getField('tbl_pendidikan','pendidikan','_id', $r->idpendidikan) : ($r->status == 2 ? $this->surveimodel->getField('tbl_usia','usia','_id', $r->idusia).' Tahun' : $this->surveimodel->getField('tbl_kerja','kerja','_id', $r->idkerja)),
    //                 (float)$r->jml_pria+(float)$r->jml_perempuan
    //             ];
    //         }
    //         $total=$total+((float)$row->sumpria+(float)$row->sumperempuan);
    //         $data[] = array(
    //                 'name'  => $row->status == 1 ? 'Pendidikan' : ($row->status == 2 ? 'Penduduk' : 'Tenaga Kerja'),
    //                 'y'     => (float)$row->sumpria+(float)$row->sumperempuan,
    //                 'drilldown' => $row->status == 1 ? 'Pendidikan' : ($row->status == 2 ? 'Penduduk' : 'Tenaga Kerja')
    //             );
    //         $datasub[] = array(
    //             'name'  => $row->status == 1 ? 'Pendidikan' : ($row->status == 2 ? 'Penduduk' : 'Tenaga Kerja'),
    //             'id'    => $row->status == 1 ? 'Pendidikan' : ($row->status == 2 ? 'Penduduk' : 'Tenaga Kerja'),
    //             'data'  => $datasub1
    //         );
    //     }

    //     $output=[
    //             'chart' => $data,
    //             'drilldown' => $datasub,
    //             'total' => $total
    //         ];
    //     $result = $this->response->setJSON($output);
    //     return $result;
    //     var_dump($result);
    // }

    public function getchartsurvei()
    {
        $start=$this->request->getPost('start');
        $end=$this->request->getPost('end');
        $data=array();
        $datasub=array();
        $total=0;
        $res=$this->surveimodel->getchartsurvei($start,$end);
        foreach ($res as $row) {
            $res=$this->surveimodel->getchartsurveidetail($start,$end,$row->idkategorisurvei);
            $datasub1=array();
            foreach ($res->getResult() as $r) {
                $total=$total+(float)$row->jml;
                $datasub1[]=[
                    $r->nm_survei,
                    (float)$r->jml
                ];
            }
            $total=$total+(float)$row->jml;
            $data[] = array(
                    'name'  => $row->kt_survei,
                    'y'     => (float)$row->jml,
                    'drilldown' => $row->kt_survei
                );
            $datasub[] = array(
                'name'  => $row->kt_survei,
                'id'    => $row->kt_survei,
                'data'  => $datasub1
            );
        }

        $output=[
                'chart' => $data,
                'drilldown' => $datasub,
                'total' => $total
            ];
        $result = $this->response->setJSON($output);
        return $result;
    }

    //Check Email
    function getUserByEmail()
    {
        $data=$this->usersmodel->getusersbyemail();
        if ($data > 0){
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function profil()
    {
      $data=[
        'title'     => 'Setting Profile',
        'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN',
        'profil'    => $this->session->get('user')
      ];
      $data['level'] = $this->level->getcomboLevel();
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
      $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
      $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
      $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
      $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
      return render('admin/profil/profil', $data);
    }

    public function updateprofil()
    {
        $user = $this->request->getPost('user');
        $full_name = $this->request->getPost('full_name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $level = $this->request->getPost('is_level');
        $aktif = $this->request->getPost('is_active');
        $data=array();
        $data = array(
            'user'      => $user,
            'full_name' => $full_name,
            'email'     => $email,
            'phone'     => $phone,
            'is_level'  => $level,
            'is_active' => $aktif
        );
        $id = $this->request->getPost('id');
        $result = $this->usersmodel->updateUsers($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function users()
    {
    	$data=[
    		'title'		=> 'MANAGEMENT USERS',
    		'apps'		=> 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN',
    		'profil'	=> $this->session->get('user'),
    	];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
    	$data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/administrator/admin',$data);
    }

    public function getusers()
    {  
        $columns = array(
            0=>'_id', 
            1=>'user',
            2=> 'full_name',
            3=> 'email',
            4=> 'phone'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->usersmodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $users = $this->usersmodel->allusers($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $users =  $this->usersmodel->users_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->usersmodel->users_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($users as $user)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $user->_id;
            $nestedData['user'] = $user->user;
            $nestedData['full_name'] = $user->full_name;
            $nestedData['email'] = $user->email;
            $nestedData['phone'] = $user->phone;
            $nestedData['is_active'] = $user->is_active;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addadmin()
    {
    	$data=[
            'title'     => 'Tambah Data Administrator',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Administrator',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['level'] = $this->level->getcomboLevel();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/administrator/addadmin',$data);
    }

    public function saveUsers()
    {
        $user = $this->request->getPost('user');
        $email = $this->request->getPost('email');
        $full_name = $this->request->getPost('full_name');
        $phone = $this->request->getPost('phone');
        $is_aktif = $this->request->getPost('is_active');
        $is_level = $this->request->getPost('is_level');
        $options = [
            'cost' => 10,
        ];
        $data=array();
        $data = array(
            'user'         => $user,
            'password'     => password_hash($user, PASSWORD_DEFAULT, $options),
            'email'        => $email,
            'full_name'    => $full_name,
            'phone'        => $phone,
            'is_active'    => $is_aktif,
            'is_level'     => $is_level,
        );
        $result = $this->usersmodel->insertUsers($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function resetuser()
    {
        $where =  $this->request->getPost('id');
        $user = $this->request->getPost('user');
        $data=array();
        $options = [
            'cost' => 10,
        ];
        $data = array(
            'password'     => password_hash($user, PASSWORD_DEFAULT, $options),
        );
        $result = $this->usersmodel->resetpassword($where,$data);
        if ($result){
            echo json_encode(array('message'=>'Resert Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deleteduser()
    {
        $where =  $this->request->getPost('id');
        $result = $this->usersmodel->deleteduser($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    // level
    public function level()
    {
      $data=[
        'title'     => 'Level Users',
        'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Level Users',
        'profil'    => $this->session->get('user')
      ];
      $data['menus']  = $this->menus->getmenus($this->sess_id);
      $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
      $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
      $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
      return render('admin/level/level', $data);
    }

    public function getlevel()
    {  
        $columns = array(
            0=>'_id', 
            1=>'level',
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->level->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $users = $this->level->alllevel($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $users =  $this->level->level_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->level->level_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($users as $level)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $level->_id;
            $nestedData['level'] = $level->level;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addlevel()
    {
        $data=[
            'title'     => 'Tambah Data Level Users',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Level Users',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/level/addlevel',$data);
    }

    public function editlevel($id)
    {
        $data=[
            'title'     => 'Edit Data Level Users',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Level Users',
            'profil'    => $this->session->get('user'),
            'level'     => $this->level->getlevelbyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/level/editlevel',$data);
    }

    public function savelevel()
    {
        $level = $this->request->getPost('level');
        $data=array();
        $data = array(
            'level'         => $level
        );
        $result = $this->level->insertLevel($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatelevel()
    {
        $level = $this->request->getPost('level');
        $data=array();
        $data = array(
            'level'         => $level
        );
        $id = $this->request->getPost('id');
        $result = $this->level->updateLevel($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedlevel()
    {
        $where =  $this->request->getPost('id');
        $result = $this->level->deleteLevel($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    //Combo Level
    public function comboLevel()
    {
        $data=$this->level->getcomboLevel();
        $result = $this->response->setJSON($data);
        return $result;
    }

    // Menu Frontend
    public function menu()
    {
        $data=[
            'title'     => 'Menu Website',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Menu Website',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['record'] = $this->menuwebmodel->getmenu();
        $data['halaman']  = $this->halamanmodel->gethalaman();
        $data['kategori']  = $this->kategorimodel->getcomboKategori();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/css/style.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/js/scripts/jquery.nestable.js');
        return render('admin/menu/menuwebsite',$data);
    }

    public function save_menuwebsite(){
        $link = $this->request->getPost('link').$this->request->getPost('page').$this->request->getPost('kategori');
        if($this->request->getPost('id') != ''){
            $data = array(
                'title'     => $this->request->getPost('label'),
                'uri'       => $link,
            );
            $where = $this->request->getPost('id');
            $this->menuwebmodel->updatemenu($data, $where);
            $arr['type']  = 'edit';
            $arr['label'] = $this->request->getPost('label');
            $arr['link']  = $this->request->getPost('link');
            $arr['page']  = $this->request->getPost('page');
            $arr['kategori']  = $this->request->getPost('kategori');
            $arr['id']    = $this->request->getPost('id');
        }else{
            $row = $this->menuwebmodel->geturutanmenu();
            $data = array(
                '_parent'    => 0,
                'title'      => $this->request->getPost('label'),
                'uri'        => $link,
                'order'      => $row
            );
            $menunew = $this->menuwebmodel->insertMenuweb($data);
            $arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$menunew['id'].'" >
                                <div class="dd-handle dd3-handle Bottom">Drag</div>
                                <div class="dd3-content"><span id="label_show'.$menunew['id'].'">'.$this->request->getPost('label').'</span>
                                    <span class="span-right">/<span id="link_show'.$menunew['id'].'">'.$link.'</span> &nbsp;&nbsp;  
                                        <a class="edit-button" id="'.$menunew['id'].'" label="'.$this->request->getPost('label').'" link="'.$this->request->getPost('link').'" ><i class="fa fa-edit"></i></a> &nbsp; 
                                        <a class="del-button" id="'.$menunew['id'].'"><i class="fa fa-trash"></i></a>
                                    </span> 
                                </div>';
            $arr['type'] = 'add';
        }
        print json_encode($arr);
    }

    public function savedragmenu(){
        $ress = json_decode($this->request->getPost('data'));
        function parseJsonArray($ress, $parent = 0) {
            $return = array();
            foreach ($ress as $subArray) {
                $returnSubSubArray = array();
                if (isset($subArray->children)) {
                    $returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
                }

                $return[] = array('id' => $subArray->id, 'parentID' => $parent);
                $return = array_merge($return, $returnSubSubArray);
            }
            return $return;
        }
        $readbleArray = parseJsonArray($ress);

        $i=0;
        $hasil=array();
        foreach($readbleArray as $row){
            $i++;
            $hasil = array(
                '_parent' => $row['parentID'],
                'order' => $i
            );
            $where = $row['id'];
            $this->menuwebmodel->updatemenu($hasil, $where);
        }
    }    

    public function deletemenu()
    {
        $where =  $this->request->getPost('id');
        $result = $this->menuwebmodel->deletedmenu($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    // Kategori Berita
    public function kategori()
    {
        $data=[
            'title'     => 'Kategori',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Kategori',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/kategori/kategori',$data);
    }

    public function getkategori()
    {
        $columns = array(
            0=>'_id', 
            1=>'title'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->kategorimodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->kategorimodel->allkategori($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->kategorimodel->kategori_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->kategorimodel->kategori_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $kategori)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $kategori->_id;
            $nestedData['title'] = $kategori->title;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addkategori()
    {
        $data=[
            'title'     => 'Tambah Data Kategori',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Kategori',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategori/addkategori',$data);
    }

    public function editKategori($id)
    {
        $data=[
            'title'     => 'Edit Data Kategori',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Kategori',
            'profil'    => $this->session->get('user'),
            'kategori'  => $this->kategorimodel->getkategoribyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategori/editkategori',$data);
    }

    public function savekategori()
    {
        $title = $this->request->getPost('title');
        $data=array();
            $data = array(
                'title'         => $title,
                'seo'           => seo_title($title)
            );

        $result = $this->kategorimodel->insertkategori($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatekategori()
    {
        $title = $this->request->getPost('title');
        $data=array();
        $data = array(
            'title'    => $title,
            'seo'      => seo_title($title)
        );
        
        $id = $this->request->getPost('id');
        $result = $this->kategorimodel->updatekategori($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedkategori()
    {

        $where =  $this->request->getPost('id');
        $result = $this->kategorimodel->deletedkategori($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    // halaman statis
    public function halaman()
    {
        $data=[
            'title'     => 'Halaman Statis',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Halaman Statis',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/halaman/halaman',$data);
    }

    public function gethalaman()
    {
        $columns = array(
            0=>'_id', 
            1=>'image',
            2=>'title'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->halamanmodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->halamanmodel->allhalaman($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->halamanmodel->halaman_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->halamanmodel->halaman_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $halaman)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $halaman->_id;
            $nestedData['title'] = $halaman->title;
            $nestedData['deskripsi'] = substr($halaman->deskripsi, 0,600);
            $nestedData['image'] = $halaman->image;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addhalaman()
    {
        $data=[
            'title'     => 'Tambah Data Halaman Statis',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Halaman Statis',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/summernote/dist/summernote.css');
        $data['js_files'][] = base_url('template/vendors/summernote/dist/summernote.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/halaman/addhalaman',$data);
    }

    public function edithalaman($id)
    {
        $data=[
            'title'     => 'Edit Data Halaman Statis',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Halaman Statis',
            'profil'    => $this->session->get('user'),
            'halaman'   => $this->halamanmodel->gethalamanbyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/summernote/dist/summernote.css');
        $data['js_files'][] = base_url('template/vendors/summernote/dist/summernote.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/halaman/edithalaman',$data);
    }

    public function savehalaman()
    {
        $title = $this->request->getPost('title');
        $deskripsi = $this->request->getPost('deskripsi');
        $img = $this->request->getFile('image');
        $data=array();
        if ($img != null) {
            $img->move('./uploads/halaman/');
            $data = array(
                'title'         => $title,
                'deskripsi'     => $deskripsi,
                'seo'           => seo_title($title),
                'image'         => $img->getName()
            );
        }else{
            $data = array(
                'title'         => $title,
                'deskripsi'     => $deskripsi,
                'seo'           => seo_title($title)
            );
        }
        $result = $this->halamanmodel->inserthalaman($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatehalaman()
    {
        $title = $this->request->getPost('title');
        $deskripsi = $this->request->getPost('deskripsi');
        $img = $this->request->getFile('image');
        $data=array();
        if ($img != null) {
            $img->move('./uploads/halaman/');
            $data = array(
                'title'         => $title,
                'deskripsi'     => $deskripsi,
                'seo'           => seo_title($title),
                'image'         => $img->getName()
            );
        }else{
             $data = array(
                'title'         => $title,
                'deskripsi'     => $deskripsi,
                'seo'           => seo_title($title)
            );
        }
        
        $id = $this->request->getPost('id');
        $result = $this->halamanmodel->updatehalaman($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedhalaman()
    {

        $where =  $this->request->getPost('id');
        $imageid = $this->halamanmodel->gethalamanbyid($where);
        $path = './uploads/halaman/';
        @unlink($path.$imageid['image']);
        $result = $this->halamanmodel->deletedhalaman($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    //Berita
    public function berita()
    {
        $data=[
            'title'     => 'Berita',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Berita',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/berita/berita',$data);
    }

    public function getberita()
    {
        $columns = array(
            0=>'_id', 
            1=>'title'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->beritamodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->beritamodel->allberita($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->beritamodel->berita_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->beritamodel->berita_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $berita)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $berita->_id;
            $nestedData['kategori'] = $berita->kategori;
            $nestedData['title'] = $berita->title;
            $nestedData['headline'] = $berita->headline;
            $nestedData['deskripsi'] = $berita->deskripsi;
            $nestedData['image'] = base_url('uploads/berita/'.$berita->image);
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addberita()
    {
        $data=[
            'title'     => 'Tambah Data Berita',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Berita',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['kategori'] = $this->kategorimodel->getcomboKategori();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['css_files'][] = base_url('template/vendors/summernote/dist/summernote.css');
        $data['js_files'][] = base_url('template/vendors/summernote/dist/summernote.min.js');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/berita/addberita',$data);
    }

    public function editberita($id)
    {
        $data=[
            'title'     => 'Edit Data Berita',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Berita',
            'profil'    => $this->session->get('user'),
            'berita'    => $this->beritamodel->getberitabyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['kategori'] = $this->kategorimodel->getcomboKategori();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['css_files'][] = base_url('template/vendors/summernote/dist/summernote.css');
        $data['js_files'][] = base_url('template/vendors/summernote/dist/summernote.min.js');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/berita/editberita',$data);
    }

    public function saveberita()
    {
        $title = $this->request->getPost('title');
        $headline = $this->request->getPost('headline');
        $deskripsi = $this->request->getPost('deskripsi');
        $kategori = $this->request->getPost('kategorimenu_id');
        $img = $this->request->getFile('image');
        $data=array();
        $img->move('./uploads/berita/');
            $data = array(
                'title'             => $title,
                'headline'          => $headline,
                'deskripsi'         => $deskripsi,
                'kategorimenu_id'   => $kategori,
                'seo'               => seo_title($title),
                'image'             => $img->getName()
            );

        $result = $this->beritamodel->insertberita($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updateberita()
    {
        $title = $this->request->getPost('title');
        $headline = $this->request->getPost('headline');
        $deskripsi = $this->request->getPost('deskripsi');
        $kategori = $this->request->getPost('kategorimenu_id');
        $img = $this->request->getFile('image');
        $data=array();
        if ($img != null) {
            $img->move('./uploads/galeri/');
            $data = array(
                'title'             => $title,
                'headline'          => $headline,
                'deskripsi'         => $deskripsi,
                'kategorimenu_id'   => $kategori,
                'seo'               => seo_title($title),
                'image'             => $img->getName()
            );
        }else{
            $data = array(
                'title'             => $title,
                'headline'          => $headline,
                'deskripsi'         => $deskripsi,
                'kategorimenu_id'   => $kategori,
                'seo'               => seo_title($title)
            );
        }
        
        $id = $this->request->getPost('id');
        $result = $this->beritamodel->updateberita($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedberita()
    {

        $where =  $this->request->getPost('id');
        $imageid = $this->beritamodel->getberitabyid($where);
        $path = './uploads/berita/';
        @unlink($path.$imageid['image']);
        $result = $this->beritamodel->deletedberita($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    //videos
    public function videos()
    {
        $data=[
            'title'     => 'Videos',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Videos',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/videos/video',$data);
    }

    public function getvideos()
    {  
        $columns = array(
            0=>'_id', 
            1=>'title'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->videosmodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->videosmodel->allvideos($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->videosmodel->videos_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->videosmodel->videos_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $video)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $video->_id;
            $nestedData['title'] = $video->title;
            $nestedData['uri'] = $video->uri;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addvideo()
    {
        $data=[
            'title'     => 'Tambah Data Video',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Video',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/videos/addvideo',$data);
    }

    public function editvideo($id)
    {
        $data=[
            'title'     => 'Edit Data Video',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Video',
            'profil'    => $this->session->get('user'),
            'video'     => $this->videosmodel->getvideobyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/videos/editvideo',$data);
    }

    public function savevideo()
    {
        $title = $this->request->getPost('title');
        $uri = $this->request->getPost('uri');
        $data=array();
        $data = array(
            'title'         => $title,
            'uri'           => $uri
        );
        $result = $this->videosmodel->insertvideo($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatevideo()
    {
        $title = $this->request->getPost('title');
        $uri = $this->request->getPost('uri');
        $data=array();
        $data = array(
            'title'         => $title,
            'uri'           => $uri
        );
        $id = $this->request->getPost('id');
        $result = $this->videosmodel->updatevideo($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedvideo()
    {
        $where =  $this->request->getPost('id');
        $result = $this->videosmodel->deletedvideo($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    //Data survei

    public function survei()
    {
        $data=[
            'title'     => 'Data Survei Kabupaten Pandeglang',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Data Survei Tenaga Kerja',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
        $data['css_files'][] = base_url('template/plugins/bootstrap_date_time/css/bootstrap-datetimepicker.min.css');
        $data['css_files'][] = base_url('template/plugins/daterangepicker/daterangepicker-bs3.css');
        $data['css_files'][] = base_url('template/easyui/themes/icon.css');
        $data['js_files'][] = base_url('template/easyui/jquery.easyui.min.js');
        $data['js_files'][] = base_url('template/easyui/datagrid-groupview.js');
        $data['js_files'][] = base_url('template/easyui/jquery.texteditor.js');
        $data['js_files'][] = base_url('template/easyui/plugins/datagrid-scrollview.js');
        $data['js_files'][] = base_url('template/plugins/bootstrap_date_time/js/bootstrap-datetimepicker.min.js');
        $data['js_files'][] = base_url('template/plugins/bootstrap_date_time/js/locales/bootstrap-datetimepicker.id.js');
        $data['js_files'][] = base_url('template/easyui/moment.js');
        $data['js_files'][] = base_url('template/plugins/daterangepicker/daterangepicker.js');
        $data['js_files'][] = 'https://code.highcharts.com/highcharts.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/data.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/drilldown.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/accessibility.js';
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/lihatsurvei/viewsurvei',$data);
    }

    public function getsurvei()
    {  
        $columns = array(
            0=>'_id', 
            1=>'idkategorisurvei',
            2=>'idnmsurvei',
            3=>'idinput',
            4=>'idsubinput',
            5=>'jumlah',
            6=>'tgl_survei',
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->surveimodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->surveimodel->allsurvei($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->surveimodel->survei_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->surveimodel->survei_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $survei)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $survei->_id;
            $nestedData['idkategorisurvei'] = $survei->idkategorisurvei;
            $nestedData['idnmsurvei'] = $survei->idnmsurvei;
            $nestedData['idinput'] = $survei->idinput;
            $nestedData['idsubinput'] = $survei->idsubinput;
            $nestedData['kt_survei'] = $survei->kt_survei;
            $nestedData['nm_survei'] = $survei->nm_survei;
            $nestedData['nm_input'] = $survei->nm_input;
            $nestedData['nm_subinput'] = $survei->nm_subinput;
            $nestedData['jumlah'] = $survei->jumlah;
            $nestedData['tgl_survei'] = $survei->tgl_survei;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    // public function getchartsurveipendidikan()
    // {
    //     $start=$this->request->getPost('start');
    //     $end=$this->request->getPost('end');
    //     $res=$this->surveimodel->getchartsurveipendidikan($start,$end);
    //     $data=array();
    //     $datasub=array();
    //     $total=0;
    //     foreach ($res as $row) {
    //         $ress=$this->surveimodel->getchartsurveidetailpendidikan($start,$end, $row->idpendidikan);
    //         $datasub1=array();
    //         foreach ($ress as $r) {
    //             $total=(float)$row->sumpria+(float)$row->sumperempuan;
    //             $datasub1=[
    //                 array("Pria", (float)$r->sumpria),
    //                 array("Perempuan", (float)$r->sumperempuan),
    //             ];
    //         }
    //         $total=$total+((float)$row->sumpria+(float)$row->sumperempuan);
    //         $data[] = array(
    //                 'name'  => $row->pendidikan,
    //                 'y'     => (float)$row->sumpria+(float)$row->sumperempuan,
    //                 'drilldown' => $row->pendidikan
    //             );
    //         $datasub[] = array(
    //             'name'  => $row->pendidikan,
    //             'id'    => $row->pendidikan,
    //             'data'  => $datasub1
    //         );
    //     }

    //     $output=[
    //             'chart' => $data,
    //             'drilldown' => $datasub,
    //             'total' => $total
    //         ];
    //     $result = $this->response->setJSON($output);
    //     return $result;
    // }

    // public function getchartsurveiusia()
    // {
    //     $start=$this->request->getPost('start');
    //     $end=$this->request->getPost('end');
    //     $res=$this->surveimodel->getchartsurveiusia($start,$end);
    //     $data=array();
    //     $datasub=array();
    //     $total=0;
    //     foreach ($res as $row) {
    //         $ress=$this->surveimodel->getchartsurveidetailusia($start,$end, $row->idusia);
    //         $datasub1=array();
    //         foreach ($ress as $r) {
    //             $total=(float)$row->sumpria+(float)$row->sumperempuan;
    //             $datasub1=[
    //                 array("Jumlah Pria", (float)$r->sumpria),
    //                 array("Jumlah Perempuan", (float)$r->sumperempuan),
    //             ];
    //         }
    //         $total=$total+((float)$row->sumpria+(float)$row->sumperempuan);
    //         $data[] = array(
    //                 'name'  => $row->usia.' Tahun',
    //                 'y'     => (float)$row->sumpria+(float)$row->sumperempuan,
    //                 'drilldown' => $row->usia
    //             );
    //         $datasub[] = array(
    //             'name'  => $row->usia,
    //             'id'    => $row->usia,
    //             'data'  => $datasub1
    //         );
    //     }

    //     $output=[
    //             'chart' => $data,
    //             'drilldown' => $datasub,
    //             'total' => $total
    //         ];
    //     $result = $this->response->setJSON($output);
    //     return $result;
    // }

    // input survei
    public function datasurvei()
    {
        $data=[
            'title'     => 'Data Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Formulir Survei Pendidikan',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/survei/survei',$data);
    }

    public function getdatasurvei()
    {
        $columns = array(
            0=>'_id', 
            1=>'kt_survei'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->kategorisurveimodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->kategorisurveimodel->allkategorisurvei($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->kategorisurveimodel->kategorisurvei_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->kategorisurveimodel->kategorisurvei_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $row)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $row->_id;
            $nestedData['kt_survei'] = $row->kt_survei;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function comboinput()
    {
        $id=$this->request->getPost('id');
        $nama = isset($_GET['term']) ? strval($_GET['term']) : '';
        $data=$this->inputmodel->getcomboinputs($id);
        $arr=array();
        foreach ($data as $row) {
            $arr[]=array(
                    'id'    => $row['_id'],
                    'text'  => $row['nm_input']
                );
        }
        $output = array(
                'result'    => $arr
            );
        $result = $this->response->setJSON($output);
        return $result;
    }

    public function combosubinput()
    {
        $id=$this->request->getPost('id');
        $nama = isset($_GET['term']) ? strval($_GET['term']) : '';
        $data=$this->subinputmodel->getcombosubinputs($id);
        $arr=array();
        foreach ($data as $row) {
            $arr[]=array(
                    'id'    => $row['_id'],
                    'text'  => $row['nm_subinput']
                );
        }
        $output = array(
                'result'    => $arr
            );
        $result = $this->response->setJSON($output);
        return $result;
    }

    public function inputsurvei($id)
    {
        $data=[
            'title'     => 'Formulir Survei'. $this->kategorisurveimodel->getkategorisurveibyid($id)['kt_survei'],
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Formulir Survei Pendidikan',
            'profil'    => $this->session->get('user'),
            'id' => $id
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['nmsurvei'] = $this->namasurveimodel->getcombonamasurvei();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['css_files'][] = base_url('template/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');
        $data['js_files'][] = base_url('template/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');

        $data['css_files'][] = base_url('template/vendors/bootstrap_date_time/css/bootstrap-datetimepicker.min.css');
        $data['js_files'][] = base_url('template/vendors/bootstrap_date_time/js/bootstrap-datetimepicker.min.js');

        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/survei/inputsurvei',$data);
    }

    public function savesurvei()
    {

        $idkategorisurvei = $this->request->getPost('id');
        $idnmsurvei = $this->request->getPost('idnmsurvei');
        $idinput = $this->request->getPost('idinput');
        $idsubinput = $this->request->getPost('idsubinput');
        $jumlah = $this->request->getPost('jumlah');
        $tgl_survei = $this->request->getPost('tgl_survei');

        $data=array();
        $data = array(
            'idkategorisurvei' => $idkategorisurvei,
            'idnmsurvei' => $idnmsurvei,
            'idinput' => $idinput,
            'idsubinput' => $idsubinput,
            'jumlah' => $jumlah,
            'tgl_survei' => $tgl_survei
        );

        $result = $this->surveimodel->insertsurvei($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    // Kategori Berita
    public function kategorisurvei()
    {
        $data=[
            'title'     => 'Kategori Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Kategori Survei',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/kategorisurvei/kategorisurvei',$data);
    }

    public function getkategorisurvei()
    {
        $columns = array(
            0=>'_id', 
            1=>'kt_survei'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->kategorisurveimodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->kategorisurveimodel->allkategorisurvei($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->kategorisurveimodel->kategorisurvei_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->kategorisurveimodel->kategorisurvei_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $row)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $row->_id;
            $nestedData['kt_survei'] = $row->kt_survei;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addkategorisurvei()
    {
        $data=[
            'title'     => 'Tambah Data Kategori Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Kategori',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategorisurvei/addkategorisurvei',$data);
    }

    public function editkategorisurvei($id)
    {
        $data=[
            'title'     => 'Edit Data Kategori Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Kategori',
            'profil'    => $this->session->get('user'),
            'kategori'  => $this->kategorisurveimodel->getkategorisurveibyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategorisurvei/editkategorisurvei',$data);
    }

    public function savekategorisurvei()
    {
        $kt_survei = $this->request->getPost('kt_survei');
        $data=array();
            $data = array(
                'kt_survei'         => $kt_survei
            );

        $result = $this->kategorisurveimodel->insertkategorisurvei($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatekategorisurvei()
    {
        $kt_survei = $this->request->getPost('kt_survei');
        $data=array();
        $data = array(
            'kt_survei'    => $kt_survei
        );
        
        $id = $this->request->getPost('id');
        $result = $this->kategorisurveimodel->updatekategorisurvei($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedkategorisurvei()
    {

        $where =  $this->request->getPost('id');
        $result = $this->kategorisurveimodel->deletekategorisurvei($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    // Nama Survei
    public function namasurvei()
    {
        $data=[
            'title'     => 'Nama Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Kategori Survei',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/namasurvei/namasurvei',$data);
    }

    public function getnamasurvei()
    {
        $columns = array(
            0=>'_id', 
            1=>'nm_survei'
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->namasurveimodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->namasurveimodel->allnamasurvei($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->namasurveimodel->namasurvei_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->namasurveimodel->namasurvei_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $row)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $row->_id;
            $nestedData['nm_survei'] = $row->nm_survei;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addnamasurvei()
    {
        $data=[
            'title'     => 'Tambah Data Nama Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Nama Survei',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/namasurvei/addnamasurvei',$data);
    }

    public function editnamasurvei($id)
    {
        $data=[
            'title'     => 'Edit Data Nama Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Nama Survei',
            'profil'    => $this->session->get('user'),
            'nama'      => $this->namasurveimodel->getnamasurveibyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/namasurvei/editnamasurvei',$data);
    }

    public function savenamasurvei()
    {
        $nm_survei = $this->request->getPost('nm_survei');
        $data=array();
            $data = array(
                'nm_survei'         => $nm_survei
            );

        $result = $this->namasurveimodel->insertnamasurvei($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatenamasurvei()
    {
        $nm_survei = $this->request->getPost('nm_survei');
        $data=array();
        $data = array(
            'nm_survei'    => $nm_survei
        );
        
        $id = $this->request->getPost('id');
        $result = $this->namasurveimodel->updatenamasurvei($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletednamasurvei()
    {

        $where =  $this->request->getPost('id');
        $result = $this->namasurveimodel->deletenamasurvei($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    // Nama Survei
    public function kategoriinput()
    {
        $data=[
            'title'     => 'Nama Kategori Input',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Kategori Input',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/kategoriinput/kategoriinput',$data);
    }

    public function getkategoriinput()
    {
        $columns = array(
            0=>'_id', 
            1=>'idnmsurvei',
            2=>'nm_input',
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->inputmodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->inputmodel->allinput($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->inputmodel->input_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->inputmodel->input_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $row)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $row->_id;
            $nestedData['nm_input'] = $row->nm_input;
            $nestedData['nm_survei'] = $row->nm_survei;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addkategoriinput()
    {
        $data=[
            'title'     => 'Tambah Data Kategori Input',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Kategori Input',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['nmsurvei']  = $this->namasurveimodel->getcombonamasurvei();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategoriinput/addkategoriinput',$data);
    }

    public function editkategoriinput($id)
    {
        $data=[
            'title'     => 'Edit Data Kategori Input',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Kategori Input',
            'profil'    => $this->session->get('user'),
            'input'     => $this->inputmodel->getinputbyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['nmsurvei']  = $this->namasurveimodel->getcombonamasurvei();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategoriinput/editkategoriinput',$data);
    }

    public function savekategoriinput()
    {
        $idnmsurvei = $this->request->getPost('idnmsurvei');
        $nm_input = $this->request->getPost('nm_input');
        $data=array();
            $data = array(
                'idnmsurvei'  => $idnmsurvei,
                'nm_input'    => $nm_input
            );

        $result = $this->inputmodel->insertinput($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatekategoriinput()
    {
        $idnmsurvei = $this->request->getPost('idnmsurvei');
        $nm_input = $this->request->getPost('nm_input');
        $data=array();
            $data = array(
                'idnmsurvei'  => $idnmsurvei,
                'nm_input'    => $nm_input
            );
        
        $id = $this->request->getPost('id');
        $result = $this->inputmodel->updateinput($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedkategoriinput()
    {

        $where =  $this->request->getPost('id');
        $result = $this->inputmodel->deleteinput($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    // Nama Survei
    public function kategorisubinput()
    {
        $data=[
            'title'     => 'Nama Kategori Subinput',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Kategori Subinput',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        return render('admin/kategorisubinput/kategorisubinput',$data);
    }

    public function getkategorisubinput()
    {
        $columns = array(
            0=>'_id', 
            1=>'idinput',
            2=>'nm_subinput',
        );
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir'];
        $totalData = $this->subinputmodel->countAll();

        $totalFiltered = $totalData; 

        if(empty($this->request->getPost('search')['value']))
        {            
            $list = $this->subinputmodel->allsubinput($limit,$start,$order,$dir);
        }
        else {
            $search = $this->request->getPost('search')['value']; 

            $list =  $this->subinputmodel->subinput_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->subinputmodel->subinput_search_count($search);
        }

        $data = array();
        $no=1;
        foreach ($list as $row)
        {
            $nestedData['no'] = $no++;
            $nestedData['_id'] = $row->_id;
            $nestedData['nm_input'] = $row->nm_input;
            $nestedData['nm_subinput'] = $row->nm_subinput;
            
            $data[] = $nestedData;

        }
        $output = array(
            "draw"            => intval($this->request->getpost('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        );
        return $this->response->setJSON($output);
    }

    public function addkategorisubinput()
    {
        $data=[
            'title'     => 'Tambah Data Kategori Subinput',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Tambah Data Kategori Subinput',
            'profil'    => $this->session->get('user'),
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['input']  = $this->inputmodel->getcomboinput();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategorisubinput/addkategorisubinput',$data);
    }

    public function editkategorisubinput($id)
    {
        $data=[
            'title'     => 'Edit Data Kategori Subinput',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Edit Data Kategori Subinput',
            'profil'    => $this->session->get('user'),
            'subinput'  => $this->subinputmodel->getsubinputbyid($id)
        ];
        $data['menus']  = $this->menus->getmenus($this->sess_id);
        $data['input']  = $this->inputmodel->getcomboinput();
        $data['css_files'][] = base_url('template/vendors/DataTables/datatables.min.css');
        $data['css_files'][] = base_url('template/vendors/select2/dist/css/select2.css');
        $data['js_files'][] = base_url('template/vendors/select2/dist/js/select2.full.min.js');
        $data['js_files'][] = base_url('template/vendors/DataTables/datatables.min.js');
        $data['js_files'][] = base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');
        return render('admin/kategorisubinput/editkategorisubinput',$data);
    }

    public function savekategorisubinput()
    {
        $idinput = $this->request->getPost('idinput');
        $nm_subinput = $this->request->getPost('nm_subinput');
        $data=array();
            $data = array(
                'idinput'  => $idinput,
                'nm_subinput'  => $nm_subinput
            );

        $result = $this->subinputmodel->insertsubinput($data);
        if ($result){
            echo json_encode(array('message'=>'Save Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function updatekategorisubinput()
    {
        $idinput = $this->request->getPost('idinput');
        $nm_subinput = $this->request->getPost('nm_subinput');
        $data=array();
            $data = array(
                'idinput'  => $idinput,
                'nm_subinput'  => $nm_subinput
            );
        
        $id = $this->request->getPost('id');
        $result = $this->subinputmodel->updatesubinput($id, $data);
        if ($result){
            echo json_encode(array('message'=>'Update Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function deletedkategorisubinput()
    {

        $where =  $this->request->getPost('id');
        $result = $this->subinputmodel->deletesubinput($where);
        if ($result){
            echo json_encode(array('message'=>'Deleted Success'));
        } else {
            echo json_encode(array('errorMsg'=>'Some errors occured.'));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}