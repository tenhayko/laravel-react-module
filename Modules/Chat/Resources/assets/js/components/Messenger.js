import axios from 'axios';
import Pusher from 'pusher-js';
import React, { Component } from 'react';

const APP_KEY = 'b7a1e4b0955d704d953c';

class Messenger extends Component {
    constructor(props) {
        super(props);
        this.state = {
            messages: [],
            message: ''
        };
        this.user = window.user;
        this.setupPusher();
        this.sendMessage = this.sendMessage.bind(this);
        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.handleKeyPress = this.handleKeyPress.bind(this);
        this.addMessage = this.addMessage.bind(this);
        this.fetchMessages = this.fetchMessages.bind(this);
    }
    setupPusher() {
        this.pusher = new Pusher(APP_KEY, {
            cluster: 'ap2',
            forceTLS: true
        });
        this.channel = this.pusher.subscribe('channel-chat');
        this.channel.bind('new-message', function(data) {
            console.log(data)
        });
  
    }
    sendMessage() {
        // console.log(this.state.message);
        this.addMessage(this.state.message);
        this.setState({message: ''});
    }
    handleKeyPress(event) {
        if(event.key == 'Enter'){
            this.sendMessage();
        }
    }
    handleFieldChange(event) {
        this.setState({
          [event.target.name]: event.target.value
        });
    }
    fetchMessages() {
        axios.get('/chat/messages').then(response => {
            this.setState({ 
                messages: response.data
            });
            // console.log(response.data);
        });
    }
    addMessage(message) {
        let ms = {
            user:{
                name: 'duc',
                id: 1
            },
            message : message
        };
        this.setState({ 
            messages: this.state.messages.concat([ms])
        });
        axios.post('/chat/messages', ms).then(response => {
            // console.log(response.data);
        });
    }
    componentDidMount() {
        this.fetchMessages();
    }
    render () {
        const { messages } = this.state
        return (
          <div className="container">
            <div className="row">
                <div className="col-md-8 col-md-offset-2">
                    <div className="panel panel-default">
                        <div className="panel-heading">Chats</div>
        
                        <div className="panel-body">
                            <ul className="chat">
                                <li className="left clearfix">
                                    {messages.map((message, i) => (
                                        <div className="chat-body clearfix" key={i}>
                                            <div className="header">
                                                <strong className="primary-font">
                                                    { message.user.name }
                                                </strong>
                                            </div>
                                            <p>
                                                { message.message }
                                            </p>
                                        </div>
                                    ))}
                                </li>
                            </ul>
                        </div>
                        <div className="panel-footer">
                            <div className="input-group">
                                <input onChange={this.handleFieldChange} value={this.state.message} id="btn-input" type="text" name="message" className="form-control input-sm" placeholder="Type your message here..." onKeyPress={this.handleKeyPress}/>

                                <span className="input-group-btn">
                                    <button onClick={this.sendMessage} className="btn btn-primary btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        )
    }
}
export default Messenger