import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Messenger from './../../../Modules/Chat/Resources/assets/js/components/Messenger';
class Chat extends Component {
  render () {
    return (
        <div>
          <Messenger />
        </div>
    )
  }
}


if (document.getElementById('chat')) {
    ReactDOM.render(<Chat />, document.getElementById('chat'));
}
