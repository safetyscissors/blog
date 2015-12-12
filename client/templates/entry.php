<?php
	$serverBlogUrl='http://localhost:8888/blog/server/blog?blogid='.$_GET['id'];
	$serverAuthUrl='http://localhost:8888/blog/server/auth';
	//if its main, dont load a blog.
	if($_GET['path']!='blog') return;

	//otherwise get blog entry info
	$request=file_get_contents($serverBlogUrl);
	$data=json_decode($request);
	if(count($data)==0){
		return include('client/templates/pageNotFound.php');
	}
	$blog=$data[0];
	$edit=($_GET['edit']=='true');

	function contentifyBlog($blogRef, $editStatus, $fieldName){
		if(!$editStatus){
			return $blogRef->$fieldName;
		}
		
		if($fieldName != 'blogHtml'){
			return "<input id='update".$fieldName."' type='text' value='".$blogRef->$fieldName."'>";
		}else{
			return "<textarea name='updateHtml' id='updateHtml'>".$blogRef->$fieldName."</textarea>";
		}
	}
?>

<div id="blogLive">
	<div id="actionBar" class="col-md-12" style="background:lightblue"></div>
	<div id="blogMessages"></div>
	<form id="blogEditForm">
		<input id="blogid" type="hidden" value="<?php echo $blog->blogId; ?>">
		<input id="editing" type="hidden" value="<?php echo $edit; ?>">
		<div id="editToggle" class="requireLogin">edit:<?php if($edit){echo 'on';}else{echo 'off';}  ?></div>
		<div id="blogTitle"><?php echo contentifyBlog($blog,$edit,'blogTitle'); ?></div>
		<div id="blogDate"><?php echo contentifyBlog($blog,$edit,'blogDate'); ?></div>
		<div id="blogDesc"><?php echo contentifyBlog($blog,$edit,'blogDesc'); ?></div>
		<div id="blogName"><?php echo contentifyBlog($blog,$edit,'blogName'); ?></div>
		<div id="blogFeature"><?php echo contentifyBlog($blog,$edit,'blogFeature'); ?></div>
		<?php if($edit) echo '<button id="previewButton">preview</button><br>' ?>

		<div id="pageHtmlWrapper"><?php echo contentifyBlog($blog,$edit,'blogHtml'); ?></div>
	</form>

</div>

<script src="ckeditor/ckeditor.js"></script>
<script src="client/js/entry.js"></script>
<script>
var editor;
	<?php if($edit) echo 'editor = CKEDITOR.replace("updateHtml"); ';?>
	editor.on( 'save', function( evt ) {
		var data={
			blogid:$('#blogid').val(),
			name:$('#updateblogName').val(),
			title:$('#updateblogTitle').val(),
			desc:$('#updateblogDesc').val(),
			feature:$('#updateblogFeature').val(),
			html:evt.editor.getData()
		};
		updatePage(data);    
    return false;
	});
</script>