<?php
	$serverPageUrl='http://localhost:8888/blog/server/page?pagename='.$_GET['path'];
	$serverAuthUrl='http://localhost:8888/blog/server/auth';

	//if its a major type, dont load a page.
	if($_GET['path']=='admin') return;
	if($_GET['path']=='blog') return;

	//if its main, load home.
	if($_GET['path']=='') $serverPageUrl.="home";

	//otherwise get page info
	$request=file_get_contents($serverPageUrl);
	$data=json_decode($request);
	if(count($data)==0){
		return include('client/templates/pageNotFound.php');
	}

	$page=$data[0];
	$edit=($_GET['edit']=='true');

	function contentify($pageRef, $editStatus, $fieldName){
		if(!$editStatus){
			return $pageRef->$fieldName;
		}
		
		if($fieldName != 'staticPageHtml'){
			return "<input style='color:#000; width:400px' id='update".$fieldName."' type='text' value='".$pageRef->$fieldName."'>";
		}else{
			return "<textarea name='updateHtml' id='updateHtml'>".$pageRef->$fieldName."</textarea>";
		}
	}
?>
<!--
<div id="pageLive">
	<div id="pageActionBar" class="col-md-12"></div>
	<div id="pageMessages"></div>
	<form id="pageEditForm">
		<input id="pageid" type="hidden" value="<?php echo $page->staticPageId; ?>">
		<input id="editing" type="hidden" value="<?php echo $edit; ?>">
		<div id="editToggle" class="requireLogin">edit:<?php if($edit){echo 'on';}else{echo 'off';}  ?></div>
		<div id="pageTitle"><?php echo contentify($page,$edit,'staticPagePageTitle'); ?></div>
		<div id="pageDesc"><?php echo contentify($page,$edit,'staticPageDesc'); ?></div>
		<div id="pageMenuName"><?php echo contentify($page,$edit,'staticPageMenuName'); ?></div>
		<div id="pageFeature"><?php echo contentify($page,$edit,'staticPageFeature'); ?></div>
		<?php if($edit) echo '<button id="previewButton">preview</button><br>' ?>

		<div id="pageHtmlWrapper"><?php echo contentify($page,$edit,'staticPageHtml'); ?></div>
	</form>

</div>
-->
<div class="row">
  <div id="pageActionBar" class="col-md-12"></div>
  <div id="pageMessages" class="col-md-12"></div>
</div>

<form id="pageEditForm">
<div class="row">
  <input id="pageid" type="hidden" value="<?php echo $page->staticPageId; ?>">
  <input id="editing" type="hidden" value="<?php echo $edit; ?>">
  <input id="updatestaticPageMenuName" type="hidden" value="<?php echo $page->staticPageMenuName; ?>">

  <div id="pageFeature" class="col-md-12">
    <img id="pageFeatureImg" src='<?php echo $page->staticPageFeature; ?>' />
    <div id="pageFeatureFade"></div>
  </div>
  <div id="pageTitle">
    <h1 class="pageTitleText"><strong><?php echo contentify($page,$edit,'staticPagePageTitle'); ?></strong></h1>
    <div id="pageDesc"><?php echo contentify($page,$edit,'staticPageDesc'); ?></div>
    <?php if($edit) echo "<div>".contentify($page,$edit,'staticPageFeature')."</div>"; ?>
  </div>
</div>
<div class="row">
  <div class="col-md-12 spacer" style="height:10%"></div>
  <div id="pageHtmlWrapper" class="col-md-10 col-md-offset-1"><?php echo contentify($page,$edit,'staticPageHtml'); ?></div>

</div>
</form>




<script src="ckeditor/ckeditor.js"></script>
<script src="client/js/page.js"></script>
<script>
var editor;
	<?php if($edit) echo 'editor = CKEDITOR.replace("updateHtml"); ';?>
	if(editor){
    editor.on( 'save', function( evt ) {
      var data={
        pageid:$('#pageid').val(),
        name:$('#updatestaticPageMenuName').val(),
        title:$('#updatestaticPagePageTitle').val(),
        desc:$('#updatestaticPageDesc').val(),
        feature:$('#updatestaticPageFeature').val(),
        html:evt.editor.getData()
      };
      updatePage(data);
      return false;
    });
  }
</script>