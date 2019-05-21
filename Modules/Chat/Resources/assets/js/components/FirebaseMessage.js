import axios from 'axios';
import Pusher from 'pusher-js';
import React, { Component } from 'react';
import firbaseApp from "./initializeFirebase";
const APP_KEY = 'b7a1e4b0955d704d953c';
const messaging = firbaseApp.messaging();
class Messages extends Component {
    constructor(props) {
        super(props);
        this.state = {
            status: "info",
            message: "Token will be displayed here..!",
            title: "Notifications will appear here..!",
            msgCount: "Notification Count: 0",
            accordionTabs: []
        };
        this.handleClick = this.handleClick.bind(this);
        navigator.serviceWorker
        .register('./firebase-messaging-sw.js')
        .then((registration) => {
          firebase.messaging().useServiceWorker(registration);
        });
        messaging.requestPermission().then(function() {
            console.log('Notification permission granted.');
            return messaging.getToken();
        })
        .then(function(token){
            console.log(token);
        })
        .catch(function(err) {
            console.log('Unable to get permission to notify.', err);
        });
    
        messaging.onMessage(function(payload){
            console.log('onMessage: ', payload);
        });
    }
    handleClick () {
        console.log('lick');
    }
    render () {
        return (
            <div>
                <button onClick={this.handleClick}>Generate Token</button>
            </div>
        )
    }
}
export default Messages