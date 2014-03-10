<script>
$(function() {
	$(".tool-tip").tooltip({delay: { show: 1000, hide: 100 }});
	$(".alert-success").alert();
	window.setTimeout(function() {$(".alert-success").alert().fadeOut('slow'); $(".alert-success").alert('close'); }, 8000);
});
</script>
</body>
</html>