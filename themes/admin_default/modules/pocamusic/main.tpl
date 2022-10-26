<!-- BEGIN:main -->

<div class="well">
    <form action="{ACTION}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <p>
                    Sắp xếp theo trạng thái:
                </p>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group">
                    <select class="form-control" name="stype">
                        <option value="2">--- Hiển thị tất cả ---</option>
                        <option value='1'>Hiển thị</option>
                        <option value='0'>Ẩn</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <p>
                    Sắp xếp theo ca sĩ:
                </p>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group">
                    <select class="form-control" name="singer">
                        <option value="0">--- Hiển thị tất cả ---</option>
                        <!-- BEGIN:loopSinger -->
                        <option value='{SINGER.IDCASI}'> {SINGER.TENCASI} </option>
                        <!-- END:loopSinger -->
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <p>
                    {LANG.search_key}:
                </p>
            </div>
            <div class="col-xs-12 col-md-4">
                <input class="form-control" id="idtimkiem" type="text" name="timkiem" style="width: 265px" />
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{LANG.search}">
                </div>
            </div>
        </div>
    </form>
</div>


<table id="customers">
    <thead>
        <tr>
            <th style="text-align: center;">
                {LANG.stt}
            </th>
            <th style="text-align: center;">
                {LANG.tentheloai}
            </th>
            <th style="text-align: center;">
                {LANG.tencasi}
            </th>
            <th style="text-align: center;">
                {LANG.tenbaihat}
            </th>
            <th style="text-align: center;">
                {LANG.thoigianthem}
            </th>
            <th style="text-align: center;">
                {LANG.thoigianupdate}
            </th>
            <th style="text-align: center;">
                {LANG.music}
            </th>
            <th style="text-align: center;">
                {LANG.namemusic}
            </th>
            <th style="text-align: center;">
                {LANG.img}
            </th>
            <th style="text-align: center;">
                {LANG.trangthai}
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
        <!-- BEGIN: loopp -->
        <tr>
            <td>
                {SONG.IDBAIHAT}
            </td>
            <td>
                {SONG.TENTHELOAI}
            </td>
            <td>
                {SONG.TENCASI}
            </td>
            <td>
                {SONG.TENBAIHAT}
            </td>
            <td>
                {SONG.ADDTIME}
            </td>
            <td>
                {SONG.UPDATETIME}
            </td>
            <td class="w50">
                <audio controls>
                    <source src="{NV_URL}/music/{SONG.PART}" type="audio/mpeg">
                </audio>
            </td>
            <td>
                {SONG.PART}
            </td>
            <td>
                <img src="{SONG.image}" alt="Girl in a jacket" width="100" height="100">
            </td>
            <td>
                {PUBLISH}
            </td>
            <td class="text-center">
                <a href="{ROW1.link_edit}" title="Chỉnh sửa"><em class="fa fa-edit fa-lg">&nbsp;</em></a>
            </td>
            <td>
                <a href="{ROW.link_delete}" onclick="alert('Xóa bài hát thành công');" title="Xóa"><em
                        class="fa fa-trash-o fa-lg">&nbsp;</em></a>
            </td>
        </tr>
        <!-- END: loopp -->
    </tbody>
</table>

<!-- END:main -->