<!-- <?php echo '<pre>';
print_r($reader_info); 
echo '<pre>';
?> -->
<div class="col-md-3">
    <div class=" card-user">
        <div class="content">

            <div class="row image">
                <img width="100%" src="<?php echo base_url(); ?>assets/img/background.jpg" alt="...">
            </div>
            <div class="row text-center">
                <div class="col-md-1"><a class="last-btn btn text-muted" tabindex="2" onclick="changeAvatar('last')" onkeyup="if(event.keyCode !== 13) return;changeAvatar('last');">&larr;</a></div>
                    <div id="avatar" class="col-md-3 col-md-offset-2">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" data-original-title="click on left/right arrow to select and click on avatar to change" class="red-tooltip" id="select_avatar" onclick="selectAvatar();"><div id="preview"><img id="avatar-image" class="avatar avatar_img border-gray" data-name="" width="100%" src="<?php echo base_url(); ?>assets/avatar/<?php echo (!empty($reader_info->avatar) ? $reader_info->avatar : 'girl.png'); ?>" alt=""></div></a>
                </div>
                <div class="col-md-1 col-md-offset-3"><a class="next-btn btn text-muted" tabindex="3" onclick="changeAvatar('next')" onkeyup="if(event.keyCode !== 13) return;changeAvatar('next');">&rarr;</a></div>
                <div class="row col-lg-10 col-md-offset-1 name-title">
                <div class="twenty_px_height"></div>
                    <h4 class="title"><?php echo $reader_info->first_name . ' ' . $reader_info->last_name; ?><br>
                        <a href="#"><small>since <?php echo date('m/d/Y', strtotime($reader_info->created_on)); ?></small></a>
                    </h4>
                    <br />
                </div>
            </div>

			      <!-- readers badge information -->
            <div class="text-center badges" id="badges">
                <div class="row">
                    <?php if(isset($reader_info->badges) && !empty($reader_info->badges)) {?>
                    <?php foreach ($reader_info->badges as $badges) { ?>
                        <div class="col col-md-3">
                            <img src="<?php echo base_url() . '/assets/icon/' . $badges->badge_img; ?>" alt="<?php echo $badges->title; ?>" />
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <div class="row">
                <div class="col-md-3 col-md-offset-1">
                    <h5><span class="count"><?php echo $reader_info->total_books; ?></span><br><small>books</small></h5>
                </div>
                <div class="col-md-4">
                    <h5><span class="count"><?php echo $reader_info->total_points; ?></span><br><small>points</small></h5>
                </div>
                <div class="col-md-3">
                    <h5><span class="count"><?php echo $reader_info->total_duration; ?></span><br><small>minutes</small></h5>
                </div>
            </div>
        </div>
        <div class="twenty_px_height"></div>
    </div>
</div>

<!-- Save avatar information to Database -->
<script type="text/javascript">
    function selectAvatar() {
        var avatar = document.getElementById("avatar-image").src;

        //console.log(avatar);
        $.ajax({
            type: 'GET', 
            url: "<?php echo base_url(); ?>readers/changeAvatar/?avatar=" + avatar + "&lib_id=<?php echo ($_SESSION['in_sub_domain']['lib_id'] ? $_SESSION['in_sub_domain']['lib_id'] : ''); ?>",
            dataType: "json",
            success: function (json) {
              console.log('success');
            }
        });
    }
</script>
<!-- Tooltip -->
<script type="text/javascript">
  $(document).ready(function(){
      $('a').tooltip();
  });
</script>
<script type="text/javascript">
var preview = document.getElementById("preview");
var avatar = document.getElementById("avatar");

var avatars = {
  srcList: [
  <?php 
    foreach($avatars as $avatars) {
?>
    {
      name: "<?php echo $avatars; ?>",
      src: encodeURIComponent("<?php echo base_url(); ?>assets/avatar/<?php echo $avatars; ?>")
    },
<?php       
    }
?>
  ],
  activeKey: 1,
  add: function(_name, _src){
    this.activeKey = this.srcList.length;
    return (this.srcList.push({name: _name, src: encodeURIComponent(_src)}) - 1);
  },
  
  showNext: function(){
    var _next = this.activeKey + 1;
    if ( _next >= this.srcList.length ) {
      _next = 0;
    }
    this.showByKey(_next);
    
  },
  showLast: function(){
    var _next = this.activeKey - 1;
    if ( _next < 0 ) {
      _next = this.srcList.length - 1;
    }
    this.showByKey(_next);
  },
  showByKey: function(_next) {
    var _on = this.srcList[_next];
    if ( !_on.name ) return;
    
    while(preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }
    
    var img = document.createElement("img");
    img.src = decodeURIComponent(_on.src);
    img.id = "avatar-image";
    img.className = "avatar_img--loading avatar border-gray";
    img.onload = function() {
      img.classList.add("avatar_img");
    }
    
    preview.appendChild(img);
    this.activeKey = _next;
  }
};

function showAvatar(key) {
  if ( !key ) {
    key = avatars.activeKey;
  }
}
function changeAvatar (dir){
  if ( dir === 'next' ) {
    avatars.showNext();
  }
  else {
    avatars.showLast();
  }
};
/*

/** Inline functions */
window.changeAvatar = function(dir){
  if ( dir === 'next' ) {
    avatars.showNext();
  }
  else {
    avatars.showLast();
  }
};
</script>