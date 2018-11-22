import React, { Component } from 'react';

import axios from 'axios';

const axiosGraphQL = axios.create({
  baseURL: 'http://sf3.local:8000/app_dev.php/',
  //headers: {
  //  Authorization: 'bearer ACCESS_TOKEN',
  //}
});

const GET_BOOK = `
  {
    book(id: 1) {
      title,
      description,
      authors {
          name
      }
    }
  }
`;

class App extends Component {

  state = {
    book : {}
  };
  
  componentDidMount() {
    this._fetchData();
  }

  _fetchData = () => {
    axiosGraphQL
      .post('', { query: GET_BOOK })
      .then(result => {
        this.setState({book: result.data.data.book});
      });
  };


  render() {
    const { book } = this.state;

    return (
      <div>
        <h1>React GraphQL Example Client</h1>
        <ul>
          <li>Find book with id = 1 and returns title, description, author name</li>
        </ul>
        <div>
          {
            book && book.authors &&
            <div className="well">
              <h3>{book.title}</h3>
              <p>
                  By {book.authors.map(author => author.name)}
              </p>
              <p>{book.description}</p>
            </div>
          }
        </div>
      </div>
    );
  }
}

export default App;