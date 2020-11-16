<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- DataTable -->
<script async src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<!-- bootstrap -->
<script src="{{ asset('/componentes/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.js"></script>

<script src="{{ asset('/componentes/toastr/js/toastr.min.js') }}"></script>

<!-- Configuracion de Toastr -->
<script>
	toastr.options = {
		"closeButton": true,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "3000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	
	function mensajeEmergente(titulo, mensaje, tipo ='success')
	{
		toastr[tipo](mensaje, titulo)
	}
</script>