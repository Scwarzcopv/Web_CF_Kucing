<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    var $t_penyakit = 'data_penyakit';
    var $t_gejala = 'data_gejala';
    var $t_aturan = 'data_aturan';
    var $t_user = 'user';
    var $t_riwayat = 'data_riwayat';
    var $total_show = 10; //Total show aktifitas user
    var $total_show_chart = 4; //Total show chart

    private function _aktifitas_user($query_temp, $req_id, $total_show)
    {
        // Masukkan setiap data ke dalam array dengan id sbg key nya
        $arr_aktifitas = array();
        foreach ($query_temp as $temp) {
            $id = (int)$temp[$req_id];
            $total = @$arr_aktifitas["" . $id . ""];
            if ($total == null || $total == 0) {
                $arr_temp = ["" . $id . "" => 1];
                $arr_aktifitas += $arr_temp;
            } else {
                $arr_aktifitas["" . $id . ""] = $total + 1;
            }
        }
        if (!function_exists('sorting')) {
            function sorting($a, $b) //Fungsi sorting assosiative array
            {
                if ($a == $b) return 0;
                return ($a > $b) ? -1 : 1;
            }
        }

        uasort($arr_aktifitas, "sorting");

        $arr_aktifitas_new = $arr_aktifitas;
        $arr_aktifitas_total = count($arr_aktifitas);
        if ($arr_aktifitas_total > $total_show) {
            $arr_aktifitas_new = array_slice($arr_aktifitas, 0, - ($arr_aktifitas_total - $total_show), true);
        }
        return $arr_aktifitas_new;
    }

    // Total Data
    function total_data()
    {
        // Total Data || Penyakit & Gejala & Aturan & User
        $this->db->from($this->t_penyakit)->where('is_active', '★');
        $query['total_penyakit'] = $this->db->get()->num_rows();

        $this->db->from($this->t_gejala)->where('is_active', '★');
        $query['total_gejala'] = $this->db->get()->num_rows();

        $this->db->from($this->t_aturan);
        $query['total_aturan'] = $this->db->get()->num_rows();

        $this->db->from($this->t_user)
            ->where('role_id >', 2);
        $query['total_user'] = $this->db->get()->num_rows();

        $year = date('Y');
        $month = date('m');

        $this->db->from($this->t_penyakit)
            ->where('is_active', '★')
            ->where('MONTH(terakhir_diubah) = ' . $month . ' AND YEAR(terakhir_diubah) = ' . $year);
        $query['total_penyakit_new'] = $this->db->get()->num_rows();

        $this->db->from($this->t_gejala)
            ->where('is_active', '★')
            ->where('MONTH(terakhir_diubah) = ' . $month . ' AND YEAR(terakhir_diubah) = ' . $year);
        $query['total_gejala_new'] = $this->db->get()->num_rows();

        $this->db->from($this->t_aturan)
            ->where('MONTH(terakhir_diubah) = ' . $month . ' AND YEAR(terakhir_diubah) = ' . $year);
        $query['total_aturan_new'] = $this->db->get()->num_rows();

        $this->db->from($this->t_user)
            ->where('role_id >', 2)
            ->where('MONTH(date_created) = ' . $month . ' AND YEAR(date_created) = ' . $year);
        $query['total_user_new'] = $this->db->get()->num_rows();

        // Aktifitas User
        $total_show = $this->total_show;
        $query['total_aktifitas'] = array();
        $this->db->select('id_user')
            ->from('data_riwayat');
        $query_temp = $this->db->get()->result_array();
        $arr_aktifitas_new = $this->_aktifitas_user($query_temp, 'id_user', $total_show);

        foreach ($arr_aktifitas_new as $key => $val) {
            $this->db->select([
                // Tabel user
                'id', 'name', 'username', 'image', 'is_active', 'date_created', 'role_id'
            ])
                ->from('user')
                ->where('id', $key);
            $query_temp = $this->db->get()->row_array();
            $query_temp += ['total_konsultasi' => $val];
            array_push($query['total_aktifitas'], $query_temp);
        }

        // Aktifitas User - sejak awal bulan
        $query['total_aktifitas_bulanan'] = array();
        foreach ($query['total_aktifitas'] as $ta) {
            $id_user_now = $ta['id'];
            $this->db->from('data_riwayat')
                ->where('MONTH(date_created) = ' . $month . ' AND YEAR(date_created) = ' . $year)
                ->where('id_user', $id_user_now);
            $query_temp2 = $this->db->get()->result_array();
            array_push($query['total_aktifitas_bulanan'], count($query_temp2));
        }
        // $this->db->select('id_user')
        //     ->from('data_riwayat')
        //     ->where('MONTH(date_created) = ' . $month . ' AND YEAR(date_created) = ' . $year);
        // $query_temp2 = $this->db->get()->result_array();
        // $query['total_aktifitas_bulanan'] = $this->_aktifitas_user($query_temp2, 'id_user', $total_show);
        // rsort($query['total_aktifitas_bulanan']); //Biar key kereset valuenya

        // Chart
        $total_show_chart = $this->total_show_chart;
        $query['total_chart'] = array();
        $this->db->select('id_penyakit')
            ->from('data_riwayat')
            ->where('id_penyakit is NOT NULL', NULL, FALSE);
        $get = $this->db->get();
        $query_temp_all = $get->num_rows();
        $query_temp = $get->result_array();
        $arr_chart_new = $this->_aktifitas_user($query_temp, 'id_penyakit', $total_show_chart);

        $sisa = $query_temp_all; //Sisa yang lain
        foreach ($arr_chart_new as $key => $val) {
            $sisa -= $val;
            $this->db->select([
                // Tabel penyakit
                'id', 'nama_penyakit'
            ])
                ->from('data_penyakit')
                ->where('is_active', '★')
                ->where('id', $key);
            $query_temp = $this->db->get()->row_array();
            $query_temp += ['total_riwayat' => $val];
            array_push($query['total_chart'], $query_temp);
        }
        // Chart - lainnya
        $query['total_chart_lainnya'] = $sisa;

        // Chart - sejak awal bulan
        $query['total_chart_bulanan'] = array();
        $query_temp_all2 = 0;
        foreach ($query['total_chart'] as $tcl) {
            $id_penyakit_now = $tcl['id'];
            $this->db->from('data_riwayat')
                ->where('id_penyakit is NOT NULL', NULL, FALSE)
                ->where('MONTH(date_created) = ' . $month . ' AND YEAR(date_created) = ' . $year)
                ->where('id_penyakit', $id_penyakit_now);
            $get = $this->db->get();
            $query_temp2 = $get->result_array();
            $query_temp_all2 += $get->num_rows();
            array_push($query['total_chart_bulanan'], count($query_temp2));
        }
        // $this->db->select('id_penyakit')
        //     ->from('data_riwayat')
        //     ->where('id_penyakit is NOT NULL', NULL, FALSE)
        //     ->where('MONTH(date_created) = ' . $month . ' AND YEAR(date_created) = ' . $year);
        // $get = $this->db->get();
        // $query_temp_all2 = $get->num_rows();
        // $query_temp2 = $get->result_array();
        // $query['total_chart_bulanan'] = $this->_aktifitas_user($query_temp2, 'id_penyakit', $total_show);
        // rsort($query['total_chart_bulanan']); //Biar key kereset valuenya

        $sisa = $query_temp_all2; //Sisa yang lain
        foreach ($query['total_chart_bulanan'] as $key => $val) {
            $sisa -= $val;
        }
        // Chart - lainnya
        $query['total_chart_lainnya_bulanan'] = $sisa;

        return $query;
    }

    // ========================================== User ==========================================
    // Init User
    var $colOrderUser = array('id', 'name', 'username', 'is_active', 'date_created');
    var $orderUser = array('id', 'name', 'username', 'is_active', 'date_created');
    // DataTable Penyakit
    private function _getDataQuery_user()
    {
        $this->db->from($this->t_user);
        $this->db->where('role_id >', 2);
        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('name', $_POST['search']['value']);
            $this->db->or_like('username', $_POST['search']['value']);
            $this->db->or_like('is_active', $_POST['search']['value']);
            $this->db->group_end();
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->orderUser[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'ASC');
        }
    }
    function getDataTable_user()
    {
        $this->_getDataQuery_user();
        if (@$_POST['length'] != -1) {
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function countFilteredData_user()
    {
        $this->_getDataQuery_user();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAllAData_user()
    {
        $this->db->from($this->t_user);
        return $this->db->count_all_results();
    }
    // Toggle User
    function toogleUser($id)
    {
        $this->db->select('is_active');
        $this->db->from($this->t_user);
        $this->db->where('id', $id);
        $is_active = $this->db->get()->row()->is_active;

        $new_active = 1;
        if ($is_active == 1) {
            $new_active = 0;
        }

        $this->db->update($this->t_user, ['is_active' => $new_active], ['id' => $id]);
        return $this->db->affected_rows();
    }
    // Reset Password
    function resetPw($id, $pw)
    {
        $this->db->update($this->t_user, ['password' => $pw], ['id' => $id]);
        return $this->db->affected_rows();
    }


    // ========================================== RIWAYAT ==========================================
    // Init Riwayat
    var $colOrderRiwayat = array('', 'c.username', 'b.id', 'b.nama_penyakit', 'a.persentase', 'a.date_created');
    var $orderRiwayat = array('', 'c.username', 'b.id', 'b.nama_penyakit', 'a.persentase', 'a.date_created');
    var $show_all = true;
    // DataTable Penyakit
    private function _getDataQuery_riwayat()
    {
        $this->db->select([
            // tabel data_riwayat
            'a.id AS id_r', 'a.persentase', 'a.date_created',
            // tabel penyakit
            'b.id AS id_p', 'b.nama_penyakit',
            // tabel user
            'c.id AS id_u', 'c.username', 'c.role_id'
        ])
            ->from('data_riwayat a')
            ->join('data_penyakit b', 'a.id_penyakit = b.id', 'left')
            ->join('user c', 'a.id_user = c.id', 'left');
        if ($this->show_all == false) $this->db->where('a.id_penyakit is NOT NULL', NULL, FALSE); //Case
        if (isset($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('c.username', $_POST['search']['value']);
            $this->db->or_like('b.id', $_POST['search']['value']);
            $this->db->or_like('b.nama_penyakit', $_POST['search']['value']);
            $this->db->or_like('a.persentase', $_POST['search']['value']);
            $this->db->group_end();
        }
        if (@isset($_POST['order'])) {
            $this->db->order_by($this->orderRiwayat[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('a.date_created', 'DESC');
        }
    }
    function getDataTable_riwayat($case)
    {
        if ($case == true) $this->show_all = true;
        if ($case == false) $this->show_all = false;
        $this->_getDataQuery_riwayat();
        if (@$_POST['length'] != -1) {
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function countFilteredData_riwayat()
    {
        $this->_getDataQuery_riwayat();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAllAData_riwayat()
    {
        $this->db->from($this->t_riwayat);
        return $this->db->count_all_results();
    }
}
