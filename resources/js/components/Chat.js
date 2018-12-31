import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Messages from './../../../Modules/Chat/Resources/assets/js/components/Messages';
class Chat extends Component {
  render () {
    return (
        <div>
          <Messages />
        </div>
    )
  }
}


if (document.getElementById('messages')) {
    ReactDOM.render(<Chat />, document.getElementById('messages'));
}
