$(document).ready(loadEntry)

$('#blogEditForm').on('submit', function(){
	//updatePage(data);
	return false;
})

$('#previewButton').on('click', function(){
	var url=window.location.href;
	var urlParts=url.split('?');

  var win = window.open(urlParts[0]+'?id='+$('#blogid').val(), '_blank');
  win.focus();
});

function updatePage(data){
	console.log(data);
	REQUEST.send('blog','put',function(){
		var date = new Date();
		$('#blogMessages').html('Page saved at '+date.getHours()+':'+date.getMinutes()+'.');
	},data);
}

function loadEntry(){
	REQUEST.send('auth','get',function(res){
		var data=JSON.parse(res);
		if(data.hasOwnProperty('errors')){
			$('#actionBar').hide();
		}else{
			setupActionBar();
		}
	});
}

function setupActionBar(){
	var url=window.location.href;
	var urlParts=url.split('?');

	var admin='<a href="admin"><button>admin</button></a>';
	var edit='<a href="'+url+'&edit=true"><button>edit</button></a>';
	var view='<a href="'+urlParts[0]+'?id='+$('#blogid').val()+'"><button>view</button></a>';
	var publish = '<button>publish</button>'
	var show = '<button>show</button>';
	var hide = '<button>hide</button>';

	var output=admin;
	output+=($('#editing').val())?view:edit;

	$('#actionBar').html(output);
}