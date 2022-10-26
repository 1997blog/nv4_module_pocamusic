<!-- BEGIN:main -->


<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

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
                    <input class="btn btn-primary" type="submit" value="{LANG.search}" onclick="timKiem()">
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
        <!-- BEGIN: searchSong -->
        <tr>
            <td>
                {NUMBER}
            </td>
            <td>
                {SEARCH.TENTHELOAI}
            </td>
            <td>
                {SEARCH.TENCASI}
            </td>
            <td>
                {SEARCH.TENBAIHAT}
            </td>
            <td>
                {SEARCH.ADDTIME}
            </td>
            <td>
                {SEARCH.UPDATETIME}
            </td>
            <td class="w50">
                <audio controls>
                    <source src=" ../uploads/music/{SEARCH.PART}" type="audio/mpeg">
                </audio>
            </td>
            <td>
                {SEARCH.PART}
            </td>
            <td>
                <img src="../uploads/image/{SEARCH.IMAGE}" alt="Girl in a jacket" width="100" height="100">
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
        <!-- END: searchSong -->
    </tbody>

    <tbody>
        <!-- BEGIN: loopListPublish -->
        <tr>
            <td>
                {NUMBER}
            </td>
            <td>
                {LISTPUBLISH.TENTHELOAI}
            </td>
            <td>
                {LISTPUBLISH.TENCASI}
            </td>
            <td>
                {LISTPUBLISH.TENBAIHAT}
            </td>
            <td>
                {LISTPUBLISH.ADDTIME}
            </td>
            <td>
                {LISTPUBLISH.UPDATETIME}
            </td>
            <td class="w50">
                <audio controls>
                    <source src=" ../uploads/music/{LISTPUBLISH.PART}" type="audio/mpeg">
                </audio>
            </td>
            <td>
                {LISTPUBLISH.PART}
            </td>
            <td>
                <img src="../uploads/image/{LISTPUBLISH.IMAGE}" alt="Girl in a jacket" width="100" height="100">
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
        <!-- END: loopListPublish -->
    </tbody>

    <tbody>
        <!-- BEGIN: loopListSinger -->
        <tr>
            <td>
                {NUMBER}
            </td>
            <td>
                {LISTSINGER.TENTHELOAI}
            </td>
            <td>
                {LISTSINGER.TENCASI}
            </td>
            <td>
                {LISTSINGER.TENBAIHAT}
            </td>
            <td>
                {LISTSINGER.ADDTIME}
            </td>
            <td>
                {LISTSINGER.UPDATETIME}
            </td>
            <td class="w50">
                <audio controls>
                    <source src=" ../uploads/music/{LISTSINGER.PART}" type="audio/mpeg">
                </audio>
            </td>
            <td>
                {LISTSINGER.PART}
            </td>
            <td>
                <img src="../uploads/image/{LISTSINGER.IMAGE}" alt="Girl in a jacket" width="100" height="100">
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
        <!-- END: loopListSinger -->
    </tbody>

</table>

<!-- END:main -->