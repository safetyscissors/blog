<div class="row">
  <hr>
  <div class="col-md-12">
    <h1> user </h1>
  </div>

  <div class="col-md-9 requireLogin">
    <h3>users</h3>
    <div id="userList"></div>
  </div>

  <div class="col-md-3 requireLogin">
  	<h3>create user</h3>
    <form id="createUserForm">
      <div id="createErrors"></div>
    	<input type="email" name="email" id="userEmail" placeholder="email"><br>
    	<input type="text" name="name" id="userName" placeholder="user name"><br>
    	<input type="password" name="password" id="userPassword" placeholder="new password"><br>
  		<input type="password" name="confirmPassword" id="userConfirmPassword" placeholder="confirm password"><br>
  		<button id="userCreate">create</button>
    </form>
  </div>

</div>

<script src="client/js/user.js"></script>