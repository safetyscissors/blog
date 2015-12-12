$(document).ready(getPageList);

$('#pagesList').on('click','#pageAddBtn', function(){
	var data={
		name:$('#pageNewName').val(),
		title:$('#pageNewTitle').val(),
		desc:$('#pageNewDesc').val()
	}
	REQUEST.send('page','post',function(){
		getPageList();
	},data);
});

$('#pagesList').on('click','.pageUpdateSave', function(){
	var pid=$(this).attr('id');
	var data={
		pageid:pid,
		name:$('#pageUpdateName'+pid).val(),
		title:$('#pageUpdateTitle'+pid).val(),
		desc:$('#pageUpdateDesc'+pid).val()
	}
	REQUEST.send('page','put',function(){
		var date = new Date();
		$('#pagesMessages').html('Page '+pid+' saved at '+date.getHours()+':'+date.getMinutes()+'.');
		getPageList();
	},data);
});

$('#pagesList').on('click', '.pageUpdateEdit', function(){
	var url = $('#pageUpdateName'+$(this).attr('id')).val();
	window.location.href = url+'?edit=true';
});

$('#pagesList').on('click','.pageUpdateDelete', function(){
	var data={
		pageid:$(this).attr('id')
	}
	REQUEST.send('page','delete',function(){
		getPageList();
	},data);
});

function getPageList(){
	REQUEST.send('pagelist','get',function(data){
		var serverData = (data)? JSON.parse(data) : '';
		if(serverData.hasOwnProperty('errors')){
			$('#userList').html(serverData.errors);
		} else{
			var output='<table class="table">';
			output+='<tr><th>id</th><th>menu name/url</th><th>title</th><th>description</th><th>save</th><th>edit</th><th>delete</th></tr>';
			output+='<tr><td>add new</td><td><input id="pageNewName" placeholder="new name"></td><td><input id="pageNewTitle" placeholder="title"></td><td><input id="pageNewDesc" placeholder="desc"></td><td><button id="pageAddBtn">add page</button></td></tr>';
			for(var i=0;i<serverData.length;i++){
				var page=serverData[i];
				var pid =page['pageId'];
				output+=tablePageRow(pid,page);
			}
			output+='</table>';
			$('#pagesList').html(output);
		}
	});
}

function tablePageRow(pid,page){
	var row = '<tr>';
	row += '<td>'+pid+'</td>';
	row += '<td><input id="pageUpdateName'+pid+'" value="' + page['menuName'] + '"></td>'
	row += '<td><input id="pageUpdateTitle'+pid+'" value="' + page['title'] + '"></td>'
	row += '<td><input id="pageUpdateDesc'+pid+'" value="' + page['desc'] + '"></td>'
	row += '<td><button class="pageUpdateSave" id="'+pid+'">save</button></td>'
	row += '<td><button class="pageUpdateEdit" id="'+pid+'">edit</button></td>'
	row += '<td><button class="pageUpdateDelete" id="'+pid+'">delete</button></td>'
	return row+'</tr>';
}