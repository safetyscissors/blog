$(document).ready(loadPage);

$('#pageEditForm').on('submit', function(){
	var data={
		pageid:$('#pageid').val(),
		name:$('#updatestaticPageMenuName').val(),
		title:$('#updatestaticPagePageTitle').val(),
		desc:$('#updatestaticPageDesc').val(),
		html:$('#updateHtml').val()
	}
	//updatePage(data);
	return false;
})

$('#previewButton').on('click', function(){
	var url=window.location.href;
	var urlParts=url.split('?');

  var win = window.open(urlParts[0], '_blank');
  win.focus();
});

function updatePage(data){
	console.log(data);
	REQUEST.send('page','put',function(){
		var date = new Date();
		$('#pageMessages').html('Page saved at '+date.getHours()+':'+date.getMinutes()+'.');
	},data);
}

function loadPage(){
	REQUEST.send('auth','get',function(res){
		var data=JSON.parse(res);
		if(data.hasOwnProperty('errors')){
			$('#pageActionBar').hide();
		}else{
			setupPageActionBar();
		}
	});
}

function setupPageActionBar(){
	var url=window.location.href;
	var urlParts=url.split('?');

	var admin='<a href="admin"><button>admin</button></a>';
	var edit='<a href="'+url+'?edit=true"><button>edit</button></a>';
	var view='<a href="'+urlParts[0]+'"><button>view</button></a>';
	var show = '<button>show</button>';
	var hide = '<button>hide</button>';

	var output=admin;
	output+=($('#editing').val())?view:edit;

	$('#pageActionBar').html(output);
}