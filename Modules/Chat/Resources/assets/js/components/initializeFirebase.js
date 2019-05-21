import * as firebase from "firebase";

const sgcmConfig = {
  apiKey: "AIzaSyDvUD_Uf02JMe3MLefYhSucldgwEDFllcg",
  authDomain: "pushnotification-25e2e.firebaseapp.com",
  databaseURL: "https://pushnotification-25e2e.firebaseio.com",
  projectId: "pushnotification-25e2e",
  storageBucket: "pushnotification-25e2e.appspot.com",
  messagingSenderId: "1080090638100"
};

export default firebase.initializeApp(sgcmConfig);