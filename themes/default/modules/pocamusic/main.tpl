<!-- BEGIN:main -->
<!-- BEGIN: loop -->
<div class="panel panel-default">
    <div class="panel-body">
        <a href="{CAT.link}" title="{CAT.tentheloai}" class="song__image">
            <img  alt="{CAT.tentheloai}" src="{CAT.image}" width="100px" class="img-thumbnail pull-left imghome" />
        </a>
        <h3 class="song__title">
            <a href="{CAT.link}" title="{CAT.tentheloai}">{CAT.tentheloai}</a>
        </h3>
        <div class="text-muted">
            <ul class="list-unstyled list-inline">
                <li><em class="fa fa-clock-o">&nbsp;</em>Ngày phát hành: {CAT.add_time}</li>
                <li><em class="fa fa-clock-o">&nbsp;</em>Ngày cập nhật: {CAT.update_time}</li>
            </ul>
        </div>
    </div>
</div>
<!-- END: loop -->
<!-- BEGIN: generate_page -->
<div class="clearfix"></div>
<div class="text-center">
    {GENERATE_PAGE}
</div>
<!-- END: generate_page -->
<!-- END:main -->