
<!-- BEGIN: main -->


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


<form action="{ACTION}" method="POST" class="confirm-reload" name="add_music" enctype="multipart/form-data">
    <input id="is_save" type="hidden" name="idInput" value="{SINGER.IDCASI}" />
    <!-- <input id="is_save" type="hidden" name="path" value="{SONG.PART}" /> -->
    <input type="hidden" value="{ISCOPY}" name="copy" />
    <div class="row">
        <div class="col-sm-24 col-md-18">
            <div class="table-responsive">
                <table class="table" id="customers">
                    <colgroup>
                        <col class="w200" />
                        <col />
                    </colgroup>
                    <thead>
                      <th class="text-center">
                        <b>Danh mục</b>
                      </th>
                      <th class="text-center">
                        <b>Dữ liệu chọn</b>
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-left"> {LANG.tencasi} <sup class="required">(*)</sup></td>
                        <td>
                            <input class="w300 form-control pull-left" type="text" value="{SINGER.TENCASI}" name="tencasi" id="idtencasi" maxlength="250" />&nbsp;
                        </td>
                    </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row text-center"><input type="submit" name="dongy" value="{LANG.save}" class="btn btn-primary"/>
    </div>
  </form>
  <!-- END: main -->
  