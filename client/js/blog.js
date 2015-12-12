$(document).ready(getBlogList);

$('#blogList').on('click','#blogAddBtn', function(){
	var data={
		name:$('#blogNewName').val(),
		title:$('#blogNewTitle').val(),
		desc:$('#blogNewDesc').val()
	}
	REQUEST.send('blog','post',function(){
		getBlogList();
	},data);
});

$('#blogList').on('click','.blogUpdateSave', function(){
	var bid=$(this).attr('id');
	var data={
		blogid:bid,
		name:$('#blogUpdateName'+bid).val(),
		title:$('#blogUpdateTitle'+bid).val(),
		desc:$('#blogUpdateDesc'+bid).val()
	}
	REQUEST.send('blog','put',function(){
		var date = new Date();
		$('#blogMessages').html('Blog '+bid+' saved at '+date.getHours()+':'+date.getMinutes()+'.');
		getBlogList();
	},data);
});

$('#blogList').on('click', '.blogUpdateEdit', function(){
	var blogid=$(this).attr('id');
	var url = 'blog'+'?id='+blogid+'&edit=true';
	window.location.href = url;
});

$('#blogList').on('click','.blogUpdateDelete', function(){
	var data={
		blogid:$(this).attr('id')
	}
	REQUEST.send('blog','delete',function(){
		getBlogList();
	},data);
});



function getBlogList(){
	REQUEST.send('list','get',function(data){
		var serverData = (data)? JSON.parse(data) : '';
		if(serverData.hasOwnProperty('errors')){
			$('#blogList').html(serverData.errors);
		} else{
			var output='<table class="table">';
			output+='<tr><th>id</th><th>name/url</th><th>title</th><th>description</th><th>save</th><th>edit</th><th>delete</th></tr>';
			output+='<tr><td>add new</td><td><input id="blogNewName" placeholder="new name"></td><td><input id="blogNewTitle" placeholder="title"></td><td><input id="blogNewDesc" placeholder="desc"></td><td><button id="blogAddBtn">add blog</button></td></tr>';
			for(var i=0;i<serverData.length;i++){
				var blog=serverData[i];
				var bid =blog['blogId'];
				output+=tableRow(bid,blog);
			}
			output+='</table>';
			$('#blogList').html(output);
		}
	});
}

function tableRow(pid,blog){
	var row = '<tr>';
	row += '<td>'+pid+'</td>';
	row += '<td><input id="blogUpdateName'+pid+'" value="' + blog['blogName'] + '"></td>'
	row += '<td><input id="blogUpdateTitle'+pid+'" value="' + blog['blogTitle'] + '"></td>'
	row += '<td><input id="blogUpdateDesc'+pid+'" value="' + blog['blogDesc'] + '"></td>'
	row += '<td><button class="blogUpdateSave" id="'+pid+'">save</button></td>'
	row += '<td><button class="blogUpdateEdit" id="'+pid+'">edit</button></td>'
	row += '<td><button class="blogUpdateDelete" id="'+pid+'">delete</button></td>'
	return row+'</tr>';
}