import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Chat from './../../../Modules/Chat/Resources/assets/js/components/Chat';
import FirebaseMessage from './../../../Modules/Chat/Resources/assets/js/components/FirebaseMessage';
class App extends Component {
  render () {
    return (
        <div>
          <FirebaseMessage />
        </div>
    )
  }
}


if (document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'));
}
