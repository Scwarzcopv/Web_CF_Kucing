<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InfScrollDiag_model extends CI_Model
{
    function riwayat($limit, $start, $id_user, $keyword, $order)
    {
        // Info user
        $this->db->select('*')
            ->from('user')
            ->where('id', $id_user);
        $user = $this->db->get()->row_array();

        // Jika user search dengan kode penyakit || Pxxx
        // $kode_p = strtolower($keyword);
        // $p_length = strlen($keyword);
        // if ($p_length == 1) { //Pxxx
        //     if ($kode_p[0] === 'p') {
        //         $kode_p = substr($kode_p, 1);
        //     }
        // }
        // if ($p_length >= 2) { //P0xx
        //     if ($kode_p[0] === 'p' && $kode_p[1] === '0') {
        //         $kode_p = 17;
        //     }
        // }
        // if ($p_length > 3) { //P00x
        //     if ($kode_p[0] === 'p' && $kode_p[1] === '0' && $kode_p[2] === '0') {
        //         $kode_p = str_split($kode_p, 3);
        //         $kode_p = $kode_p[1];
        //     }
        // }

        // Setting order
        $pattern = "/[-\s:]/";
        $order = preg_split($pattern, $order);
        $order_col = $order[0];
        $order_by = $order[1];



        // Total Seluruh Data || Ambil data tabel data_riwayat && data_penyakit
        $this->db->select([
            // tabel data_riwayat
            'a.id AS id_r', 'a.persentase', 'a.date_created',
            // tabel penyakit
            'b.id AS id_p', 'b.nama_penyakit'
        ])
            ->from('data_riwayat a')
            ->join('data_penyakit b', 'a.id_penyakit = b.id', 'left')
            ->where('a.id_user', $id_user)
            ->where('a.active', '★');
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // Total Data Search || Ambil data tabel data_riwayat && data_penyakit
        $this->db->select([
            // tabel data_riwayat
            'a.id AS id_r', 'a.persentase', 'a.date_created',
            // tabel penyakit
            'b.id AS id_p', 'b.nama_penyakit'
        ])
            ->from('data_riwayat a')
            ->join('data_penyakit b', 'a.id_penyakit = b.id', 'left')
            ->where('a.id_user', $id_user)
            ->where('a.active', '★')
            ->group_start()
            ->like('b.id', $keyword)
            // ->or_like('b.id', $kode_p)
            ->or_like('persentase', $keyword)
            ->or_like('nama_penyakit', $keyword)
            ->or_like('a.active', $keyword)
            ->group_end();
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();

        // Total Data Search + Limit || Ambil data tabel data_riwayat && data_penyakit
        $this->db->select([
            // tabel data_riwayat
            'a.id AS id_r', 'a.persentase', 'a.date_created',
            // tabel penyakit
            'b.id AS id_p', 'b.nama_penyakit'
        ])
            ->from('data_riwayat a')
            ->join('data_penyakit b', 'a.id_penyakit = b.id', 'left')
            ->where('a.id_user', $id_user)
            ->where('a.active', '★')
            ->group_start()
            ->like('b.id', $keyword)
            // ->or_like('b.id', $kode_p)
            ->or_like('persentase', $keyword)
            ->or_like('nama_penyakit', $keyword)
            ->or_like('a.active', $keyword)
            ->group_end()
            ->order_by($order_col, $order_by)
            ->limit($limit, $start);
        $query['3'] = $this->db->get();
        $query['num_rows_3'] = $query['3']->num_rows();

        return $query;
    }

    function artikel($limit, $start, $keyword, $order)
    {

        // Setting order
        $pattern = "/[-\s:]/";
        $order = preg_split($pattern, $order);
        $order_col = $order[0];
        $order_by = $order[1];



        // Total Seluruh Data || Ambil data tabel data_artikel
        $this->db->select([
            // tabel data_artikel
            'a.id AS id_a', 'a.nama_post', 'a.detail_post', 'a.saran_post', 'a.img_thumbnail', 'a.terakhir_diubah',
        ])
            ->from('data_artikel a');
        $query['1'] = $this->db->get();
        $query['num_rows_1'] = $query['1']->num_rows();

        // Total Data Search || Ambil data tabel data_artikel
        $this->db->select([
            // tabel data_artikel
            'a.id AS id_a', 'a.nama_post', 'a.detail_post', 'a.saran_post', 'a.img_thumbnail', 'a.terakhir_diubah',
        ])
            ->from('data_artikel a')
            ->group_start()
            ->like('a.nama_post', $keyword)
            ->group_end();
        $query['2'] = $this->db->get();
        $query['num_rows_2'] = $query['2']->num_rows();

        // Total Data Search + Limit || Ambil data tabel data_artikel
        $this->db->select([
            // tabel data_artikel
            'a.id AS id_a', 'a.nama_post', 'a.detail_post', 'a.saran_post', 'a.img_thumbnail', 'a.terakhir_diubah',
        ])
            ->from('data_artikel a')
            ->group_start()
            ->like('a.nama_post', $keyword)
            ->group_end()
            ->order_by($order_col, $order_by)
            ->limit($limit, $start);
        $query['3'] = $this->db->get();
        $query['num_rows_3'] = $query['3']->num_rows();

        return $query;
    }
}
