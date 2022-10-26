<!-- BEGIN:main -->
    <link rel="stylesheet" href="{NV_BASE_SITEURL}themes/default/modules/pocamusic/plugins/aplayer/APlayer.min.css">
    <div id="aplayer"></div>
	<script src="{NV_BASE_SITEURL}themes/default/modules/pocamusic/plugins/aplayer/APlayer.min.js"></script>
    <script>
        const ap = new APlayer({
            container: document.getElementById('aplayer'),
            loop: 'all',
            preload: 'auto',
            listFolded: false,
            listMaxHeight: 90,
            audio: [
                <!-- BEGIN: loop -->
                {
                    name: '{LISTSONG.tenbaihat}',
                    artist: '{LISTSONG.tencasi}',
                    url: '{LISTSONG.part}',
                    cover: '{LISTSONG.img}'
                },
                <!-- END:loop -->
            ]
        });
    </script>
<!-- END:main -->