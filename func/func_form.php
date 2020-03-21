<?php
function buka_form($link, $id, $aksi)
{
	echo '<form method="post" action="' . $link . '&show=action" class="form-horizontal" enctype="multipart/form-data" style="padding:10px">
			<input type="hidden" name="id" value="' . $id . '">
			<input type="hidden" name="aksi" value="' . $aksi . '">';
}

function buka_form_modals($link, $id, $aksi)
{
	echo '<form method="post" id="' . $link . '" class="form-horizontal"  style="padding:10px">
			<input type="hidden" name="id_product" value="' . $id . '">
			<input type="hidden" name="aksi_modals" value="' . $aksi . '">';
}

function buat_notag($label, $nilai, $lebar='4'){
	echo'<div class="form-group row">
			<label class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
				<b>'.$nilai.'</b>
			</div>
		 </div>
		 ';
}

function buat_textbox($label, $nama, $nilai, $place, $required="", $tipe = "text")
{
	if($required=="required"){
		$span = '<span style="color:red">*</span>';
	} else {
		$span = "";
	}
	echo '<div class="form-group">
		<label for="' . $nama . '">' . $label . ' '.$span.'</label>
		<input type="' . $tipe . '" id="' . $nama . '" class="form-control" name="' . $nama . '" value="' . $nilai . '" placeholder="' . $place . '"  '.$required.'>
		</div>';
}

function buat_datemask($label, $nama, $nilai, $required="", $tipe = "text")
{
	if($required=="required"){
		$span = '<span style="color:red">*</span>';
	} else {
		$span = "";
	}
	echo '<div class="form-group">
		<label for="' . $nama . '">' . $label . ' '.$span.'</label>
		<input id="' . $nama . '" type="' . $tipe . '" class="form-control" name="' . $nama . '" value="' . $nilai . '" placeholder="dd/mm/yyyy" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask '.$required.'>
		</div>';
}

function buat_rowtabsbuka(){
    echo'
    <div class="form-group row">
    ';
}
function buat_rowtabstutup(){
    echo'
    </div>
    ';
}
function buat_label($label, $lebar){
    echo'
    <label class="col-sm-'.$lebar.'" control-label">'.$label.'</label>
    ';
}
function buat_col($nilai, $lebar){
    echo'
    <div class="col-sm-'.$lebar.'">'.$nilai.'</div>
    ';
}
function buat_tag($label, $nilai, $lebar='4'){
	echo'<div class="form-group">
			<label class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">'.$nilai.'</div>
		 </div>
		 ';
}


function buat_time($label, $nama, $nilai, $place, $tipe = "text")
{
	echo '<div class="form-group">
		<label for="' . $nama . '">' . $label . '</label>
		<div class="input-group date" id="' . $nama . '" data-target-input="nearest">
		<input type="' . $tipe . '" id="' . $nama . '" class="form-control datetimepicker-input" data-target="#' . $nama . '" data-toggle="datetimepicker" name="' . $nama . '" value="' . $nilai . '" placeholder="' . $place . '">
		</div>
		<script>
		$(function () {
			$("#' . $nama . '").datetimepicker({
				format: "LT"
			})
		})
		</script>
		</div>';
}
function buat_tinymce($label, $nama, $nilai, $place, $required="", $class = '')
{
	if($required=="required"){
		$span = '<span style="color:red">*</span>';
	} else {
		$span = "";
	}
	echo '<div class="form-group">
			<label>' . $label . ' '.$span.'</label>
			<textarea name="' . $nama . '" class="form-control ' . $class . '" placeholder="' . $place . '" '.$required.'>' . $nilai . '</textarea>
		 </div>
		 ';
}
function buat_textarea($label, $nama, $nilai, $place)
{
	echo '<div class="form-group">
			<label>' . $label . '</label>
			<textarea name="' . $nama . '" class="form-control" placeholder="' . $place . '">' . $nilai . '</textarea>
		 </div>
		 ';
}

function buat_inlinebuka()
{
	echo '<div class="form-group row">';
}
function buat_inlinebuka_col($col = "3")
{
	echo '<div class="col-md-' . $col . '">';
}
function buat_inline($label, $nama, $nilai, $place, $required="", $tipe = "text")
{
	if($required=="required"){
		$span = '<span style="color:red">*</span>';
	} else {
		$span = "";
	}
	echo '
            <label for="' . $nama . '" >' . $label . ' '.$span.'</label>
            <input type="' . $tipe . '" id="' . $nama . '" class="form-control" name="' . $nama . '" value="' . $nilai . '" placeholder="' . $place . '" '.$required.'>
        
    ';
}
function buat_inline_multi_select($label, $label_modals, $toggle, $target, $nama, $list, $nilai, $place, $required="")
{
	if($required=="required"){
		$span = '<span style="color:red">*</span>';
	} else {
		$span = "";
	}
	echo '	
            <label for="' . $nama . '" >' . $label . ' <a href="#" data-toggle="'.$toggle.'" data-target="'.$target.'">'.$label_modals.'</a> '.$span.'</label>
			<select id="' . str_replace("[]","",$nama) . '" name="' . $nama . '" class="select2" multiple="multiple" data-placeholder="' . $place . '" style="width: 100%;" '.$required.'>';

			$exnilai = explode(",", $nilai);

			foreach($list as $ls) {
				$select = in_array($ls['val'], $exnilai) ? 'selected' : '';
				echo '
				<option value="'.$ls['val'].'" ' . $select . '>
					'.$ls['cap'].'
				</option>
				';
			}

			// if (strpos($nilai, ',') == true) {
			// 	$ex = explode(",", $nilai);
			// 	foreach ($ex as $v) {
			// 		$select = $list[$v]['val'] == $v ? 'selected' : '';
			// 		echo '<option value=' . $list[$v]['val'] . ' ' . $select . '>' . $list[$v]['cap'] . '</option>';
			// 	}
			// 	foreach ($list as $ls) {
			// 		echo '<option value=' . $ls['val'] . ' >' . $ls['cap'] . '</option>';
			// 	}
			// } else {
			// 	foreach ($list as $ls) {
			// 		$select = $ls['val'] == $nilai ? 'selected' : '';
			// 		echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
			// 	}
			// }
			
	echo '	</select>';
}
function buat_inline_select($label, $nama, $list, $nilai, $required="")
{
	if($required=="required"){
		$span = '<span style="color:red">*</span>';
	} else {
		$span = "";
	}
	echo '
		<div class="form-group">
            <label for="' . $nama . '" >' . $label . ' '.$span.'</label>
			<select id="' . $nama . '" name="' . $nama . '" class="form-control select2" style="width: 100%;" '.$required.'>';
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value="' . $ls['val'] . '" ' . $select . '>' . $ls['cap'] . '</option>';
	}
	echo '	</select>
		</div>
	';
}

function buat_inline_product($label, $nama, $list, $nilai, $required="")
{
	if($required=="required"){
		$span = '<span style="color:red">*</span>';
	} else {
		$span = "";
	}
	echo '
		<div class="form-group">
            <label for="' . $nama . '" >' . $label . ' '.$span.'</label>
			<select id="' . $nama . '" name="' . $nama . '" class="form-control select2" style="width: 100%;" '.$required.'>';
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value="' . $ls['val'] . '" harga="' . $ls['harga'] . '" income="' . $ls['income'] . '" ' . $select . '>' . $ls['cap'] . '</option>';
	}
	echo '	</select>
		</div>
	';
}

function buat_modals($id_product, $id_modals, $title, $label, $name, $place, $html)
{
	echo '
	<div id="'.$id_modals.'" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">'.$title.'</h4>
				</div>
				<div class="modal-body">
					<form method="post" id="insert_form_'.$id_modals.'">
						<input type="hidden" name="aksi_modals" value="'.$id_modals.'" />
						<input type="hidden" name="id_product" value="'.$id_product.'" />
						<label>'.$label.'</label>
						<input type="text" name="'.$name.'" id="'.$name.'" class="form-control" placeholder="'.$place.'" />
						
						<br />
						<input type="submit" name="insert_'.$id_modals.'" id="insert_'.$id_modals.'" value="Insert" class="btn btn-success" />

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script>  
		$(document).ready(function(){
			$("#insert_form_'.$id_modals.'").on("submit", function(e){  
				e.preventDefault();  
				if($("#'.$name.'").val() == ""){  
					alert("'.$label.' wajib diisi.");  
				} else {  
					$.ajax({  
						url:"../ajax/admin/insert-modal.php",  
						method:"POST",  
						data:$("#insert_form_'.$id_modals.'").serialize(),  
						beforeSend:function(){  
							$("#insert_'.$id_modals.'").val("Inserting");  
						},  
						success:function(data){  
							$("#insert_form_'.$id_modals.'")[0].reset();  
							$("#'.$id_modals.'").modal("hide");  
							$("#'.$html.'").html(data);  
							alert("Sukses tambah '.$label.'");
						}  
					});  
				}  
			});
		});
	</script>
	
	';
}

function buat_modals_category($id_product, $id_modals, $title, $label, $name, $name2 ,$place, $html)
{
	echo '
	<div id="'.$id_modals.'" class="modal fade">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">'.$title.'</h4>
				</div>
				<div class="modal-body">
				<iframe id="iframe-category" width="100%" height="400px" src="'.base_url("index.php?content=category-product&show=form").'">
					<p>Your browser does not support iframes.</p>
				  </iframe>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	</script>
	<script>  
		$(document).ready(function(){
			$("#'.$id_modals.'").on("hidden.bs.modal", function() {
				$.ajax({  
					url:"../ajax/admin/insert-modal.php",  
					method:"POST",  
					data: {
						aksi_modals: "'.$id_modals.'",
						id_product: "'.$id_product.'",
					},  
					success:function(data){  
						var iframe = document.getElementById("iframe-category");
						iframe.src = iframe.src;
						$("#iframe-category").attr("src", $("#iframe-category").attr("'.base_url("index.php?content=category-product&show=form").'");
						$("#'.$html.'").html(data);  
					}  
				});
							
			});
		});
	</script>
	
	';
}

function buat_inline_select_kecamatan($label, $nama, $list, $nilai)
{
	echo '
            <label for="' . $nama . '" >' . $label . '</label>
			<select id="'.$nama.'" name="' . $nama . '" class="form-control select2" style="width: 100%;">';
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
	}
	echo '	</select>';
}
function buat_option_select_kecamatan($list, $nilai)
{
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
	}
}
function buat_inlinetutup_col()
{
	echo '</div>';
}
function buat_inlinetutup()
{
	echo '</div>';
}

function buat_combobox_biasa($label, $nama, $list, $nilai, $lebar = '4')
{
	echo '<div class="form-group" id="' . $nama . '">
			<label for="' . $nama . '" class="control-label">' . $label . '</label>
			<div class="col-sm-' . $lebar . '">
			  <select class="form-control" name="' . $nama . '">';
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
	}
	echo '	  </select>
			</div>
		 </div>';
}


function buat_combobox($label, $nama, $list, $nilai, $lebar = '4')
{
	echo '<div class="form-group" id="' . $nama . '">
			<label for="' . $nama . '" class="control-label">' . $label . ' (<a href="?content=kategori-program">Buat kategori baru</a>)</label>
			<div class="col-sm-' . $lebar . '">
			  <select class="form-control" name="' . $nama . '">';
	foreach ($list as $ls) {
		$select = $ls['val'] == $nilai ? 'selected' : '';
		echo '<option value=' . $ls['val'] . ' ' . $select . '>' . $ls['cap'] . '</option>';
	}
	echo '	  </select>
			</div>
		 </div>';
}


function buat_imagepicker($label, $nama, $nilai, $lebar = '4')
{
	?>
	<script type="text/javascript">
		$(function() {
			$('#modal-<?php echo $nama; ?>').on('hidden.bs.modal', function(e) {
				var url = $('#<?php echo $nama; ?>').val();
				if (url != "") $('.tampil-<?php echo $nama; ?>').html('<img src="../images/thumbs/' + url + '" width="150" style="margin-bottom: 10px">');
			})
			$('#modal-<?php echo $nama; ?>').on('click', function() {
				$('#modal-<?php echo $nama; ?>').modal("hide");
			})
		});
	</script>
<?php
	echo '<div class="form-group imagepicker">
			<label for="' . $nama . '" class="col-sm-' . $lebar . ' control-label">' . $label . ' </label>
			<div class="col-sm-' . $lebar . '">
			<div class="tampil-' . $nama . '">';
	if ($nilai != "") echo '<img src="../images/thumbs/' . $nilai . '" width="150" style="margin-bottom: 10px">';
	echo '	</div>
			<div class="input-group">
			  <input type="text" class="form-control input-' . $nama . '" id="' . $nama . '" name="' . $nama . '" value="' . $nilai . '" readonly>
			  <a data-toggle="modal" data-target="#modal-' . $nama . '" class="input-group-addon btn btn-success pilih-' . $nama . '">...</a>
			</div>
			</div>
			<div class="modal fade" id="modal-' . $nama . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-dialog modal-lg" style="max-width: 1200px;">
					<div class="modal-content">
						<div class="modal-header" style="min-height: 16.43px;padding: 15px;border-bottom: 1px solid #e5e5e5;display:block">
							<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">File Manager</h4>
						</div>
						<div class="modal-body">
							<iframe src="../filemanager/dialog.php?type=1&field_id=' . $nama . '&relative_url=1" width="100%" height="500" style="border: 0"></iframe>
						</div>
					</div>
				</div>
			</div>
		 </div>';
}

function tutup_form($link)
{
	echo '<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="' . $link . '">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a>
			</div>
		</div>
	</form>';
}

function tutup_form_modals()
{
	echo '<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
			</div>
		</div>
	</form>';
}
?>