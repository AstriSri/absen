<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>SIMPEG</title>

<!-- Custom fonts for this template-->
<link href="{{asset('sbadmin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{asset('sbadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<style>
    .card-header{
        background-image: linear-gradient( #4e73df, #47f);
        color: white;
    }
    
    .card-header .btn-primary{
        background-color: rgb(10, 151, 69);
    }
    .card-header .btn-primary:hover{
        background-color: rgb(10, 255, 70);
    }
</style>
@stack('css')