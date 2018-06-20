import React, { Component } from 'react';

import {
  Typography
} from '@material-ui/core';

class View extends Component {
  render() {
    return (
      <div style={{diaplay: 'block', margin: 'auto', marginTop: 150}}>
        <Typography variant="display2">MindKraft Boilerplate</Typography>
        <Typography variant="subheading">Author - Mihir Pathak</Typography>
      </div>
    );
  }
}

export default View;
