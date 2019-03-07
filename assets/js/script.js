function onSignIn(googleUser) {
  var id_token = googleUser.getAuthResponse().id_token;
$.ajax({
    url:'/ci/users/googleLog',
    dataType:'json',
    type:'post',
    data:{id_token:id_token},
    success:function(json){
      if(json['status'] == 'ok'){
          
          $(location).attr('href','/ci/projects/index');
      }
    }
    
});
}
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }

function showMe(){
    console.log('wwwwwwwwwwwwwwwwwwwww');
}