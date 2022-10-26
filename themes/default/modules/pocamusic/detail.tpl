<!-- BEGIN:main -->

    <link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/pocamusic/plugins/css/style.css">
    <link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/pocamusic/plugins/css/reponinesive.css">
    <link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/pocamusic/plugins/css/clock.css">
	 <script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/pocamusic/plugins/js/java.js"></script>
	<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/pocamusic/plugins/js/clock.js"></script>
        <video class="video" autoplay loop muted  play-inline>
        <source src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/pocamusic/plugins/image/bg-image.mp4" type="" >
         </video>
  
       <div class="wrapper-body">
        <section>
            <div class="container">
                <div class="icon">
                <span  class="material-symbols-outlined">
                 bedtime
                 </span>
                <span id="sun" class="material-symbols-outlined">
                clear_day
                 </span>
                </div>
                <div class="time">
                    <div class="time-colon">
                        <div class="time-text">
                            <span class="num hour_num">08</span>
                            <span class="text">Hours</span>
                        </div>
                        <span class="colon">:</span>
                    </div>
                    <div class="time-colon">
                        <div class="time-text">
                            <span class="num minutes_num">45</span>
                            <span class="text">Minutes</span>
                        </div>
                        <span class="colon">:</span>
                    </div>
                    <div class="time-colon">
                        <div class="time-text">
                            <span class="num seconds_num">45</span>
                            <span class="text">Seconds</span>
                        </div>
                    </div>
                    <span class="am_pm">AM</span>
                </div>
             </div>
         </section>
      <div class="wrapper">
        <div class="top-bars">
            <span class="material-symbols-outlined">
                expand_more
            </span>
            <span>now playing</span>
            <span class="material-symbols-outlined">
                more_horiz
            </span>
        </div>
        <div class="img-area">
         <img src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/pocamusic/plugins/image/maxresdefault (1).jpg" alt="">
        </div>
        <div class="song-details">
         <div class="name">Harry style</div>
         <div class="atrist">one direction</div>
        </div>
        <div class="progress-area">
           <div class="progress-bars">
            <span></span>
           </div>
           <div class="timer">
            <span class="current">0:20</span>
            <span class="duration">3:40</span>
           </div>
           <audio id="main-audio" src=""></audio>
        </div>
        <div class="controls">
            <span  id="repeat" class="material-symbols-outlined">
                repeat_on
            </span>
            <span id="prev" class="material-symbols-outlined">
                skip_previous
            </span>
            <div class="play-pause">
                <span class="material-symbols-outlined">
                    play_arrow
                 </span>
            </div>
            <span id="next" class="material-symbols-outlined">
                skip_next
             </span>
             <span id="more-music" class="material-symbols-outlined">
                queue_music
             </span>
             <div id="actions">
                <button  type="button" value="0.25">0.25</button>
                <button  type="button" value="0.5">0.5</button>
                <button  type="button" value="0.75">0.75</button>
                <button  type="button" class="active" value="1">Bình thường</button>
                <button  type="button" value="1.25">1.25</button>
                <button  type="button" value="1.50">1.50</button>
                <button  type="button" value="1.75">1.75</button>
              </div>

        </div>
        <div class="music-list">
            <div class="header">
                <div class="row">
                    <span  class="material-symbols-outlined">
                        queue_music
                     </span>
                     <span>music list</span>
                </div>
                <span id="close" class="material-symbols-outlined">
                    close
                    </span>
            </div>
            <ul>
                
            </ul>
      </div>
      </div>
       </div>
<!-- END:main -->