<?php

echo '
<div id="alertError" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Erreur</h4>
			</div>
			<div class="modal-body">
				<div id="alert" class="alert alert-danger">
					'.$_SESSION['error'].'
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$( "#alertError" ).modal("show");
</script>';

?>

