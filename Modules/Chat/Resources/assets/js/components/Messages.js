import axios from 'axios';
import Pusher from 'pusher-js';
import React, { Component } from 'react';

const APP_KEY = 'b7a1e4b0955d704d953c';

class Messages extends Component {
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
        this.addMessage(this.state.message);
        this.setState({message: ''});
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
    render () {
        return (
            <div>
                <div className="layers h-100">
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
                            <div className="peers fxw-nw">
                                <div className="peer mR-20">
                                    <img className="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/11.jpg" alt="" />
                                </div>
                                <div className="peer peer-greed">
                                    <div className="layers ai-fs gapY-5">
                                        <div className="layer">
                                            <div className="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
                                                <div className="peer mR-10"><small>10:00 AM</small></div>
                                                <div className="peer-greed"><span>Lorem Ipsum is simply dummy text of</span></div>
                                            </div>
                                        </div>
                                        <div className="layer">
                                            <div className="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
                                                <div className="peer mR-10"><small>10:00 AM</small></div>
                                                <div className="peer-greed"><span>the printing and typesetting industry.</span></div>
                                            </div>
                                        </div>
                                        <div className="layer">
                                            <div className="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
                                                <div className="peer mR-10"><small>10:00 AM</small></div>
                                                <div className="peer-greed"><span>Lorem Ipsum has been the industry's</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="peers fxw-nw ai-fe">
                                <div className="peer ord-1 mL-20">
                                    <img className="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/12.jpg" alt="" />
                                </div>
                                <div className="peer peer-greed ord-0">
                                    <div className="layers ai-fe gapY-10">
                                        <div className="layer">
                                            <div className="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
                                                <div className="peer mL-10 ord-1"><small>10:00 AM</small></div>
                                                <div className="peer-greed ord-0"><span>Heloo</span></div>
                                            </div>
                                        </div>
                                        <div className="layer">
                                            <div className="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
                                                <div className="peer mL-10 ord-1"><small>10:00 AM</small></div>
                                                <div className="peer-greed ord-0"><span>??</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        )
    }
}
export default Messages