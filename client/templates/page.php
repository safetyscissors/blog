<?php
	$serverPageUrl='http://localhost:8888/blog/server/page?pagename='.$_GET['path'];
	$serverAuthUrl='http://localhost:8888/blog/server/auth';
	//if its main, dont load a page.
	if($_GET['path']=='') return;
	if($_GET['path']=='admin') return;
	if($_GET['path']=='blog') return;

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
			return "<input id='update".$fieldName."' type='text' value='".$pageRef->$fieldName."'>";
		}else{
			return "<textarea name='updateHtml' id='updateHtml'>".$pageRef->$fieldName."</textarea>";
		}


	}
?>

<div id="pageLive">
	<div id="pageActionBar" class="col-md-12" style="background:lightblue"></div>
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

<script src="ckeditor/ckeditor.js"></script>
<script src="client/js/page.js"></script>
<script>
var editor;
	<?php if($edit) echo 'editor = CKEDITOR.replace("updateHtml"); ';?>
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
</script>