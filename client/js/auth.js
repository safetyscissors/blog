$(document).ready(checkLogin);

$('#authGet').on('click', function(){
	checkLogin();
});

$('#authLoginForm').on('submit', function(){
	var data = {
		'email':$('#authEmail').val(),
		'password':$('#authPassword').val()
	}
	REQUEST.send('auth','post',loginCallback, data);
	return false
});

$('#authDelete').on('click', function(){
	REQUEST.send('auth','delete',checkLogin)
});

$('#authUpdateForm').on('submit', function(){
	if($('#authNewPassword').val() != $('#authConfirmPassword').val()){
		$('#authUpdateErrors').html('Your password fields dont match.');
	}

	var data = {
		'userid':$('#authUserId').val(),
		'password':$('#authConfirmPassword').val()
	}
	REQUEST.send('auth','put',changePassword, data);
	return false
});





function loginCallback(data){
	var serverData = (data)? JSON.parse(data) : '';
	if(serverData.hasOwnProperty('errors')) $('#loginErrors').html(serverData.errors);
	console.log(serverData);
	$('#authPassword').val('');
	checkLogin();
}

function changePassword(data){
	var serverData = (data)? JSON.parse(data) : '';
	$('#authNewPassword').val('');
	$('#authConfirmPassword').val('');
	if(serverData.hasOwnProperty('errors')){
		$('#authUpdateErrors').html(serverData.errors);
	}else{
		$('#authUpdateErrors').html('password changed');
	}
}

function checkLogin(){
	REQUEST.send('auth','get', function(data){
		var serverData = (data)? JSON.parse(data) : '';
		if(serverData.hasOwnProperty('errors')) return authChanges(false);

		$('#authUserId').val(serverData.userid);
		authChanges(true);
	})
}

function authChanges(isLoggedIn){
	var className = (isLoggedIn)? 'isLoggedIn' : 'requireLogin'
	var previousClass = (isLoggedIn)? 'requireLogin' : 'isLoggedIn'
console.log(className)
	$('.'+previousClass).each(function(){
		$(this).addClass(className);
	  $(this).removeClass(previousClass);
	});
	setTimeout(getUserList,1000);
}