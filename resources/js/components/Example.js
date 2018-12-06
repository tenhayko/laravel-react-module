import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './../../../Modules/Blog/Resources/assets/js/components/Header'
class Example extends Component {
  render () {
    return (
      <BrowserRouter>
        <div>
          <Header />
          <Switch>
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}


if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
