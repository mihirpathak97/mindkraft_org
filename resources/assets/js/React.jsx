/**
 * React App entry point
 */

import React, { Component } from 'react';
import { BrowserRouter as Router, Route } from "react-router-dom";

// Views
import Home from './views/Home';

class App extends Component {
  render() {
    return (
      <div className="App">
        {
          /**
           * Define your app's routes here
           */
        }
        <Router>
          <div>
            <Route exact path="/" component={Home} />
          </div>
        </Router>
      </div>
    );
  }
}

export default App;
