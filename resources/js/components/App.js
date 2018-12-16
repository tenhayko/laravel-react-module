import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Chat from './../../../Modules/Chat/Resources/assets/js/components/Chat';
class App extends Component {
  render () {
    return (
        <div>
          <Chat />
        </div>
    )
  }
}


if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
