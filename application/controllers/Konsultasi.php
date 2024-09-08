<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_active();
        $this->load->model('SweetAlert2_model', 'sa2');
        $this->load->model('Sidebar_model', 'sidebar');
        $this->load->model('Konsultasi_model', 'konsul_model');
        $this->load->model('InfScrollDiag_model', 'iscroll');
        $this->load->model('Time_model', 'time');
        // Get data 'user'
        $this->data = array(
            "user" => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        );
        // Get session 'role_id'
        $this->role = $this->session->userdata('role_id');
    }


    // konsultasi
    public function index()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Home';
        // Active Sidebar
        $data['topbar'] = 'Home';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/mediplus_header', $data);
        $this->load->view('konsultasi/index',);
        $this->load->view('templates/mediplus_footer');
    }



    // konsultasi/konsultasi
    public function konsultasi()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Konsultasi';
        // Active Sidebar
        $data['topbar'] = 'Konsultasi';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load Data Gejala
        $data['data_gejala'] = $this->konsul_model->getDataGejala();

        // Load View
        $this->load->view('templates/mediplus_header', $data);
        $this->load->view('konsultasi/konsultasi',);
        $this->load->view('templates/mediplus_footer');
    }
    // Itung"an
    private function _aturan_kombinasi($old = 0, $new = 0)
    {
        if ($old == 0 || $new == 0) {
            if ($old == 0) return $new;
            if ($new == 0) return $old;
        }
        if ($old > 0 && $new > 0) {
            return $old + $new * (1 - $old);
        } else if ($old < 0 && $new < 0) {
            $min = $old;
            if ($old > $new) $min = $new;
            return ($old + $new) / 1 - $min;
        } else if ($old < 0 && $new > 0) {
            return $old + $new * (1 + $old);
        } else if ($old > 0 && $new < 0) {
            return $old;
        }
    }
    public function proses_hitung()
    {
        if (!$this->input->post('data')) {
            redirect('konsultasi');
        }
        $dataUser = $this->input->post('data');
        $dataPenyakit = $this->konsul_model->getDataPenyakit();
        $dataAturan = $this->konsul_model->getDataAturan();
        $testing = array();
        $hasil_akhir = array();
        $feedback;
        // $CF_Pakar = array();


        // Hitung CF Pakar (MB - MD)
        // foreach ($dataAturan as $aturan) {
        //     $id = (int)$aturan['id'];
        //     $mb = (float)$aturan['mb'];
        //     $md = (float)$aturan['md'];
        //     $cf = $mb - $md;
        //     $cf = array('id' => $id, 'cf_pakar' => $cf);
        //     array_push($CF_Pakar, $cf);
        // }


        // (1) Hitung masing2 data aturan berdasarkan penyakit
        foreach ($dataPenyakit as $penyakit) { //Looping data penyakit
            $id_penyakit = $penyakit['id'];
            $dataAturan_Penyakit = $this->konsul_model->getDataAturan_Penyakit($id_penyakit); //Data aturan berdasarkan penyakit

            // (2) Hitung data CF[H,E] setiap gejala pada aturan | CF[H] * CF[E]
            $CF_HE = array();
            $CF_Pakar = 0;
            foreach ($dataAturan_Penyakit as $aturan_penyakit) { //Looping data aturan | CF_Pakar
                $id_auturan_g = $aturan_penyakit['id_gejala'];
                $mb = (float)$aturan_penyakit['mb'];
                $md = (float)$aturan_penyakit['md'];
                $CF_Pakar = $mb - $md;

                // (2.1) Cari data penyakit yang cocok dari input user
                $CF_User = 0;
                foreach ($dataUser as $dtUser) { //Looping data inputan user untuk mencari penyakit yang sesuai dengan CF_Pakar | CF_User
                    if ($dtUser['id'] === $id_auturan_g) {
                        $CF_User_cocok = $dtUser['pilihan'];
                        if ($CF_User_cocok != 'Pilih') $CF_User = (float)$dtUser['pilihan']; //number_format
                        else if ($CF_User_cocok == 'Pilih') $CF_User = 0; //number_format
                    }
                }
                $CF_HE_x = $CF_Pakar * $CF_User;
                array_push($CF_HE, $CF_HE_x); //Masukkan setiap hasil CF[H] * CF[E] ke array $CF_HE
            }


            // (3) Kombinasi $CF_HE dengan aturan kombinasi CF
            array_push($testing, $CF_HE);
            $pnjg_CFHE = count($CF_HE);
            $CF_old = 0;
            $CF_combine = 0;

            // (3.1) Kombinasi $CF_HE pertama dg ke-2
            if ($pnjg_CFHE < 2) {
                @$CF_combine = $CF_HE[0];
            } else if ($pnjg_CFHE < 3) {
                $CF_combine = $this->_aturan_kombinasi($CF_HE[0], $CF_HE[1]);
            } else {
                $CF_old = $this->_aturan_kombinasi($CF_HE[0], $CF_HE[1]);
                for ($x = 2; $x < $pnjg_CFHE; $x++) {
                    $CF_combine = $this->_aturan_kombinasi($CF_old, $CF_HE[$x]);
                    $CF_old = $CF_combine;
                }
            }
            $CF_combine = (float)$CF_combine * 100; // (4) Hitung persentase //number_format
            // $CF_combine = (number_format((float)$CF_combine, 2));
            $data_akhir = array(
                "id_penyakit" => $id_penyakit,
                "nama_penyakit" => $penyakit['nama_penyakit'],
                "detail_penyakit" => $penyakit['detail_penyakit'],
                "saran_penyakit" => $penyakit['saran_penyakit'],
                "img_penyakit" => $penyakit['img_penyakit'],
                "persentase" => $CF_combine
            );
            array_push($hasil_akhir, $data_akhir);
        }

        // Sorting hasil akhir DESC
        usort($hasil_akhir, function ($item1, $item2) {
            return $item2['persentase'] <=> $item1['persentase'];
        });
        // Buang item dlm array yg persentase <= 0%
        $new_ha = array();
        foreach ($hasil_akhir as $ha) {
            if ((float)$ha['persentase'] > 0) {
                array_push($new_ha, $ha);
            }
        }
        $hasil_akhir = $new_ha;
        // Ambil kembali inputan user & buang yg tidak dipilih
        $input_user = array();
        foreach ($dataUser as $du) {
            if ($du['pilihan'] != 'Pilih') {
                $dt_gejala = $this->konsul_model->getDataGejalabyId((int)$du['id']);
                $arr_dt_gejala = array(
                    "id_gejala" => $dt_gejala[0]->id,
                    "nama_gejala" => $dt_gejala[0]->nama_gejala,
                    "pilihan_user" => $du['pilihan']
                );
                array_push($input_user, $arr_dt_gejala);
            }
        }
        // Paket siap kirim
        $paket['input_user'] = $input_user;
        $paket['hasil_akhir'] = $hasil_akhir;

        // Masukkan ke database
        $now = date('Y-m-d H:i:s', time());
        $output['since_now'] = $this->time->getTimeSince($now);
        if ($this->session->userdata('username') && $paket['input_user']) {
            $dbs_hasil_akhir = $paket['hasil_akhir'];
            $dbs_input_user = $paket['input_user'];

            // input table data_riwayat
            $data_riwayat = [
                'id_user' => $this->session->userdata('id'),
                'id_penyakit' => null,
                'persentase' => null,
                'active' => '★',
                'date_created' => $now
            ];
            if ($dbs_hasil_akhir) {
                $data_riwayat = [
                    'id_user' => $this->session->userdata('id'),
                    'id_penyakit' => $dbs_hasil_akhir[0]['id_penyakit'],
                    'persentase' => $dbs_hasil_akhir[0]['persentase'],
                    'active' => '★',
                    'date_created' => $now
                ];
            }
            $this->db->trans_start();
            $this->db->insert('data_riwayat', $data_riwayat);
            $auto_increment_val = $this->db->insert_id();
            $this->db->trans_complete();

            // input table data_riwayat_input
            foreach ($dbs_input_user as $dbs) {
                $data_riwayat_input = [
                    'id_riwayat' => $auto_increment_val,
                    'id_user' => $this->session->userdata('id'),
                    'id_gejala' => $dbs['id_gejala'],
                    'kondisi' => $dbs['pilihan_user']
                ];
                $this->db->insert('data_riwayat_input', $data_riwayat_input);
            }

            // Input table data_riwayat_lain
            array_shift($dbs_hasil_akhir);
            if ($dbs_hasil_akhir) {
                foreach ($dbs_hasil_akhir as $dbs) {
                    $data_riwayat_lain = [
                        'id_riwayat' => $auto_increment_val,
                        'id_user' => $this->session->userdata('id'),
                        'id_penyakit' => $dbs['id_penyakit'],
                        'persentase' => $dbs['persentase']
                    ];
                    $this->db->insert('data_riwayat_lain', $data_riwayat_lain);
                }
            }
        }

        // Ubah ke bentuk view
        $output['input_user'] = '';
        $no = 1;
        foreach ($paket['input_user'] as $index['row']) {
            // no urut
            $index['row']['no'] = $no;
            // kode gejala
            $id = (int)$index['row']['id_gejala'];
            if ($id < 10) {
                $index['row']['kode_gejala'] = 'G00' . $id;
            } elseif ($id < 100) {
                $index['row']['kode_gejala'] = 'G0' . $id;
            } else {
                $index['row']['kode_gejala'] = 'G' . $id;
            }
            // pilihan user
            $pilihan = $index['row']['pilihan_user'];
            if ($pilihan == '1') $index['row']['pilihan'] = 'Pasti Ya';
            if ($pilihan == '0.8') $index['row']['pilihan'] = 'Hampir Pasti Ya';
            if ($pilihan == '0.6') $index['row']['pilihan'] = 'Kemungkinan Besar Ya';
            if ($pilihan == '0.4') $index['row']['pilihan'] = 'Mungkin Ya';
            if ($pilihan == '0') $index['row']['pilihan'] = '<span class="text-primary">Kosong / Tidak memilih</span>';
            if ($pilihan == '0.1') $index['row']['pilihan'] = 'Tidak Yakin';
            if ($pilihan == '-0.4') $index['row']['pilihan'] = 'Mungkin Tidak';
            if ($pilihan == '-0.6') $index['row']['pilihan'] = 'Kemungkinan Besar Tidak';
            if ($pilihan == '-0.8') $index['row']['pilihan'] = 'Hampir Pasti Tidak';
            if ($pilihan == '-1') $index['row']['pilihan'] = 'Pasti Tidak';
            $output['input_user'] .= $this->load->view('konsultasi/konsultasi_input', $index, true);
            $no++;
        }
        $index['row'] = $paket['hasil_akhir'];
        $output['hasil_akhir'] = $this->load->view('konsultasi/konsultasi_diagnosa', $index, true);







        // $resp['status'] = $dataUser[1]['id'];
        $resp['status'] = $output;
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }


    // konsultasi/riwayat
    public function riwayat()
    {
        if (!$this->session->userdata('username')) {
            redirect('konsultasi');
        }
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Riwayat';
        // Active Sidebar
        $data['topbar'] = 'Riwayat';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/mediplus_header', $data);
        $this->load->view('konsultasi/riwayat',);
        $this->load->view('templates/mediplus_footer');
    }
    public function fetch_riwayat()
    {
        if (!$this->input->post('limit')) redirect('konsultasi/riwayat');
        // Init
        $output = '';
        $next = 'false';
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $id_user = $this->data['user']['id'];
        $keyword = $this->input->post('keyword');
        $order = $this->input->post('order');

        // Ambil dari model
        $data = $this->iscroll->riwayat($limit, $start, $id_user, $keyword, $order);
        $result = $data['3']->result_array();
        $num_rows_1 = $data['num_rows_1'];
        $num_rows_2 = $data['num_rows_2'];
        $num_rows_3 = $data['num_rows_3'];
        if ($num_rows_1 > 0) {
            if ($num_rows_3 > 0) {
                $no = $start + 1;
                foreach ($result as $result['row']) {
                    // var_dump($result['row']) $result['row']['id_notulen']
                    $result['date_created'] = $this->time->getTimeAgo($result['row']['date_created']);
                    $result['date_created_since'] = $this->time->getTimeSince($result['row']['date_created']);
                    $result['no'] = $no;
                    $no++;
                    $output .= $this->load->view('konsultasi/riwayat_iscroll', $result, true);
                }
            } else {
                $output = 'null2';
            }
        } else {
            $output = 'null';
        }
        // Buat cek apakah masih ada data selanjutnya
        $data_next = $this->iscroll->riwayat($limit + 1, $start, $id_user, $keyword, $order);
        if ($data_next['num_rows_3'] != $data['num_rows_3']) $next = 'true';
        echo json_encode(['data' => $output, 'num_rows' => $num_rows_2, 'next' => $next]);
    }
    public function info_riwayat()
    {
        if (!$this->input->post('id_r')) redirect('konsultasi/riwayat');
        // Init
        $id_r = $this->input->post('id_r');
        // Ambil dari model
        $paket = $this->konsul_model->getInfoRiwayat($id_r);
        // Ubah ke bentuk view
        $no = 1;
        $output['input_user'] = '';
        foreach ($paket['data_riwayat_input'] as $index['row']) {
            // no urut
            $index['row']['no'] = $no;
            $no++;
            // kode gejala
            $id = (int)$index['row']['id_g'];
            if ($id < 10) {
                $index['row']['kode_gejala'] = 'G00' . $id;
            } elseif ($id < 100) {
                $index['row']['kode_gejala'] = 'G0' . $id;
            } else {
                $index['row']['kode_gejala'] = 'G' . $id;
            }
            // pilihan user
            $pilihan = $index['row']['kondisi'];
            if ($pilihan == '1') $index['row']['pilihan'] = 'Pasti Ya';
            if ($pilihan == '0.8') $index['row']['pilihan'] = 'Hampir Pasti Ya';
            if ($pilihan == '0.6') $index['row']['pilihan'] = 'Kemungkinan Besar Ya';
            if ($pilihan == '0.4') $index['row']['pilihan'] = 'Mungkin Ya';
            if ($pilihan == '0') $index['row']['pilihan'] = '<span class="text-primary">Kosong / Tidak memilih</span>';
            if ($pilihan == '0.1') $index['row']['pilihan'] = 'Tidak Yakin';
            if ($pilihan == '-0.4') $index['row']['pilihan'] = 'Mungkin Tidak';
            if ($pilihan == '-0.6') $index['row']['pilihan'] = 'Kemungkinan Besar Tidak';
            if ($pilihan == '-0.8') $index['row']['pilihan'] = 'Hampir Pasti Tidak';
            if ($pilihan == '-1') $index['row']['pilihan'] = 'Pasti Tidak';
            $output['input_user'] .= $this->load->view('konsultasi/konsultasi_input', $index, true);
        }
        $index['row'] = $paket['data_riwayat'];
        foreach ($paket['data_riwayat_lain'] as $i) {
            array_push($index['row'], $i);
        }
        $output['hasil_akhir'] = $this->load->view('konsultasi/konsultasi_diagnosa', $index, true);
        // $output['hasil_akhir'] = $index['row'];

        $resp = $output;
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }
    public function hapusDataRiwayat()
    {
        if (!$this->input->post('id_r')) redirect('konsultasi/riwayat');
        // Init
        $id_r = (int)$this->input->post('id_r');
        $data = [
            'active' => '',
        ];
        if ($this->konsul_model->hapusDataRiwayat(array('id' => $id_r), $data) > 0) {
            $resp['status'] = 'success';
        } else {
            $resp['status'] = 'gagal_hapus_riwayat';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resp));
    }



    // konsultasi/artikel
    public function artikel()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Artikel Penyakit';
        // Active Sidebar
        $data['topbar'] = 'Artikel Penyakit';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/mediplus_header', $data);
        $this->load->view('konsultasi/artikel',);
        $this->load->view('templates/mediplus_footer');
    }
    public function fetch_artikel()
    {
        if (!$this->input->post('limit')) redirect('konsultasi/artikel');
        // Init
        $output = '';
        $next = 'false';
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $keyword = $this->input->post('keyword');
        $order = $this->input->post('order');

        // Ambil dari model
        $data = $this->iscroll->artikel($limit, $start, $keyword, $order);
        $result = $data['3']->result_array();
        $num_rows_1 = $data['num_rows_1'];
        $num_rows_2 = $data['num_rows_2'];
        $num_rows_3 = $data['num_rows_3'];
        if ($num_rows_1 > 0) {
            if ($num_rows_3 > 0) {
                $no = $start + 1;
                foreach ($result as $result['row']) {
                    $result['terakhir_diubah_ago'] = $this->time->getTimeAgo($result['row']['terakhir_diubah']);
                    $result['no'] = $no;
                    $no++;
                    $output .= $this->load->view('konsultasi/artikel_iscroll', $result, true);
                }
            } else {
                $output = 'null2';
            }
        } else {
            $output = 'null';
        }
        // Buat cek apakah masih ada data selanjutnya
        $data_next = $this->iscroll->artikel($limit + 1, $start, $keyword, $order);
        if ($data_next['num_rows_3'] != $data['num_rows_3']) $next = 'true';
        echo json_encode(['data' => $output, 'num_rows' => $num_rows_2, 'next' => $next]);
    }
}
