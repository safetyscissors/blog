$(document).ready(getUserList);

$('#createUserForm').on('submit',function(){
	if($('#userConfirmPassword').val() != $('#userPassword').val()){
		$('#createErrors').html('passwords dont match.');
		return false;
	} 

	var data = {
		'email':$('#userEmail').val(),
		'name':$('#userName').val(),
		'password':$('#userPassword').val()
	}

	REQUEST.send('user','post',userCallback, data);
	return false
})

$('#userList').on('click', '.userDeleteButton', function(){
	var r = confirm("Delete this userid "+$(this).attr('id') + '?');
	if (r == true) {
		var data={
			userid:$(this).attr('id')
		}
    REQUEST.send('user','delete',userCallback, data);
	} else {
	}
})

$('#userList').on('click', '.userUpdateButton', function(){
	var uid = $(this).attr('id');
	var data={
		userid:uid,
		name:$('#userUpdateName'+uid).val(),
		email:$('#userUpdateEmail'+uid).val()
	}
	console.log(data);
	REQUEST.send('user','put',userCallback, data);
})




function getUserList(){
	REQUEST.send('userlist','get',function(data){
		var serverData = (data)? JSON.parse(data) : '';
		if(serverData.hasOwnProperty('errors')){
			$('#userList').html(serverData.errors);
		} else{
			var output='<table class="table">';
			output+='<tr><th>id</th><th>name</th><th>email</th><th>save</th><th>delete</th></tr>'
			for(var i=0;i<serverData.length;i++){
				var uid=serverData[i]['userId'];
				output+='<tr><td>'+uid+'</td>';
				output+='<td><input id="userUpdateName'+uid+'" value="'+serverData[i]['userName']+'"></td>';
				output+='<td><input id="userUpdateEmail'+uid+'" value="'+serverData[i]['userEmail']+'"></td>';
				output+='<td><button class="userUpdateButton" id="'+uid+'">save</button></td>';
				output+='<td><button class="userDeleteButton" id="'+uid+'">delete</button></td></tr>';
			}
			output+='</table>';
			$('#userList').html(output);
		}

	});
}

function userCallback(data){
	var serverData = (data)? JSON.parse(data) : '';
	$('#userPassword').val('');
	$('#userConfirmPassword').val('');
	
	console.log(serverData,'done');
	getUserList();
}