<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-latest" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
    
    <?php /* <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content"> */ ?>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data"  id="form-myparcel" class="form-horizontal">
                <h3>Settings</h3>
                <table class="form">
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="myparcel_module_username" value="<?php echo $myparcel_module_username; ?>" /></td>
                    </tr>
                    <tr>
                        <td>API key:</td>
                        <td><input type="text" name="myparcel_module_api_key" value="<?php echo $myparcel_module_api_key; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Frontend plugin:</td>
                        <td>
                            <input type="hidden" name="myparcel_module_frontend" value="0" />
                            <input type="checkbox" name="myparcel_module_frontend" value="1" <?php echo ($myparcel_module_frontend == 1 ? ' checked="checked"' : ''); ?> />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php echo $footer; ?>