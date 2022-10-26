
<!-- BEGIN: main -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center w100">{LANG.stt}</th>
                <th class="text-center">{LANG.tentheloai}</th>
                <th class="text-center">{LANG.thoigianthem}</th>
                <th class="text-center ">{LANG.thoigianupdate}</th>
                <th class="text-center w100">{LANG.edit}</th>
                <th class="text-center w100">{LANG.delete}</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: loop1 -->
            <tr>
                <td class="text-center">
                    {NUMBER}
                </td>
                <td>
                    {TEST1.tentheloai}
                </td>
                <td class="text-center">
                    {TEST1.add_time}
                </td>
                <td class="text-center">
                    {TEST1.update_time}
                </td>
                <td class="text-left">
                    <a href="{ROW1.link_edit}" title="Chỉnh sửa"><em class="fa fa-edit fa-lg">&nbsp;</em></a>
                </td>
                <td class="text-center">
                    <a href="{ROW.link_delete}" onclick="alert('Xóa ca sĩ thành công');" title="Xóa" ><em class="fa fa-trash-o fa-lg">&nbsp;</em></a>
                </td>
            </tr>
            <!-- END: loop1 -->
        </tbody>
    </table>
</div>
<br><br>
<form action="{FORM_ACTION}" method="POST" class="confirm-reload">
  <input name="save_cat" type="hidden" value="1" />
  		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<caption>
					<em class="fa fa-file-text-o">&nbsp;</em>{CAPTION}
				</caption>
				<tbody>
					<tr>
						<th class="col-md-4 text-right">{LANG.tentheloai}: <sup class="required">(∗)</sup></th>
						<td class="col-md-20 text-left">
                            <input class="form-control w500" name="tentheloai" type="text" value="{DATA.tentheloai}" maxlength="250" id="idtitle"/><span class="text-middle"> Độ dài ký tự: <span id="titlelength" class="red">0</span> </span>
                        </td>
					</tr>
					<tr>
						<th class="text-right">{LANG.alias}: </th>
						<td>
                            <input class="form-control w500 pull-left" name="alias" type="text" value="{DATA.alias}" maxlength="250" id="idalias"/> 
                            &nbsp;<em class="fa fa-refresh fa-lg fa-pointer text-middle"  onclick="get_alias('{ID}');">&nbsp;</em>
                        </td>
					</tr>
					<tr>
						<th class="text-right">{LANG.img}</th>
						<td>
                            <input class="form-control w500 pull-left" type="text" name="image" id="image" value="{DATA.image}"/> 
                             &nbsp;<input id="select-img-cat" type="button" value="Browse server" name="selectimg" class="btn btn-info" />
                        </td>
					</tr>
				</tbody>
			</table>
		</div>
		<br />
		<div class="text-center">
			<input class="btn btn-primary" name="dongy" type="submit" value="{LANG.save}" />
		</div>
  </div>
</form>

<style>
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }
</style>
<script type="text/javascript">
    var CFG = [];
    CFG.upload_current = '{UPLOAD_CURRENT}';
    CFG.upload_path = '{UPLOAD_PATH}';
    $(document).ready(function() {
        $("#select-img-cat").click(function() {
            console.log('done')
            var area = "image";
            var path = CFG.upload_path;
            var currentpath = CFG.upload_current;
            var type = "image";
            nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
            return false;
        });
        $("#titlelength").html($("#idtitle").val().length);
        $("#idtitle").bind("keyup paste", function() {
            $("#titlelength").html($(this).val().length);
        });
    });
</script>

<!-- BEGIN: get_alias -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#idtitle').change(function() {
            get_alias('{ID}');
        });
    });
</script>
<!-- END: get_alias -->
<!-- END: main -->
