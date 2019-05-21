
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="manifest" href="/manifest.json">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <button id="sendmessage">Send Message</button>
  <!-- Firebase App is always required and must be first -->
  <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-app.js"></script>

  <!-- Add additional services that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-database.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-firestore.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-messaging.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-functions.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyDvUD_Uf02JMe3MLefYhSucldgwEDFllcg",
      authDomain: "pushnotification-25e2e.firebaseapp.com",
      databaseURL: "https://pushnotification-25e2e.firebaseio.com",
      projectId: "pushnotification-25e2e",
      storageBucket: "pushnotification-25e2e.appspot.com",
      messagingSenderId: "1080090638100"
    };
    var tokenLar = '{{ csrf_token() }}';
    var tokenCMS; 
    firebase.initializeApp(config);

    const messaging = firebase.messaging();
    messaging.requestPermission().then(function() {
      console.log('Notification permission granted.');
      return messaging.getToken();
    })
    .then(function(token){
      tokenCMS = token;
      console.log(token);
    })
    .catch(function(err) {
      console.log('Unable to get permission to notify.', err);
    });

    messaging.onMessage(function(payload){
      console.log('onMessage: ', payload);
    });
    $(document).ready(function(){
        $("#sendmessage").click(function(){
            console.log(tokenCMS);
            $.post("\pushmesage",
            {
                tokenCMS: tokenCMS,
                '_token': tokenLar
            },
            function(data,status){
                console.log("Data: " + data + "\nStatus: " + status);
            });
        });
    });
  </script>
</body>
</html>