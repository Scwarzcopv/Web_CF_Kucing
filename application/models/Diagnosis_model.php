<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosis_model extends CI_Model
{
    // ========================================== PENYAKIT ==========================================
    // Init Penyakit
    var $tablePenyakit = 'data_penyakit';
    var $colOrderPenyakit = array('id', 'nama_penyakit', 'detail_penyakit', 'saran_penyakit', 'terakhir_diubah');
    var $orderPenyakit = array('id', 'nama_penyakit', 'detail_penyakit', 'saran_penyakit', 'terakhir_diubah');
    // DataTable Penyakit
    private function _getDataQuery_penyakit()
    {
        $this->db->from($this->tablePenyakit)->where('is_active', '★');
        $this->db->group_start();
        if (isset($_POST['search']['value'])) {
            $this->db->like('nama_penyakit', $_POST['search']['value']);
            $this->db->or_like('detail_penyakit', $_POST['search']['value']);
            $this->db->or_like('saran_penyakit', $_POST['search']['value']);
        }
        $this->db->group_end();
        if (isset($_POST['order'])) {
            $this->db->order_by($this->orderPenyakit[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }
    function validateNamaPenyakit($nama_penyakit)
    {
        $this->db->from($this->tablePenyakit)
            ->where('is_active', '★')
            ->where('nama_penyakit', $nama_penyakit);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function getDataTable_penyakit()
    {
        $this->_getDataQuery_penyakit();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function countFilteredData_penyakit()
    {
        $this->_getDataQuery_penyakit();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAllAData_penyakit()
    {
        $this->db->from($this->tablePenyakit)->where('is_active', '★');
        return $this->db->count_all_results();
    }
    // Tambah Data Penyakit
    function addDataPenyakit($data)
    {
        $this->db->insert($this->tablePenyakit, $data);
        return $this->db->affected_rows();
    }
    // Edit Data Penyakit
    function getDataPenyakitById($id)
    {
        return $this->db->get_where($this->tablePenyakit, ['id' => $id])->row();
    }
    function editDataPenyakit($where, $data)
    {
        $this->db->update($this->tablePenyakit, $data, $where);
        return $this->db->affected_rows();
    }
    // Hapus Data Penyakit
    function deleteDataPenyakit($id)
    {
        // $this->db->delete($this->tablePenyakit, ['id' => $id]);
        $nama_penyakit = $this->db->select('*')->from($this->tablePenyakit)->where('id', $id)->get()->row();
        // $nama_penyakit = $nama_penyakit->nama_penyakit;
        // $nama_penyakit .= ' (DATA DIHAPUS)';
        @$imageOld = $nama_penyakit->img_penyakit; //Hapus gambar dari dir
        if (file_exists(FCPATH . 'assets/img/penyakit/' . @$imageOld)) {
            unlink(FCPATH . 'assets/img/penyakit/' . @$imageOld);
        }
        $dihapus = '<span class="fw-bold text-danger">(DATA DIHAPUS)</span>';
        $data = [
            'is_active' => '',
            'nama_penyakit' => $dihapus,
            'detail_penyakit' => $dihapus,
            'saran_penyakit' => $dihapus,
            'img_penyakit' => null,
        ];

        $this->db->update($this->tablePenyakit, $data, ['id' => $id]);
        return $this->db->affected_rows();

        // Hapus data di tabel data_aturan
        $this->db->delete($this->tableAturan, ['id_penyakit' => $id]);
    }


    // ========================================== GEJALA ==========================================
    // Init Gejala
    var $tableGejala = 'data_gejala';
    var $colOrderGejala = array('id', 'nama_gejala', 'terakhir_diubah');
    var $orderGejala = array('id', 'nama_gejala', 'terakhir_diubah');
    // DataTable Gejala
    private function _getDataQuery_gejala()
    {
        $this->db->from($this->tableGejala)->where('is_active', '★');
        if (isset($_POST['search']['value'])) {
            $this->db->like('nama_gejala', $_POST['search']['value']);
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->orderGejala[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }
    function validateNamaGejala($nama_gejala)
    {
        $this->db->from($this->tableGejala)
            ->where('is_active', '★')
            ->where('nama_gejala', $nama_gejala);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function getDataTable_gejala()
    {
        $this->_getDataQuery_gejala();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function countFilteredData_gejala()
    {
        $this->_getDataQuery_gejala();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAllAData_gejala()
    {
        $this->db->from($this->tableGejala)->where('is_active', '★');
        return $this->db->count_all_results();
    }
    // Tambah Data Gejala
    function addDataGejala($data)
    {
        $this->db->insert($this->tableGejala, $data);
        return $this->db->affected_rows();
    }
    // Edit Data Gejala
    function getDataGejalaById($id)
    {
        return $this->db->get_where(
            $this->tableGejala,
            ['id' => $id]
        )->row();
    }
    function editDataGejala($where, $data)
    {
        $this->db->update($this->tableGejala, $data, $where);
        return $this->db->affected_rows();
    }
    // Hapus Data Gejala
    function deleteDataGejala($id)
    {
        // $this->db->delete($this->tableGejala, ['id' => $id]);
        $nama_gejala = $this->db->select('nama_gejala')->from($this->tableGejala)->where('id', $id)->get()->row();
        // $nama_gejala = $nama_gejala->nama_gejala;
        // $nama_gejala .= ' (DATA DIHAPUS)';
        $nama_gejala = '<span class="fw-bold text-danger">(DATA DIHAPUS)</span>';
        $this->db->update($this->tableGejala, ['is_active' => '', 'nama_gejala' => $nama_gejala], ['id' => $id]);

        // Hapus data di tabel data_aturan
        $this->db->delete($this->tableAturan, ['id_gejala' => $id]);

        return $this->db->affected_rows();
    }


    // ========================================== ATURAN ==========================================
    // Init Aturan
    var $tableAturan = 'data_aturan';
    var $colOrderAturan = array('a.id', 'b.nama_penyakit', 'c.nama_gejala', 'a.mb', 'a.md', 'a.terakhir_diubah');
    var $orderAturan = array('a.id', 'b.nama_penyakit', 'c.nama_gejala', 'a.mb', 'a.md', 'a.terakhir_diubah');
    // DataTable Gejala
    private function _getDataQuery_aturan()
    {
        $this->db->select([
            // Tabel data_aturan
            'a.id as id_aturan', 'a.mb', 'a.md', 'a.terakhir_diubah as td_aturan',
            // Tabel data_penyakit
            'b.nama_penyakit',
            // Tabel data_gejala
            'c.nama_gejala',
        ]);
        $this->db->from($this->tableAturan . ' a')
            ->where('b.is_active', '★')
            ->where('c.is_active', '★')
            ->join($this->tablePenyakit . ' b', 'a.id_penyakit = b.id', 'left')
            ->join($this->tableGejala . ' c', 'a.id_gejala = c.id', 'left');

        $this->db->group_start();
        if (isset($_POST['search']['value'])) {
            $this->db->like('nama_penyakit', $_POST['search']['value']);
            $this->db->or_like('nama_gejala', $_POST['search']['value']);
            $this->db->or_like('mb', $_POST['search']['value']);
            $this->db->or_like('md', $_POST['search']['value']);
        }
        $this->db->group_end();

        if (isset($_POST['order'])) {
            $this->db->order_by($this->orderAturan[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('a.id', 'DESC');
        }
    }
    function getDataTable_aturan()
    {
        $this->_getDataQuery_aturan();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function countFilteredData_aturan()
    {
        $this->_getDataQuery_aturan();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAllAData_aturan()
    {
        $this->db->from($this->tableAturan);
        return $this->db->count_all_results();
    }
    // Tambah Data Penyakit
    function addDataAturan($data)
    {
        $this->db->from($this->tableAturan)
            ->where('id_penyakit', $data['id_penyakit'])
            ->where('id_gejala', $data['id_gejala']);
        $result = $this->db->get()->num_rows();
        if ($result <= 0) {
            $this->db->insert($this->tableAturan, $data);
            return $this->db->affected_rows();
        } else {
            $this->db->update($this->tableAturan, $data, array('id_penyakit' => $data['id_penyakit'], 'id_gejala' => $data['id_gejala']));
            return $this->db->affected_rows();
        }
    }
    // Edit Data Gejala
    function getDataAturanById($id)
    {
        return $this->db->get_where($this->tableAturan, ['id' => $id])->row();
    }
    function editDataAturan($where, $data)
    {
        $this->db->update(
            $this->tableAturan,
            $data,
            $where
        );
        return $this->db->affected_rows();
    }
    function loadDataChoices()
    {
        $output['data_penyakit'] = $this->db->select('*')
            ->from($this->tablePenyakit)
            ->where('is_active', '★')
            // ->where('id NOT IN (SELECT id_penyakit FROM data_aturan)', NULL, FALSE)
            ->get()
            ->result_array();
        $output['data_gejala'] = $this->db->select('*')
            ->from($this->tableGejala)
            ->where('is_active', '★')
            // ->where('id NOT IN (SELECT id_gejala FROM data_aturan)', NULL, FALSE)
            ->get()
            ->result_array();
        return $output;
    }
    function loadDataChoices2($id_aturan, $id_penyakit_post, $active_id_penyakit)
    {
        $data_aturan = $this->getDataAturanById($id_aturan);
        $id_penyakit = $data_aturan->id_penyakit;
        $output['data_penyakit'] = $this->db->select('*')
            ->from($this->tablePenyakit)
            ->where('is_active', '★')
            // ->where('id NOT IN (SELECT id_penyakit FROM data_aturan)', NULL, FALSE)
            ->get()
            ->result_array();
        $output['data_gejala'] = $this->db->select('*')
            ->from($this->tableGejala)
            ->where('is_active', '★')
            ->where('id NOT IN (SELECT id_gejala FROM data_aturan WHERE id_penyakit=' . $id_penyakit . ')', NULL, FALSE)
            ->or_where('id IN (SELECT id_gejala FROM data_aturan WHERE id=' . $id_aturan . ')', NULL, FALSE)
            ->get()
            ->result_array();
        if ($id_penyakit_post != null) {
            $this->db->select('*')
                ->from($this->tableGejala)
                ->where('is_active', '★')
                ->where('id NOT IN (SELECT id_gejala FROM data_aturan WHERE id_penyakit=' . $id_penyakit_post . ')', NULL, FALSE);
            if ($id_penyakit_post === $active_id_penyakit) {
                $this->db->or_where('id IN (SELECT id_gejala FROM data_aturan WHERE id=' . $id_aturan . ')', NULL, FALSE);
            }
            // ->or_where('id IN (SELECT id_gejala FROM data_aturan WHERE id=' . $id_aturan . ')', NULL, FALSE)
            $output['data_gejala'] = $this->db->get()
                ->result_array();
        }
        return $output;
    }
    function cekKombinasiAturan($id_penyakit, $id_gejala)
    {
        $this->db->from($this->tableAturan)
            ->where('id_penyakit', $id_penyakit)
            ->where('id_gejala', $id_gejala);
        $query = $this->db->get();
        $result['num_rows'] = $query->num_rows();
        $result['row_array'] = $query->row_array();
        return $result;
    }
    // Hapus Data Gejala
    function deleteDataAturan($id)
    {
        $this->db->delete($this->tableAturan, ['id' => $id]);
        return $this->db->affected_rows();
    }


    // ========================================== ARTIKEL ==========================================    // Init Gejala
    var $tableArtikel = 'data_artikel';
    var $colOrderArtikel = array('id', 'nama_post', 'detail_post', 'saran_post', 'terakhir_diubah');
    var $orderArtikel = array('id', 'nama_post', 'detail_post', 'saran_post', 'terakhir_diubah');
    var $tableArtikelFoto = 'data_artikel_foto';
    // DataTable Gejala
    private function _getDataQuery_artikel()
    {
        $this->db->from($this->tableArtikel);
        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('nama_post', $_POST['search']['value']);
            $this->db->like('detail_post', $_POST['search']['value']);
            $this->db->like('saran_post', $_POST['search']['value']);
            $this->db->group_end();
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->orderArtikel[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'DESC');
        }
    }
    function getDataTable_artikel()
    {
        $this->_getDataQuery_artikel();
        if (@$_POST['length'] != -1) {
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function countFilteredData_artikel()
    {
        $this->_getDataQuery_artikel();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAllAData_artikel()
    {
        $this->db->from($this->tableArtikel);
        return $this->db->count_all_results();
    }
    // Load Data Artikel Berdasarkan Nama Post
    function loadDataArtikelByName($name)
    {
        $this->db->from($this->tableArtikel)->where('nama_post', $name);
        $query = $this->db->get();
        $output['num_rows'] = $query->num_rows();
        $output['data_post'] = $query->result_array();
        return $output;
    }
    function loadDataArtikelById($id)
    {
        $this->db->from($this->tableArtikel)->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    // Tambah Data Penyakit
    function addDataArtikel($data)
    {
        $this->db->from($this->tableArtikel)
            ->where('nama_post', $data['nama_post']);
        $get = $this->db->get();
        $result = $get->row();
        $this->db->trans_start();
        if ($get->num_rows() <= 0) {
            $this->db->insert($this->tableArtikel, $data);
            $output['affected_rows'] = $this->db->error();
            $output['auto_increment_val'] = $this->db->insert_id();
        } else {
            $this->db->update($this->tableArtikel, $data, array('nama_post' => $data['nama_post']));
            $output['affected_rows'] = $this->db->error();
            $output['auto_increment_val'] = $result->id;
        }
        // $output['auto_increment_val'] = $this->db->insert_id();
        $this->db->trans_complete();

        return $output;
    }
    function addDataArtikel_fase2($data)
    {
        // `````Update data_artikel`````
        $this->db->from($this->tableArtikel)
            ->where('id', $data['id_artikel']);
        $data_tb_artikel = [
            'detail_post' => $data['d_post'],
            'saran_post' => $data['s_post'],
        ];
        $this->db->trans_start();
        $this->db->update($this->tableArtikel, $data_tb_artikel, array('id' => $data['id_artikel']));
        $this->db->trans_complete();
        $output['trans_update'] = TRUE;
        if ($this->db->error() != null && $this->db->error()['message'] != '') {
            $output['trans_update'] = FALSE;
        }


        // `````Update data_artikel_foto`````
        // Hapus foto lama
        $output['trans_hapus'] = TRUE;
        $this->db->select('*')
            ->from($this->tableArtikelFoto)
            ->where('id_artikel', $data['id_artikel']);
        $data_imageOld = $this->db->get()->result_array();
        foreach ($data_imageOld as $imageOld) {
            if (strpos($data['d_post'], $imageOld['img']) === false && strpos($data['s_post'], $imageOld['img']) === false) {
                unlink(FCPATH . 'assets/img/artikel_quill/' . $imageOld['img']); //hapus dari dir
                $this->db->trans_start(); //hapus dari dbs
                $this->db->delete($this->tableArtikelFoto, ['id' => $imageOld['id']]);
                $this->db->trans_complete();
                if ($this->db->error() != null && $this->db->error()['message'] != '') {
                    $output['trans_hapus'] = FALSE;
                }
            }
        }
        // Tambah foto baru
        $output['trans_d'] = TRUE;
        if (is_countable($data['d_base64']) && count($data['d_base64']) > 0) {
            for ($x = 0; $x < count($data['d_base64']); $x++) {
                $data_insertFoto = [
                    'id_artikel' => $data['id_artikel'],
                    'img' => $data['d_nameImg'][$x]
                ];
                $this->db->trans_start();
                $this->db->insert($this->tableArtikelFoto, $data_insertFoto);
                $this->db->trans_complete();
                if ($this->db->error() != null && $this->db->error()['message'] != '') {
                    $output['trans_d'] = FALSE;
                }
            }
        }
        $output['trans_s'] = TRUE;
        if (is_countable($data['s_base64']) && count($data['s_base64']) > 0) {
            for ($x = 0; $x < count($data['s_base64']); $x++) {
                $data_insertFoto = [
                    'id_artikel' => $data['id_artikel'],
                    'img' => $data['s_nameImg'][$x]
                ];
                $this->db->trans_start();
                $this->db->insert($this->tableArtikelFoto, $data_insertFoto);
                $this->db->trans_complete();
                if ($this->db->error() != null && $this->db->error()['message'] != '') {
                    $output['trans_s'] = FALSE;
                }
            }
        }


        return $output;
    }
}
