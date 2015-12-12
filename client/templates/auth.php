<div class="row">
  <hr>
  <div class="col-md-12">
    <h1> auth </h1>
  </div>
  <div class="col-md-3">
    <h3>login</h3>
    <form id="authLoginForm" name="a">
      <div id="loginErrors"></div>
      <input type="email" placeholder="email" name="email" id="authEmail"> <br>
      <input type="password" placeholder="password" name="password" id="authPassword"> <br>
      <button id="authPost">login</button>
    </form>
  </div>

  <div class="col-md-3 requireLogin">
    <h3>logout</h3>
    <button id="authDelete">logout</button>
  </div>

  <div class="col-md-3">
    <h3>check login</h3>
    <div>just server refresh check</div>
    <button id="authGet">check</button>
  </div>

  <div class="col-md-3 requireLogin">
    <h3>change password</h3>
    <form id="authUpdateForm" name="b">
      <div id="authUpdateErrors"></div>
      <input type="text" placeholder="id" name="userid" id="authUserId" disabled><br>
      <input type="password" placeholder="new password" name="newPassword" id="authNewPassword"><br>
      <input type="password" placeholder="confirm password" name="confirmPassword" id="authConfirmPassword"><br>
      <button id="authPut">change</button>
    </form>
  </div>
</div>

<script src="client/js/auth.js"></script>