<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/icons/logo.png" />

    <!-- Gstatic -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="<?= base_url('assets'); ?>/css/gstatic.css" rel="stylesheet">

    <title>
        <?= $title; ?>
    </title>

    <!-- Jquery -->
    <script src="<?= base_url('assets'); ?>/js/jquery3-7-0.js"></script>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets'); ?>/css/bootstrap5-3-0.min.css" rel="stylesheet">

    <!-- Template -->
    <link href="<?= base_url('assets'); ?>/css/light.css" rel="stylesheet">

    <!-- Font Awsome -->
    <link href="<?= base_url('assets/plugins/font-awesome-pro-5/css/all.min.css'); ?>" rel="stylesheet">

    <!-- SweetAlert2 -->
    <!-- <script src="<?= base_url('assets'); ?>/js/sweetalert2.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr -->
    <link href="<?= base_url('assets/plugins/toastr/toastr.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">

    <!-- JqueryValidation -->
    <script src="<?= base_url('assets'); ?>/js/validate.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/validate.js"></script>

    <!-- TippyJs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.css" integrity="sha512-HbPh+j4V7pXprvQMt2dtmK/zCEsUeZWYXRln4sOwmoyHPQAPqy/k9lIquKUyKNpNbDGAY06UdiDHcEkBc72yCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/border.min.css" integrity="sha512-5oWooerwnfAs0CTa2UNYOUuYqAGaOmfRiK2e2F8Zm92zYr2SWH5alg0n0oIYzZTQwijWEoRVLbfPHLPMk9f5yw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/svg-arrow.min.css" integrity="sha512-ymN7o+FS8QZbFrwWACqZtheeTIk1zdbp7Rlz3ioSay7zdaskEVInnfm/QkKuJnZvNI0rWiUDQWG63nDdj78shg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.css" integrity="sha512-HbPh+j4V7pXprvQMt2dtmK/zCEsUeZWYXRln4sOwmoyHPQAPqy/k9lIquKUyKNpNbDGAY06UdiDHcEkBc72yCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/animations/shift-away-extreme.min.css" integrity="sha512-WRBHfZZdM7dU2qv/tYvgORDGfyuAYqOFvD3DtNaN6qF0wr0LMKJgKD2nJTWczx3RRc0f7moyMZs4gRSmCcfWHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CropperJs -->
    <link href="<?= base_url('assets'); ?>/css/cropper.css" rel="stylesheet" />
    <script src="<?= base_url('assets'); ?>/js/cropper.js"></script>

    <!-- SlickJs -->
    <link href="<?= base_url('assets/plugins/slick/slick.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/slick/slick-theme.css'); ?>" rel="stylesheet">

    <!-- Magnific Popup -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link href="<?= base_url('assets'); ?>/css/magnific-popup.css" rel="stylesheet">

    <!-- Datatable -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.css" />

    <!-- Custom -->
    <link href="<?= base_url('assets'); ?>/css/custom-all.css" rel="stylesheet">
    <style>
        .swal2-popup {
            font-size: 0.9rem !important;
        }

        .swal2-title {
            font-size: 0.9rem !important;
        }
    </style>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <!-- Buat inisialisasi di js -->
    <input href="" class="d-none" id="baseUrl" name="baseUrl" value="<?= base_url(); ?>"></input>
    <div class="wrapper">