<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsultasi_model extends CI_Model
{
    // Initial
    var $tableGejala = 'data_gejala';
    var $tablePenyakit = 'data_penyakit';
    var $tableAturan = 'data_aturan';

    // 
    private function _getDataQuery_gejala()
    {
        $this->db->from($this->tableGejala)->where('is_active', '★');
        $this->db->order_by('id', 'ASC');
    }
    private function _getDataQuery_penyakit()
    {
        $this->db->from($this->tablePenyakit)->where('is_active', '★');
        $this->db->order_by('id', 'ASC');
    }
    private function _getDataQuery_aturan()
    {
        $this->db->from($this->tableAturan);
        $this->db->order_by('id', 'ASC');
    }

    function getDataGejala()
    {
        $this->_getDataQuery_gejala();
        $query = $this->db->get();
        return $query->result_array();
    }
    function getDataPenyakit()
    {
        $this->_getDataQuery_penyakit();
        $query = $this->db->get();
        return $query->result_array();
    }
    function getDataAturan()
    {
        $this->_getDataQuery_aturan();
        $query = $this->db->get();
        return $query->result_array();
    }

    function getDataAturan_Penyakit($id_penyakit)
    {
        $this->db->from($this->tableAturan)
            ->where('id_penyakit', $id_penyakit);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getDataGejalabyId($id_gejala)
    {
        $this->db->from($this->tableGejala)
            ->where('id', $id_gejala);
        $query = $this->db->get();
        return $query->result();
    }

    function getInfoRiwayat($id_r)
    {
        // Tabel data_riwayat
        $this->db->select([
            // tabel data_riwayat
            'a.id AS id_r', 'a.persentase',
            // tabel penyakit
            'b.id AS id_penyakit', 'b.nama_penyakit', 'b.detail_penyakit', 'b.saran_penyakit', 'b.img_penyakit'
        ])
            ->from('data_riwayat a')
            ->join('data_penyakit b', 'a.id_penyakit = b.id', 'left')
            ->where('a.id', $id_r);
        $query['data_riwayat'] = $this->db->get()->result_array();

        // Tabel data_riwayat_input
        $this->db->select([
            // tabel data_riwayat
            'a.id AS id_r',
            // Tabel data_riwayat_input
            'b.id AS id_ri', 'b.kondisi',
            // Tabel gejala
            'c.id AS id_g', 'c.nama_gejala'
        ])
            ->from('data_riwayat a')
            ->join('data_riwayat_input b', 'a.id = b.id_riwayat', 'left')
            ->join('data_gejala c', 'b.id_gejala = c.id', 'left')
            ->where('a.id', $id_r);
        $query['data_riwayat_input'] = $this->db->get()->result_array();

        // Tabel data_riwayat_lain
        $this->db->select([
            // Tabel data_riwayat
            'a.id AS id_r',
            // Tabel data_riwayat_lain
            'b.id AS id_rl', 'b.persentase',
            // Tabel penyakit
            'c.id AS id_penyakit', 'c.nama_penyakit', 'c.detail_penyakit', 'c.saran_penyakit', 'c.img_penyakit'
        ])
            ->from('data_riwayat a')
            ->join('data_riwayat_lain b', 'a.id = b.id_riwayat', 'left')
            ->join('data_penyakit c', 'b.id_penyakit = c.id', 'left')
            ->where('a.id', $id_r);
        $query['data_riwayat_lain'] = $this->db->get()->result_array();

        // Return
        return $query;
    }

    function hapusDataRiwayat($where, $data)
    {
        $this->db->update('data_riwayat', $data, $where);
        return $this->db->affected_rows();
    }
}
