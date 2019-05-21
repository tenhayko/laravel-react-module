import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Boot from './../../../Modules/Front/Resources/assets/js/components/Boot';
class Front extends Component {
  render () {
    return (
        <div>
          <Boot />
        </div>
    )
  }
}


if (document.getElementById('bootstrap')) {
  ReactDOM.render(<Front />, document.getElementById('bootstrap'));
}
