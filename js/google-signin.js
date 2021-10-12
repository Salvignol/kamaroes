let g = document.querySelector('.image-logo');

var googleUser = {};
var startApp = function() {
  gapi.load('auth2', function(){
    // Retrieve the singleton for the GoogleAuth library and set up the client.
    auth2 = gapi.auth2.init({
      client_id: '471738037773-82u1a78lucblatebde31kdt7tg2b3123.apps.googleusercontent.com',
      cookiepolicy: 'single_host_origin',
      // Request scopes in addition to 'profile' and 'email'
      //scope: 'additional_scope'
    });
    attachSignin(document.querySelector('.image-logo'));
  });
};

function attachSignin(element) {
  console.log(element.id);
  auth2.attachClickHandler(element, {},
      function(googleUser) {
          console.log(googleUser.getBasicProfile());
          var xhttp = new XMLHttpRequest();
          xhttp.open("POST", "../signup.php", true);
              
      }, function(error) {
        alert(JSON.stringify(error, undefined, 2));
      });
}