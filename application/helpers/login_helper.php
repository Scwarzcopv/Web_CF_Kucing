<?php
function is_log_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('login');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        $id = $ci->session->userdata('id');
        $data = $ci->db->get_where('user', ['id' => $id])->row();

        if ($userAccess->num_rows() < 1 || $data->is_active == 0) {
            redirect('login/blocked');
        }
    }
}

function is_active()
{
    $ci = get_instance();
    if ($ci->session->userdata('username')) {
        $id = $ci->session->userdata('id');
        $data = $ci->db->get_where('user', ['id' => $id])->row();

        if ($data->is_active == 0) {
            redirect('login/blocked');
        }
    }
}

// function is_sidebar_active()
// {
//     $ci = get_instance();
//     $menu = $ci->uri->segment(1);

//     $role_id = $ci->session->userdata('role_id');
//     $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
//     $menu_id = $queryMenu['id'];

//     $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id', 'menu_id' => $menu_id]);

//     if ($result->num_rows() > 0) {
//         return "checked";
//     }
// }

// function check_access($role_id, $menu_id)
// {
//     $ci = get_instance();

//     $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id', 'menu_id' => $menu_id]);

//     if ($result->num_rows() > 0) {
//         return "checked";
//     }
// }
