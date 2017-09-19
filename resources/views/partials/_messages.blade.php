@if (Session::has('success'))
	<!-- <div class="alert alert-success btn-h1-spacing" role="alert">
		<strong>Success:</strong> {{ Session::get('success') }}
	</div> -->
	<script type="text/javascript">
		alert("The feedback has been successfully submitted");
	</script>
@endif
