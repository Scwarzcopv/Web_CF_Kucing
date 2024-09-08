<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Sidebar_model', 'sidebar');
        $this->load->model('Admin_model', 'admin_model');
        $this->load->model('Time_model', 'time');
        // Get data 'user'
        $this->data = array(
            "user" => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        );
        // Get session 'role_id'
        $this->role = $this->session->userdata('role_id');
    }

    public function index()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Dashboard';
        // Active Sidebar
        $data['sidebar'] = 'Dashboard';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Total Data
        $data['total'] = $this->admin_model->total_data();

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function data_user()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Data User';
        // Active Sidebar
        $data['sidebar'] = 'Data User';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/data_user', $data);
        $this->load->view('templates/footer');
    }

    function loadDataPenyakit()
    {
        $results = $this->admin_model->getDataTable_user();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $toggle = '<i class="far fa-toggle-on"></i>';
            if ($result->is_active != 1) {
                $toggle = '<i class="far fa-toggle-off"></i>';
            }
            $row = array();
            $row[] = ++$no;
            $row[] = $result->username;
            $row[] = nl2br($result->name);
            $row[] = $result->is_active;
            $row[] = $this->time->getTimeSince($result->date_created) . '<br> (' . $this->time->getTimeAgo($result->date_created) . ')';
            $row[] = '
                <div class="d-flex">
                    <a class="toggle_' . $result->is_active . ' btn btn-outline-primary me-1" onclick="funcToggleActive(' . $result->id . ',' . $result->is_active . ',
                    ' . "'" . $result->username . "'" . ')">' . $toggle . '</a>
                    <a class="reset btn btn-outline-danger" onclick="funcResetPw(' . $result->id . ',' . "'" . $result->username . "'" . ')"><i class="fas fa-undo"></i></a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->admin_model->countAllAData_user(),
            "recordsFiltered" => $this->admin_model->countFilteredData_user(),
            "data" => $data,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    function toogleUser($id)
    {
        $output = $this->admin_model->toogleUser($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    function resetPw($id)
    {
        $jml_char = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $new_pw = '';
        for ($i = 0; $i < $jml_char; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $new_pw .= $characters[$index];
        }
        $hash_pw = password_hash($new_pw, PASSWORD_DEFAULT);

        $output['resp'] = $this->admin_model->resetPw($id, $hash_pw);
        $output['new_pw'] = $new_pw;
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function data_riwayat_user()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Data Riwayat User';
        // Active Sidebar
        $data['sidebar'] = 'Data Riwayat User';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/data_riwayat_user', $data);
        $this->load->view('templates/footer');
    }

    private function _prosesLoadDTRiwayat($results)
    {
        $data = [];
        $no = @$_POST['start'];
        foreach ($results as $result) {
            // Ini username admin || user biasa
            $role_id = $result->role_id;
            if ($role_id > 2) $username =  $result->username;
            if ($role_id < 3) $username = '<i class="fas fa-badge-check text-success"></i> ' . $result->username . '';
            // Init kode penyakit
            $id_p = (int)$result->id_p;
            if ($id_p < 1) $kode_penyakit = '<span class="text-danger">?</span>';
            else if ($id_p < 10) $kode_penyakit = 'P00' . $id_p;
            elseif ($id_p < 100) $kode_penyakit = 'P0' . $id_p;
            else $kode_penyakit = 'P' . $id_p;
            // Init nama penyakit && persentase
            $nama_penyakit = '<span class="text-danger">?</span>';
            $persentase = '<span class="text-danger">?</span>';
            if ($result->nama_penyakit != null) $nama_penyakit = $result->nama_penyakit;
            if ($result->persentase != null) $persentase = number_format($result->persentase, 2) . '%';
            // 
            $row = array();
            $row[] = ++$no;
            $row[] = $username;
            $row[] = $kode_penyakit;
            $row[] = $nama_penyakit;
            $row[] = $persentase;
            $row[] = $this->time->getTimeSince($result->date_created) . '<br> (' . $this->time->getTimeAgo($result->date_created) . ')';
            $row[] = '
                <div class="d-flex">
                    <a class="btn btn-outline-primary me-1" onclick="info(' . $result->id_r . ',
                    ' . "'" . $result->username . "'" . ',' . $result->role_id . ',' . "'" . $this->time->getTimeSince($result->date_created) . "'" . ')"><i class="fas fa-eye"></i></a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->admin_model->countAllAData_riwayat(),
            "recordsFiltered" => $this->admin_model->countFilteredData_riwayat(),
            "data" => $data,
        );
        return $output;
    }
    function loadDataRiwayat()
    {
        $results = $this->admin_model->getDataTable_riwayat(true);
        $output = $this->_prosesLoadDTRiwayat($results);
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
    function loadDataRiwayat_filter()
    {
        $results = $this->admin_model->getDataTable_riwayat(false);
        $output = $this->_prosesLoadDTRiwayat($results);
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }








    private function _prosesLoadDTRiwayat_Testing($results)
    {
        $data = [];
        $no = @$_POST['start'];
        foreach ($results as $result) {
            // Ini username admin || user biasa
            $role_id = $result->role_id;
            if ($role_id > 2) $username =  $result->username;
            if ($role_id < 3) $username = '<i class="fas fa-badge-check text-success"></i> ' . $result->username . '';
            // Init kode penyakit
            $id_p = (int)$result->id_p;
            if ($id_p < 1) $kode_penyakit = '<span class="text-danger">?</span>';
            else if ($id_p < 10) $kode_penyakit = 'P00' . $id_p;
            elseif ($id_p < 100) $kode_penyakit = 'P0' . $id_p;
            else $kode_penyakit = 'P' . $id_p;
            // Init nama penyakit && persentase
            $nama_penyakit = '<span class="text-danger">?</span>';
            $persentase = '<span class="text-danger">?</span>';
            if ($result->nama_penyakit != null) $nama_penyakit = $result->nama_penyakit;
            if ($result->persentase != null) $persentase = number_format($result->persentase, 2) . '%';
            // 
            $row = array();
            $row[] = ++$no;
            $row[] = $username;
            $row[] = $kode_penyakit;
            $row[] = $nama_penyakit;
            $row[] = $persentase;
            $row[] = $this->time->getTimeSince($result->date_created) . '<br> (' . $this->time->getTimeAgo($result->date_created) . ')';
            $row[] = '
                <div class="d-flex">
                    <a class="btn btn-outline-primary me-1" onclick="info(' . $result->id_r . ',
                    ' . "'" . $result->username . "'" . ',' . $result->role_id . ',' . "'" . $this->time->getTimeSince($result->date_created) . "'" . ')"><i class="fas fa-eye"></i></a>
                </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        return $output;
    }
    function loadDataRiwayat_testing()
    {
        $results = $this->admin_model->getDataTable_riwayat(true);
        $output = $this->_prosesLoadDTRiwayat_Testing($results);
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
}
