
<!-- footer -->
<div class="clear"></div>
<div class="footer">
Copyright &copy; 2014<a href="http://ums.ac.id"> Universitas Muhammadiyah Surakarta</a> <br/>Developed by <a href="http://java.co.id">Ahlul Aryana Aji</a>
</div>
</div>
<!-- Modal Pop Up -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST">
		<div class="fromupdate">
		</div>	
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit"  name="update" class="btn btn-danger">Perbarui</button>
			</div>
		</div>
	</form>
    </div>

    </div>
  </div>
</div>
<!--- Modal Pop Up -->
<script type="text/javascript">
$(function(){
var Height = $('.contain').height();
$('.navigations').css("height",Height+26);
});
</script>
</body>
</html>