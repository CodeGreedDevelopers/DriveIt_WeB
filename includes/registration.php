<?php
//error_reporting(0);
if(isset($_POST['signup']))
{
$fname=$_POST['fullname'];
$email=$_POST['emailid']; 
$mobile=$_POST['mobileno'];
$user_id=$_POST['userid'];
$password=md5($_POST['password']); 
$sql="INSERT INTO  tblusers(FullName,EmailId,ContactNo,Password,user_id) VALUES(:fname,:email,:mobile,:password,:user_id)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Registration successfull. Now you can login');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>


<script>
// Initialize Firebase
  var config = {
    apiKey: "AIzaSyAfBxT_7RRDKcMu5RAF1VoymEFO3PUB3E4",
    authDomain: "bold-hope-184905.firebaseapp.com",
    databaseURL: "https://bold-hope-184905.firebaseio.com",
    projectId: "bold-hope-184905",
    storageBucket: "bold-hope-184905.appspot.com",
    messagingSenderId: "664641707887"
  };
  firebase.initializeApp(config);

function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});

//chech pass
$("#password").change(function(){
  var passlength=document.signup.password.value.length;
  if (passlength<8) {
    $("#password-length-status").html("Password length Too shot");
  }
});

  


//start of my firebase functions


function sign_in_user(_email,_pass_word) {
      firebase.auth().signInWithEmailAndPassword(_email,_pass_word).then(function(){
          var user = firebase.auth().currentUser;
          if (user!=null) {
            document.getElementById('userid').value=user.uid;
            document.signup.id="formS2";
            setTimeout(submitting_form,1000);
            
            return true;
          }
        }).catch(function(error) {
          // Handle Errors here
            var errorCode = error.code;
            var errorMessage = error.message;
            window.alert("Sign In"+errorMessage);
            return false;
          // ...
        });
    }
    function create_user(email_,pass_word_) {
       var errorCode,errorMessage;
       document.getElementById('loader').display="block";
       firebase.auth().createUserWithEmailAndPassword(email_,pass_word_).then(function(){
          if(sign_in_user(email_,pass_word_)==true){
            //alert("true");
            return true;
          } 
       }).catch(function(error) {
          errorCode = error.code;
          errorMessage = error.message;
          alert("Create account"+error);
          return false;
        });
    }

function submitting_form() {
    alert(document.signup.userid.value);
    alert(document.signup.id);
    document.getElementById('btnsubmit').click();

    
}

//end of my firebase functions

$("#formS").submit(function(event){
    var user_email=document.signup.emailid.value;
    var user_pass=document.signup.password.value;
    if(document.signup.id=="formS2"){

    }
    else if(document.signup.password.value!= document.signup.confirmpassword.value ){
        alert("Password and Confirm Password Field do not match  !!");
        
        document.signup.confirmpassword.focus();
        event.preventDefault();
    }else if(document.signup.password.value.length<8){
        alert("password Too short");
        event.preventDefault();
    }else if(create_user(user_email,user_pass)!=true){
          //alert(create_user(user_email,user_pass));
          event.preventDefault();
    }else{
      sign_in_user(user_email,user_pass);
    }
});
}

</script>

<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
        
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" id="formS" class="formS2">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="13" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" id="password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                  <span id="password-length-status" style="font-size:12px;"></span>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="hidden" id="userid" name="userid" value="h">
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="btnsubmit" class="btn btn-block">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="progress" id="loader" style="display: none;">
        <div class="progress-bar progress-bar-striped active" role="progressbar"
        aria-valuenow="40" aria-valuemin="0"  aria-valuemax="100" style="width:100%;">
          Processing
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>