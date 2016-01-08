<?php

echo '
<div id="alertSuccess" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Succès</h4>
			</div>
			<div class="modal-body">
				<div id="alert" class="alert alert-success">
					'.$_SESSION['success'].'
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$( "#alertSuccess" ).modal("show");
</script>';

?>

