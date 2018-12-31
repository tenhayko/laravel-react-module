import React from 'react';
import ReactDOM from 'react-dom';

// Require Editor JS files.
import 'froala-editor/js/froala_editor.pkgd.min.js';

// Require Editor CSS files.
import 'froala-editor/css/froala_style.min.css';
import 'froala-editor/css/froala_editor.pkgd.min.css';

// Require Font Awesome.
import 'font-awesome/css/font-awesome.css';

import FroalaEditor from 'react-froala-wysiwyg';
const config = {
    imageUploadURL: '/upload',
    requestHeaders:{
        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
    },
    imageUploadMethod: 'POST',
    events: {
        'froalaEditor.image.uploaded': (e, editor, response) => {
            response = JSON.parse(response);
            editor.image.insert(response.secure_url, true, null, editor.image.get(), null)
            return false
        }
    }
}
class EditorComponent extends React.Component {
  constructor () {
    super();

    this.handleModelChange = this.handleModelChange.bind(this);

    this.state = {
      model: 'Example text'
    };
  }

  handleModelChange(model) {
    this.setState({
      model: model
    });
    console.log(model);
  }

  render () {
    return <FroalaEditor
            config={config}
            model={this.state.model}
            onModelChange={this.handleModelChange}
           />
  }
}
if (document.getElementById('editor')) {
    ReactDOM.render(<EditorComponent />, document.getElementById('editor'));
}
