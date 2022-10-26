<!-- BEGIN: main -->
<form action="{ACTION}" method="POST" class="confirm-reload" name="add_music" enctype="multipart/form-data">
	<div class="row tab-content">
		<div id="main_content" class="col-sm-24 col-md-24 tab-pane fade in active row">
			<div class="col-xs-24">
				<table class="table table-striped table-bordered">
					<col class="w200" />
					<col />
					<tbody>
						<tr>
							<td><strong>{LANG.tenbaihat}</strong>: <sup class="required">(∗)</sup></td>
							<td><input class="w300 form-control pull-left" type="text" value="{DATA.tenbaihat}" name="tenbaihat"
                                    id="idtitle" maxlength="250" /><span class="text-middle"> {GLANG.length_characters}: <span id="titlelength" class="red">0</span>. {GLANG.title_suggest_max} </span></td>
						</tr>
						<tr>
							<td><strong>{LANG.tencasi}: </strong> <sup class="required">(*)</td>
							<td>
                                <select class="form-control w300" name="cars">
                                    <!-- BEGIN: loop -->
                                    <option value="{TEST.IDCASI}">{TEST.TENCASI}</option>
                                    <!-- END: loop -->
                                </select>
                            </td>
						</tr>
						<tr>
							<td class="top"><strong>{LANG.tentheloai}</strong>:<sup class="required">(*)</sup></td>
							<td>
                                <select class="form-control w300" name="cars1">
                                    <!-- BEGIN: loop1 -->
                                    <option value="{TEST1.IDTHELOAI}">{TEST1.TENTHELOAI}</option>
                                    <!-- END: loop1 -->
                                </select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<table class="table table-striped table-bordered table-hover">
				<col class="w200" />
				<col />
				<tbody>
					<tr>
						<td><strong>{LANG.part}</strong></td>
						<td>
							<input type="file" name="media" > <span class="mt-3">Thông tin file media hiện tai: {DATA.part}</span>
						</td>
					</tr>
                    <tr >
						<td><strong>{LANG.img}</strong>:<sup class="required">(*)</sup></td>
						<td class="d-flex">
                        <input class="form-control w500 pull-left" type="text" name="image" id="image" value="{DATA.img}"/> 
                        &nbsp;<input id="select-img-cat" type="button" value="{LANG.browse_server}" name="selectimg" class="btn btn-info" />
                        </td>
					</tr>
                    <tr>
                            <td>{LANG.publish} <sup class="required">(*)</sup></td>
                            <td>
                                <input type="checkbox" id="idpublish" name="publish" value="1" {CHECKED}>
                                <label> Phát hành </label><br>
                            </td>
                        </tr>
				</tbody>
			</table>
		</div>
	</div>
    <div class="text-center">
		<br/>
        <input id="is_save" name="is_save" type="hidden" value="1" />
        <input type="hidden" value="{ISCOPY}" name="copy" />
		<input type="submit" name="dongy" value="{LANG.save}" class="btn btn-primary" />
		<br />
	</div>
</form>
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
<!-- END: main -->