<?php namespace App\Controllers;

use App\Controllers\Menuweb;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\I18n\Time;

class Website extends BaseController
{
	protected $baseUrl;
    
	public function __construct()
    {
    	$this->security = \Config\Services::security();
        $this->baseUrl = base_url();
        $this->menus = new Menuweb();

        $this->videosmodel = model('App\Models\Videos_model',false);
        $this->beritamodel = model('App\Models\Berita_model',false);
        $this->halamanmodel = model('App\Models\Halaman_model',false);
        $this->gallerimodel = model('App\Models\Galeri_model',false);
        $this->pelaporanmodel = model('App\Models\Pelaporan_model',false);
        $this->surveimodel = model('App\Models\Survei_model',false);
        $this->menu = model('App\Models\Berita_model',false);
        helper(['url','fatih']);
    }

    public function index()
    {
    	$data=[
            'title'     => 'Home Website',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Home', 
            'video'     => $this->videosmodel->webvideos(),
            'berita'    => $this->beritamodel->webberita()
        ];
        $data['css_files'][] = "";
        $data['js_files'][] = "";
        $data['menus']  = $this->menus->getmenus();
        return renderweb('website/home',$data); 
    }

    public function profil($id)
    {
        $data=[
            'title'     => 'Halaman Profil',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Halaman Profil Dinas',
            'profil'    => $this->halamanmodel->webprofil(),
            'detail'    => $this->halamanmodel->webprofildetail($id)
        ];
        $data['css_files'][] = "";
        $data['js_files'][] = "";
        $data['menus']  = $this->menus->getmenus();
        return renderweb('website/profil/profil',$data);
    }

    public function berita()
    {
        $data=[
            'title'     => 'Halaman Berita',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Halaman Berita',
            'popular'   => $this->beritamodel->webberita(),
            'berita'    => $this->beritamodel->paginate(4, 'berita'),
            'pager'     => $this->beritamodel->pager
        ];
        $data['css_files'][] = "";
        $data['js_files'][] = "";
        $data['menus']  = $this->menus->getmenus();
        return renderweb('website/berita/berita',$data); 
    }

    public function beritadetail($id)
    {
        $data=[
            'title'     => 'Halaman Berita',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Halaman Berita',
            'detail'    => $this->beritamodel->getdetailberita($id),
            'berita'    => $this->beritamodel->webberita()
        ];
        $data['css_files'][] = "";
        $data['js_files'][] = "";
        $data['menus']  = $this->menus->getmenus();
        return renderweb('website/berita/detailberita',$data); 
    }

    public function statistik()
    {
        $data=[
            'title'     => 'Halaman Data Statistik Survei',
            'apps'      => 'SISTEM INFORMASI GENDER DAN ANAK DI BANTEN .::. Halaman Statistik Survei',
        ];
        $data['css_files'][] = base_url('template/easyui/themes/metro/easyui.css');
        $data['css_files'][] = base_url('template/vendors/bootstrap/dist/css/bootstrap.min.css');;
        $data['css_files'][] = base_url('template/plugins/bootstrap_date_time/css/bootstrap-datetimepicker.min.css');
        $data['css_files'][] = base_url('template/plugins/daterangepicker/daterangepicker-bs3.css');
        $data['css_files'][] = base_url('template/easyui/themes/icon.css');
        $data['css_files'][] = base_url('template/css/main.css');
        $data['js_files'][] = base_url('template/vendors/jquery/dist/jquery.min.js');
        $data['js_files'][] = base_url('template/plugins/bootstrap_date_time/js/bootstrap-datetimepicker.min.js');
        $data['js_files'][] = base_url('template/plugins/bootstrap_date_time/js/locales/bootstrap-datetimepicker.id.js');
        $data['js_files'][] = base_url('template/easyui/moment.js');
        $data['js_files'][] = base_url('template/plugins/daterangepicker/daterangepicker.js');
        $data['js_files'][] = 'https://code.highcharts.com/highcharts.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/data.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/drilldown.js';
        $data['js_files'][] = 'https://code.highcharts.com/modules/accessibility.js';
        $data['menus']  = $this->menus->getmenus();
        return renderweb('website/statistik/statistik',$data);
    }

    public function getchartsurveiweb()
    {
        $data=array();
        $datasub=array();
        $total=0;
        $res=$this->surveimodel->getchartsurveiweb();
        foreach ($res as $row) {
            $res=$this->surveimodel->getchartsurveidetailweb($row->idkategorisurvei);
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

    // public function getchartsurveiusiaweb()
    // {
    //     $res=$this->surveimodel->getchartsurveiusiaweb();
    //     $data=array();
    //     $datasub=array();
    //     $total=0;
    //     foreach ($res as $row) {
    //         $ress=$this->surveimodel->getchartsurveidetailusiaweb($row->idusia);
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

    // public function getchartsurveikerjaweb()
    // {
    //     $res=$this->surveimodel->getchartsurveikerjaweb();
    //     $data=array();
    //     $datasub=array();
    //     $total=0;
    //     foreach ($res as $row) {
    //         $ress=$this->surveimodel->getchartsurveidetailkerjaweb($row->idkerja);
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
    //                 'name'  => $row->kerja,
    //                 'y'     => (float)$row->sumpria+(float)$row->sumperempuan,
    //                 'drilldown' => $row->kerja
    //             );
    //         $datasub[] = array(
    //             'name'  => $row->kerja,
    //             'id'    => $row->kerja,
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
}