
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="{{ asset('/componentes/bootstrap/css/bootstrap.min.css') }}">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link type="text/css" href="{{ asset('css/layout-style.css') }}" rel="stylesheet">

<!-- Toastr -->
<link href="{{ asset('/componentes/toastr/css/toastr.min.css') }}" rel="stylesheet">

<style>

	/*Dropdawn header*/
	.dropdown-menu .dropdown-toggle:after{
		border-top: .3em solid transparent;
	    border-right: 0;
	    border-bottom: .3em solid transparent;
	    border-left: .3em solid;
	}
	.dropdown-menu .dropdown-menu{
		margin-left:0; margin-right: 0;
	}
	.dropdown-menu li{
		position: relative;
	}
	.nav-item .submenu{ 
		display: none;
		position: absolute;
		left:100%; top:-7px;
	}
	.nav-item .submenu-left{ 
		right:100%; left:auto;
	}
	.dropdown-menu > li:hover{ background-color: #f1f1f1 }
	.dropdown-menu > li:hover > .submenu{
		display: block;
	}
	.btn-round {
        border-radius: 20px;
        width: 80%;
    }
</style>