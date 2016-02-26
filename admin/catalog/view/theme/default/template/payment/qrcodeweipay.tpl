	<script type="text/javascript">
		function callpay()
		{
			location.href = "<?php echo $redirect; ?>";
		}
	</script>
  <div class="pull-right">
    <input type="button" onclick="callpay()" value="<?php echo $button_confirm; ?>" id="button-confirm" class="btn btn-primary" />
	</div>
