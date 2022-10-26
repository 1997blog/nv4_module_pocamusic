
<!-- BEGIN: main -->
<table id="customers">
  <thead>
      <tr>
          <th style="text-align: center;">
              {LANG.stt}
          </th>
          <th style="text-align: center;">
              {LANG.tencasi}
          </th>
          <th style="text-align: center;">
              {LANG.thoigianthem}
          </th>
          <th style="text-align: center;">
              {LANG.thoigianupdate}
          </th>
          <th style="text-align: center;">
              {LANG.edit}
          </th>
          <th style="text-align: center;">
              {LANG.delete}
          </th>
      </tr>
  </thead>
  <tbody>
      
  <!-- BEGIN: loop -->
      <tr>
          <td>
              {NUMBER}
          </td>
          <td>
              {TEST.TENCASI}
          </td>
          <td>
              {TEST.ADDTIME}
          </td>
          <td>    
              {TEST.UPDATETIME}
          </td>
          <td class="text-center">
              <a href="{ROW1.link_edit}" title="Chỉnh sửa"><em class="fa fa-edit fa-lg">&nbsp;</em></a>
          </td>
          <td class="text-center">   
              <a href="{ROW.link_delete}" onclick="alert('Xóa ca sĩ thành công');" title="Xóa" ><em class="fa fa-trash-o fa-lg">&nbsp;</em></a>
          </td>
      </tr>
  <!-- END: loop -->
  </tbody>
</table>
<br><br>
<form action="{ACTION}" method="POST" class="confirm-reload">
  <input name="save" type="hidden" value="1" />
  <input type="hidden" value="{ISCOPY}" name="copy" />
  <div class="row">
      <div class="col-sm-24 col-md-18">
          <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                  <colgroup>
                      <col class="w200" />
                      <col />
                  </colgroup>
                  <tbody>
                      <tr >
                          <td class="text-right"> <span>{LANG.tencasi}</span> <sup class="required">(*)</sup></td>
                          <td class=" d-flex" style=" border: none; ">
                            <input class=" form-control pull-left" type="text" value="" name="tencasi" id="idtencasi" maxlength="250" />&nbsp;
                          </td>
                          <td><div class="row text-center "><input type="submit" name="dongy" value="{LANG.save}" class="btn btn-primary"/></td>
                      </tr>                  
                  </tbody>
              </table>
          </div>
      </div>
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
  
</style>

<!-- END: main -->
