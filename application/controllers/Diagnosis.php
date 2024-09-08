<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosis extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        // $this->load->library('datatables');
        $this->load->model('Sidebar_model', 'sidebar');
        $this->load->model('Diagnosis_model', 'diag_model');
        $this->load->model('Time_model', 'time');
        // Get data 'user'
        $this->data = array(
            "user" => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        );
        // Get session 'role_id'
        $this->role = $this->session->userdata('role_id');
    }

    // ====================================================== DATA PENYAKIT ======================================================
    public function index()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Data Penyakit';
        // Active Sidebar
        $data['sidebar'] = 'Data Penyakit';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diagnosis/data_penyakit', $data);
        $this->load->view('templates/footer');
    }
    function loadDataPenyakit()
    {
        $results = $this->diag_model->getDataTable_penyakit();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = $result->nama_penyakit;
            $row[] = nl2br($result->detail_penyakit);
            $row[] = nl2br($result->saran_penyakit);
            $row[] = $this->time->getTimeAgo($result->terakhir_diubah);
            $row[] = '
                <div class="d-flex">
                    <a class="btn btn-outline-primary me-1" onclick="funcUpdateData(' . "'" . $result->id . "', 'edit'" . ')"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-outline-danger" onclick="funcUpdateData(' . "'" . $result->id . "', 'hapus'" . ')"><i class="fas fa-trash"></i></a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->diag_model->countAllAData_penyakit(),
            "recordsFiltered" => $this->diag_model->countFilteredData_penyakit(),
            "data" => $data,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    function tambahDataPenyakit()
    {
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'nama_penyakit' => trim(htmlspecialchars($this->input->post('nama_penyakit'))),
            'detail_penyakit' => trim(htmlspecialchars($this->input->post('detail_penyakit'))),
            'saran_penyakit' => trim(htmlspecialchars($this->input->post('saran_penyakit'))),
            'terakhir_diubah' => $now,
            'is_active' => '★',
        ];
        // if ($this->diag_model->addDataPenyakit($data) > 0) {
        //     $resp['status'] = 'success';
        // } else {
        //     $resp['status'] = 'failed';
        // }
        $this->db->trans_start();
        $this->db->insert('data_penyakit', $data);
        $auto_increment_val = $this->db->insert_id();
        $this->db->trans_complete();

        // Init gambar_penyakit
        $image = @$this->input->post('image');

        // Manage Data Gambar
        if ($image == 'null' || $image == null) {
            $filename = 'gambar_penyakit_default.png';
        } else {
            $image_array = explode(";", $image);
            $image_array_1 = explode(",", $image_array[1]);
            $image = base64_decode($image_array_1[1]);
            $time = time();
            $imageName = FCPATH . 'assets/img/penyakit/' . $auto_increment_val . '-' . $time . '.png';
            $filename = $auto_increment_val . '-' . $time . '.png';
            file_put_contents($imageName, $image);
        }

        //Insert ke Dbs
        $this->db->set('img_penyakit', $filename);
        $this->db->where('id', $auto_increment_val);
        $this->db->update('data_penyakit');
        $resp['status'] = 'success';

        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function loadDataPenyakitByID($id)
    {
        $data = $this->diag_model->getDataPenyakitById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    function ubahDataPenyakit()
    {
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'nama_penyakit' => trim(htmlspecialchars($this->input->post('nama_penyakit'))),
            'detail_penyakit' => trim(htmlspecialchars($this->input->post('detail_penyakit'))),
            'saran_penyakit' => trim(htmlspecialchars($this->input->post('saran_penyakit'))),
            'terakhir_diubah' => $now,
        ];
        if ($this->diag_model->editDataPenyakit(array('id' => $this->input->post('id')), $data) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
        }

        // Get Post Data
        $id = $this->input->post('id');
        $image = @$this->input->post('image');
        $imageOld = @$this->input->post('oldImage');

        // Manage Data Gambar
        if ($image != '' || $image != null) {
            $resp['status'] = 'failed';

            $image_array = explode(";", $image);
            $image_array_1 = explode(",", $image_array[1]);
            $image = base64_decode($image_array_1[1]);
            $time = time();
            $imageName = FCPATH . 'assets/img/penyakit/' . $id . '-' . $time . '.png';

            //Insert ke Dbs
            if (file_exists(FCPATH . 'assets/img/penyakit/' . $imageOld) && $imageOld != 'default.png') {
                unlink(FCPATH . 'assets/img/penyakit/' . $imageOld);
            }
            $filename = $id . '-' . $time . '.png';
            file_put_contents($imageName, $image);
            $this->db->set('img_penyakit', $filename);
            $this->db->where('id', $id);
            $this->db->update('data_penyakit');

            $resp['status'] = 'success';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function hapusDataPenyakit($id)
    {
        if ($this->diag_model->deleteDataPenyakit($id) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function cekValidatePenyakit()
    {
        $remote = "false";

        // Get Post Data
        $np = trim(htmlspecialchars($this->input->post('nama_penyakit')));
        $sd = $this->input->post('simpanData');
        $data_np = $this->input->post('data_namaPenyakit');

        // Set kondisi
        if ($sd == 'tambah') {
            if ($this->diag_model->validateNamaPenyakit($np) <= 0) {
                $remote = 'true';
            }
        } else if ($sd == 'edit') {
            if (strtolower($np) === strtolower($data_np)) {
                $remote = 'true';
            } else {
                if ($this->diag_model->validateNamaPenyakit($np) <= 0) {
                    $remote = 'true';
                }
            }
        }
        echo $remote;
    }


    // ====================================================== DATA GEJALA ======================================================
    public function data_gejala()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Data Gejala';
        // Active Sidebar
        $data['sidebar'] = 'Data Gejala';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diagnosis/data_gejala', $data);
        $this->load->view('templates/footer');
    }
    function loadDataGejala()
    {
        $results = $this->diag_model->getDataTable_gejala();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = nl2br($result->nama_gejala);
            $row[] = $this->time->getTimeAgo($result->terakhir_diubah);
            $row[] = '
                <div class="d-flex">
                    <a class="btn btn-outline-primary me-1" onclick="funcUpdateData(' . "'" . $result->id . "', 'edit'" . ')"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-outline-danger" onclick="funcUpdateData(' . "'" . $result->id . "', 'hapus'" . ')"><i class="fas fa-trash"></i></a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->diag_model->countAllAData_gejala(),
            "recordsFiltered" => $this->diag_model->countFilteredData_gejala(),
            "data" => $data,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    function tambahDataGejala()
    {
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'nama_gejala' => trim(htmlspecialchars($this->input->post('nama_gejala'))),
            'terakhir_diubah' => $now,
            'is_active' => '★',
        ];
        if ($this->diag_model->addDataGejala($data) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function loadDataGejalaByID($id)
    {
        $data = $this->diag_model->getDataGejalaById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    function ubahDataGejala()
    {
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'nama_gejala' => trim(htmlspecialchars($this->input->post('nama_gejala'))),
            'terakhir_diubah' => $now,
        ];
        if ($this->diag_model->editDataGejala(array('id' => $this->input->post('id')), $data) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function hapusDataGejala($id)
    {
        if ($this->diag_model->deleteDataGejala($id) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function cekValidateGejala()
    {
        $remote = "false";

        // Get Post Data
        $ng = trim(htmlspecialchars($this->input->post('nama_gejala')));
        $sd = $this->input->post('simpanData');
        $data_np = $this->input->post('data_namaGejala');

        // Set kondisi
        if ($sd == 'tambah') {
            if ($this->diag_model->validateNamaGejala($ng) <= 0) {
                $remote = 'true';
            }
        } else if ($sd == 'edit') {
            if (strtolower($ng) === strtolower($data_np)) {
                $remote = 'true';
            } else {
                if ($this->diag_model->validateNamaGejala($ng) <= 0) {
                    $remote = 'true';
                }
            }
        }
        echo $remote;
    }


    // ====================================================== DATA ATURAN ======================================================
    public function data_aturan()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Data Aturan';
        // Active Sidebar
        $data['sidebar'] = 'Data Aturan';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diagnosis/data_aturan', $data);
        $this->load->view('templates/footer');
    }
    function loadDataAturan()
    {
        $results = $this->diag_model->getDataTable_aturan();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = $result->nama_penyakit;
            $row[] = $result->nama_gejala;
            $row[] = $result->mb;
            $row[] = $result->md;
            $row[] = $this->time->getTimeAgo($result->td_aturan);
            $row[] = '
                <div class="d-flex">
                    <a class="btn btn-outline-primary me-1" onclick="funcUpdateData(' . "'" . $result->id_aturan . "', 'edit'" . ')"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-outline-danger" onclick="funcUpdateData(' . "'" . $result->id_aturan . "', 'hapus'" . ')"><i class="fas fa-trash"></i></a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->diag_model->countAllAData_aturan(),
            "recordsFiltered" => $this->diag_model->countFilteredData_aturan(),
            "data" => $data,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    function loadDataChoices()
    {
        $data = $this->diag_model->loadDataChoices();
        // var_dump($data);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    function loadDataChoices2()
    {
        $active_id_penyakit = $this->input->post('active_id_penyakit');
        $id_penyakit = $this->input->post('id_penyakit');
        $id_aturan = $this->input->post('id_aturan');
        $data = $this->diag_model->loadDataChoices2($id_aturan, $id_penyakit, $active_id_penyakit);
        // var_dump($data);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    function cekKombinasiAturan()
    {
        $id_penyakit = $this->input->post('choices_penyakit');
        $id_gejala = $this->input->post('choices_gejala');
        $result = $this->diag_model->cekKombinasiAturan($id_penyakit, $id_gejala);
        $this->output->set_content_type('application/json')->set_output(json_encode(['num_rows' => $result['num_rows'], 'row_array' => $result['row_array']]));
    }
    function tambahDataAturan()
    {
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'id_penyakit' => ($this->input->post('choices_penyakit')),
            'id_gejala' => ($this->input->post('choices_gejala')),
            'mb' => ($this->input->post('choices_mb')),
            'md' => ($this->input->post('choices_md')),
            'terakhir_diubah' => $now,
        ];
        if ($this->diag_model->addDataAturan($data) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function loadDataAturanByID($id)
    {
        $data = $this->diag_model->getDataAturanById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    function ubahDataAturan()
    {
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'id_penyakit' => $this->input->post('choices_penyakit'),
            'id_gejala' => $this->input->post('choices_gejala'),
            'mb' => $this->input->post('choices_mb'),
            'md' => $this->input->post('choices_md'),
            'terakhir_diubah' => $now,
        ];
        if ($this->diag_model->editDataAturan(array('id' => $this->input->post('id')), $data) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed_ubah';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function hapusDataAturan($id)
    {
        if ($this->diag_model->deleteDataAturan($id) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'failed';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }



    // ====================================================== DATA ARTIKEL ======================================================\
    public function data_artikel()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Data Artikel';
        // Active Sidebar
        $data['sidebar'] = 'Data Artikel';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('diagnosis/data_artikel', $data);
        $this->load->view('templates/footer');
    }
    function loadDataArtikel()
    {
        $results = $this->diag_model->getDataTable_artikel();
        $data = [];
        $no = @$_POST['start'];
        foreach ($results as $result) {
            $row = array();
            $row[] = ++$no;
            $row[] = nl2br($result->nama_post);
            $row[] = $this->time->getTimeAgo($result->terakhir_diubah);
            $row[] = '
                <div class="d-flex">
                    <a class="btn btn-outline-primary me-1" onclick="funcUpdateData(' . "'" . $result->id . "', 'edit'" . ')"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-outline-danger" onclick="funcUpdateData(' . "'" . $result->id . "', 'hapus'" . ')"><i class="fas fa-trash"></i></a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->diag_model->countAllAData_artikel(),
            "recordsFiltered" => $this->diag_model->countFilteredData_artikel(),
            "data" => $data,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    function loadDataArtikelByName()
    {
        $nama_post = @$this->input->post('nama_post');
        $id = @$this->input->post('id_artikel');
        $dataPost = $this->diag_model->loadDataArtikelByName($nama_post);
        $resp['data_post'] = $dataPost['data_post'];
        $resp['num_rows'] = $dataPost['num_rows'];
        $resp['nama_artikel'] = null;
        if ($id != '' || $id != null) {
            $data = $this->diag_model->loadDataArtikelById($id);
            $resp['nama_artikel'] = $data->nama_post;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function loadDataArtikelByID()
    {
        $id = @$this->input->post('id_artikel');
        $resp['data'] = $this->diag_model->loadDataArtikelById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function tambahDataArtikel()
    {
        $now = date('Y-m-d H:i:s', time());
        $data = [
            'nama_post' => (@$this->input->post('nama_post')),
            // 'img_thumbnail' => (@$this->input->post('img_thumbnail')),
            'terakhir_diubah' => $now,
        ];
        $query = $this->diag_model->addDataArtikel($data);
        $ai_val = $query['auto_increment_val'];
        $resp['auto_increment_val'] = $ai_val;


        // Get Data Img Thumb Artikel By ID
        $getDataArtikel = $this->diag_model->loadDataArtikelById($ai_val);
        $imgThumbOld = $getDataArtikel->img_thumbnail;

        // Manage Data Gambar
        $image = @$this->input->post('image');

        if ($image == 'null' || $image == null) {
            $filename = 'gambar_penyakit_default.png';
        } else {
            $image_array = explode(";", $image);
            $image_array_1 = explode(",", $image_array[1]);
            $image = base64_decode($image_array_1[1]);
            $time = time();
            $imageName = FCPATH . 'assets/img/artikel_thumbnail/' . $ai_val . '-' . $time . '.png';
            $filename = $ai_val . '-' . $time . '.png';
            file_put_contents($imageName, $image);
        }
        if (file_exists(FCPATH . 'assets/img/artikel_thumbnail/' . $imgThumbOld) && $imgThumbOld != 'gambar_penyakit_default.png' && $imgThumbOld != null && $imgThumbOld != '') {
            unlink(FCPATH . 'assets/img/artikel_thumbnail/' . $imgThumbOld);
        }
        $this->db->set('img_thumbnail', $filename);
        $this->db->where('id', $ai_val);
        $this->db->update('data_artikel');
        $resp['status'] = 'success';

        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    function tambahDataArtikel_fase2()
    {
        $id_artikel = @$this->input->post('id_artikel');
        $nama_post = @$this->input->post('nama_post');
        //detail post
        $d_post = @$this->input->post('detail_post');
        $d_base64;
        $d_base64 = @$this->input->post('arrBase64_detail');
        $d_nameImg = @$this->input->post('arrNameImg_detail');
        //saran post
        $s_post = @$this->input->post('saran_post');
        $s_base64;
        $s_base64 = @$this->input->post('arrBase64_saran');
        $s_nameImg = @$this->input->post('arrNameImg_saran');
        // Masukkan ke 1 var data
        $data = [
            'id_artikel' =>  $id_artikel,
            'nama_post' =>  $nama_post,
            'd_post' =>  $d_post,
            'd_base64' =>  $d_base64,
            'd_nameImg' =>  $d_nameImg,
            's_post' =>  $s_post,
            's_base64' =>  $s_base64,
            's_nameImg' =>  $s_nameImg,
        ];

        // Insert gambar ke dir
        if (is_countable($d_base64) && count($d_base64) > 0) {
            for ($x = 0; $x < count($d_base64); $x++) {
                $image = base64_decode($d_base64[$x]);
                $imageName = FCPATH . 'assets/img/artikel_quill/' . $d_nameImg[$x];
                file_put_contents($imageName, $image);
            }
        }
        if (is_countable($s_base64) && count($s_base64) > 0) {
            for ($x = 0; $x < count($s_base64); $x++) {
                $image = base64_decode($s_base64[$x]);
                $imageName = FCPATH . 'assets/img/artikel_quill/' . $s_nameImg[$x];
                file_put_contents($imageName, $image);
            }
        }

        //Simpan post ke Dbs
        $query = $this->diag_model->addDataArtikel_fase2($data);
        if (@$query['trans_update'] == TRUE) {
            $resp['status_1'] = 'success';
        } else {
            $resp['status_1'] = 'Gagal update.';
        }
        if (@$query['trans_hapus'] == TRUE) {
            $resp['status_2'] = 'success';
        } else {
            $resp['status_2'] = 'Gagal hapus gambar artikel lama dari dir.';
        }
        if (@$query['trans_d'] == TRUE) {
            $resp['status_3'] = 'success';
        } else {
            $resp['status_3'] = 'Gagal menambahkan foto detail post ke dbs.';
        }
        if (@$query['trans_s'] == TRUE) {
            $resp['status_4'] = 'success';
        } else {
            $resp['status_4'] = 'Gagal menambahkan foto saran post ke dbs.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
}
