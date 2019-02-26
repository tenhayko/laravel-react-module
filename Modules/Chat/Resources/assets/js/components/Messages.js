import axios from 'axios';
import Pusher from 'pusher-js';
import React, { Component } from 'react';

const APP_KEY = 'b7a1e4b0955d704d953c';
class Messages extends Component {
    constructor(props) {
        super(props);
        this.state = {
            convesation: [],
            messages:[],
            lisEventLs:[],
            users:[],
            message: ''
        };
        this.user = window.user;
        this.setupPusher();
        this.sendMessage = this.sendMessage.bind(this);
        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.handleKeyPress = this.handleKeyPress.bind(this);
        this.getListUser = this.getListUser.bind(this);
        this.fetchMessages = this.fetchMessages.bind(this);
    }
    getListUser() {
        axios.get('/admin/user/list').then(response => {
            this.setState({ 
                users: response.data
            });
        });
    }
    getConversation(conversation_id)
    {
        axios.get(`/chat/messages/${conversation_id}`).then(response => {;
            this.setState({ 
                convesation: response.data,
                messages: response.data.messages,
            });
        }).catch(error => {
            console.log(error.response.data.message);
        });
    }
    pushMessage(data) {
        if(this.state.convesation.id != data.conversation_id){
            this.getConversation(data.conversation_id);
        }else{
            if (data.user_id != this.user.id) {
                let lats = this.state.messages[this.state.messages.length-1];
                let newms = {
                    user_id : data.user_id,
                    message : [{messages:data.messages}]
                };
                let ms = {
                    messages:data.messages
                }
                if (this.state.messages.length && lats.user_id == data.user_id) {
                    this.state.messages[this.state.messages.length-1].message.push(ms);
                    this.setState({ 
                        messages: this.state.messages
                    });
                }else{
                    this.setState({ 
                        messages: this.state.messages.concat([newms])
                    });
                }
            }
        }
    }
    fetchMessages() {
        axios.get('/chat/messages').then(response => {
            this.setState({ 
                convesation: response.data,
                messages: response.data.messages,
            });
            this.state.lisEventLs[this.state.convesation.id] = 'new-message-'+this.state.convesation.id;
            this.channel.bind(this.state.lisEventLs[this.state.convesation.id], function(data) {
                this.pushMessage(data);
            }.bind(this));
        }).catch(error => {
            console.log(error.response.data.message);
        });
    }
    componentWillMount() {
        console.log('starting...');
    }
    scrollToBottom() {
        this.messagesEnd.scrollIntoView({ behavior: "smooth" });
    }
    componentDidMount() {
        this.getListUser();
        this.fetchMessages();
        this.scrollToBottom();
    }
    componentDidUpdate() {
        this.scrollToBottom();
    }
    setupPusher() {
        this.pusher = new Pusher(APP_KEY, {
            cluster: 'ap2',
            forceTLS: true
        });
        this.channel = this.pusher.subscribe('channel-chat');
    }
    sendMessage() {
        if(this.state.message.trim().length) {
            this.addMessage(this.state.message);
            this.setState({message: ''});
        }
    }
    addMessage(message) {
        let newms = {
            user_id : this.user.id,
            message : [{messages:message}]
        };
        let data = {
            messages : message,
            conversation_id : this.state.convesation.id
        }
        let ms = {
            messages:message
        }
        let lats = this.state.messages[this.state.messages.length-1];
        if (this.state.messages.length && lats.user_id == this.user.id) {
            this.state.messages[this.state.messages.length-1].message.push(ms);
        }else{
            this.setState({ 
                messages: this.state.messages.concat([newms])
            });
        }
        axios.post('/chat/messages', data).then(response => {
            // console.log(response.data);
        });
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
    handleConversation(e,user) {
        console.log(user);
        if(user.conversation_user != undefined) {
            if(user.conversation_user.conversation_id != this.state.convesation.id){
                axios.post('/chat/conversation', {conversation_id : user.conversation_user.conversation_id}).then(response => {
                    // chua xu ly
                    console.log(response.data);
                    this.setState({ 
                        convesation: response.data,
                        messages: response.data.messages,
                    });
                    if(this.state.lisEventLs[this.state.convesation.id] === undefined){
                        this.state.lisEventLs[this.state.convesation.id] = 'new-message-'+this.state.convesation.id;
                        this.channel.bind(this.state.lisEventLs[this.state.convesation.id], function(data) {
                            this.pushMessage(data);
                        }.bind(this));
                    }
                    console.log(this.state.convesation.members);
                }).catch(error => {
                    console.log(error.response.data.message);
                });
            }
        }else{
            axios.post('/chat/conversation', {user_id : user.id}).then(response => {
                user.conversation_user = response.data.conversation;
                // chua xu ly
            }).catch(error => {
                console.log(error.response.data.message);
            });
        }
    }
    render () {
        return (
            <div className="peers fxw-nw pos-r">
                <div className="peer bdR" id="chat-sidebar">
                    <div className="layers h-100">
                        <div className="bdB layer w-100">
                            <input type="text" placeholder="Search contacts..." name="chatSearch" className="form-constrol p-15 bdrs-0 w-100 bdw-0"/>
                        </div>
                        <div className="layer w-100 fxg-1 scrollable pos-r ps">
                            {this.state.users.map((user, i) => (
                                <div onClick={(e)=>this.handleConversation(e,user)} className="peers fxw-nw ai-c p-20 bdB bgc-white bgcH-grey-50 cur-p" key={i}>
                                    <div className="peer"><img src={ '/'+user.user_info.images } alt="" className="w-3r h-3r bdrs-50p"/></div>
                                    <div className="peer peer-greed pL-20">
                                        <h6 className="mB-0 lh-1 fw-400">{ user.name }</h6><small className="lh-1 c-green-500">Online</small></div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
                <div className="peer peer-greed">
                    <div className="layers h-100 mx-h-500 w-90">
                        <div className="layer w-100">
                            <div className="peers fxw-nw jc-sb ai-c pY-20 pX-30 bgc-white">
                                <div className="peers ai-c">
                                    <div className="peer mR-20">
                                        <img src="https://randomuser.me/api/portraits/men/12.jpg" className="w-3r h-3r bdrs-50p"/>
                                    </div>
                                    <div className="peer">
                                        <h6 className="lh-1 mB-0">John Doe</h6>
                                    </div>
                                </div>
                                <div className="peers">
                                    <a href="" className="peer td-n c-grey-900 cH-blue-500 fsz-md mR-30" title="">
                                        <i className="ti-video-camera"></i> 
                                    </a>
                                    <a href="" className="peer td-n c-grey-900 cH-blue-500 fsz-md mR-30" title="">
                                        <i className="ti-headphone"></i> 
                                    </a>
                                    <a href="" className="peer td-n c-grey-900 cH-blue-500 fsz-md" title="">
                                        <i className="ti-more"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div className="layer w-100 fxg-1 bgc-grey-200 scrollable pos-r ps">
                            <div className="p-20 gapY-15">
                                {this.state.messages.map((mes, i) => (
                                    (mes.user_id == this.user.id) ?
                                    <div className="peers fxw-nw ai-fe" key={i}>
                                        <div className="peer ord-1 mL-20">
                                            <img className="w-2r bdrs-50p" src={ '/' + this.state.convesation.members[mes.user_id].user.user_info.images} alt="" />
                                        </div>
                                        <div className="peer peer-greed ord-0">
                                            <div className="layers ai-fe gapY-10">
                                                {mes.message.map((ms, j) => (
                                                    <div className="layer" key={j}>
                                                        <div className="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
                                                            {/* <div className="peer mL-10 ord-1"><small>10:00 AM</small></div> */}
                                                            <div className="peer-greed ord-0"><span>{ ms.messages }</span></div>
                                                        </div>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    </div> 
                                    : 
                                    <div className="peers fxw-nw" key={i}>
                                        <div className="peer mR-20">
                                            <img className="w-2r bdrs-50p" src={ '/' + this.state.convesation.members[mes.user_id].user.user_info.images} alt="" />
                                        </div>
                                        <div className="peer peer-greed">
                                            <div className="layers ai-fs gapY-5">
                                                {mes.message.map((ms, j) => (
                                                    <div className="layer" key={j}>
                                                        <div className="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
                                                            {/* <div className="peer mR-10"><small>10:00 AM</small></div> */}
                                                            <div className="peer-greed"><span>{ ms.messages }</span></div>
                                                        </div>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                            <div style={{ float:"left", clear: "both" }}
                                ref={(el) => { this.messagesEnd = el; }}>
                            </div>
                        </div>
                        <div className="layer w-100">
                            <div className="p-20 bdT bgc-white">
                                <div className="pos-r">
                                    <input type="text" name="message" onChange={this.handleFieldChange} value={this.state.message} onKeyPress={this.handleKeyPress} className="form-control bdrs-10em m-0" placeholder="Say something..." />
                                    <button type="button" className="btn btn-primary bdrs-50p w-2r p-0 h-2r pos-a r-1 t-2">
                                        <i className="fa fa-paper-plane-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}
export default Messages