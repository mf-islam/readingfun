<!-- admin/readers -->

<link rel="stylesheet" media="screen" type="text/css" href="/assets/colorpicker/spectrum.css" />
<script type="text/javascript" src="/assets/colorpicker/spectrum.js"></script>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <form action="/admin/settings/upload_profile_picture" method="post" id="profile-pic-frm" enctype="multipart/form-data">
                <div class="row col-md-10 col-md-offset-1">
                    <div class="col-md-4">
                        <hr>
                    </div>
                    <div class="col-md-4 text-center text-danger">Profile Picture Upload [png only and 64x64]</div>
                    <div class="col-md-4">
                        <hr>
                    </div>
                    <div class="twenty_px_height"></div>
                    <div class="clearfix"></div>
                    <div class="twenty_px_height"></div>
                    <div class="twenty_px_height"></div>
                </div>
                <div class="row col-md-10 col-md-offset-1">
                    <div class="form-group col-md-8 col-md-offset-2">
                        <div class="file-upload-wrapper" data-text="Select your file!">
                            <input name="logo" type="file" class="form-control file-upload-field" value="">
                        </div>
                        <div class="footer text-center col-md-8 col-md-offset-2">
                            <p><br /><button id="submit" type="submit" class="btn btn-fill btn-danger btn-wd">Submit</button></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty($images)){  ?>
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <?php
                                    foreach($images as $image){
                                ?>
                                    <div class="profile-pic-holder">
                                        <div class="remove-btn-profile-pic" data-link="<?php echo $image; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                        <img src="/<?php echo $image; ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>
</div>

<style>
    .profile-pic-holder{
        border: 1px solid #ddd;
        margin: 14px !important;
        width: 100px;
        height: 100px;
        float: left;
        padding: 16px;
        cursor: pointer;
        position: relative;
    }
    
    .remove-btn-profile-pic{
        width: 10px;
        height: 10px;
        position: absolute;
        top: 0px;
        right: 5px;
    }
    
    .remove-btn-profile-pic:hover{
        color: red;
    }
</style>

<script>
    
    $('.remove-btn-profile-pic').on('click',function(){
        var link = $(this).attr('data-link');
        
        $.ajax({
            type: 'POST',
            url: "removepicture",
            data: {link:link},
            dataType: "json",
            success: function(resultData) {
                location.reload();
            }
        });
    });
    
    
    
$(function(){
    <?php if (isset($_SESSION['message'])): 
    foreach ($_SESSION['message'] as $key => $value) { ?>
      custom.showNotification(
        'danger', 
        '<?php echo $value; ?>',
        'top',
        'center');
    <?php } endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
      custom.showNotification(
        'danger', 
        '<?php echo $_SESSION['error']; ?>',
        'top',
        'center');
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
      custom.showNotification(
        'success', 
        '<?php echo $_SESSION['success']; ?>',
        'top',
        'center');
    <?php endif; ?>
    <?php if (isset($_SESSION['warning'])): ?>
      custom.showNotification(
        'warning', 
        '<?php echo $_SESSION['warning']; ?>',
        'top',
        'center');
    <?php endif; ?>
});
</script>

