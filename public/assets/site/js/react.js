
var Comment = React.createClass({
  render: function() {
    return (
        < div className = "media" >
        < a className = "pull-left" href={this.props.username} >
        < img className = "media-object" src = {this.props.avatar} alt = {this.props.author} / >
        < /a>
        < div className = "media-body" >
        < h4 className = "media-heading" >
        {this.props.author}

        < /h4>
        < p > {this.props.body} < /p>
                <ul className="list-inline">
                    <li><small>{this.props.when_created}</small></li>                         
                    
                </ul>
        < /div>
        < /div>
    );
  }
});
var CommentList = React.createClass({
  render: function() {
    var commentNodes = this.props.data.map(function(comment) {
      return (
        <Comment 
            body={comment.body}
            avatar={comment.avatar}
            author={comment.full_name}
            username={comment.username}
            key={comment.id}
            when_created= {comment.when_created}
        >
          
        </Comment>
      );
    });
    return (
      <div className="commentList">
        {commentNodes}
      </div>
    );
  }
});

var CommentForm = React.createClass({
  getInitialState: function() {
    return {author: '', text: ''};
  },
  handleAuthorChange: function(e) {
    this.setState({author: e.target.value});
  },
  handleTextChange: function(e) {
    this.setState({text: e.target.value});
  },
  handleSubmit: function(e) {
    e.preventDefault();
    var author = this.state.author.trim();
    var text = this.state.text.trim();
    if (!text || !author) {
      return;
    }
    // TODO: send request to the server
    this.setState({author: author, text: text});
  },
  render: function() {
    return (
      <form className="commentForm" onSubmit={this.handleSubmit}>
        <input
          type="text"
          placeholder="Your name"
          value={this.state.author}
          onChange={this.handleAuthorChange}
        />
        <input
          type="text"
          placeholder="Say something..."
          value={this.state.text}
          onChange={this.handleTextChange}
        />
        <input type="submit" value="Post" />
      </form>
    );
  }
});
var CommentBox = React.createClass({
    loadCommentsFromServer: function() {
    $.ajax({
      url: this.props.url,
      dataType: 'json',
      cache: false,
      success: function(data) {
        this.setState({data: data});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },
   handleCommentSubmit: function(comment) {
     $.ajax({
      url: this.props.url,
      dataType: 'json',
      type: 'POST',
      data: comment,
      success: function(data) {
        this.setState({data: data});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },
    getInitialState: function() {
    return {data: []};
  },  
  componentDidMount: function() {
    this.loadCommentsFromServer();
    setInterval(this.loadCommentsFromServer, this.props.pollInterval);
  },
  render: function() {
    return (
      <div className="statuses">       
        <CommentList data={this.state.data} />
         <CommentForm onCommentSubmit={this.handleCommentSubmit} />
      </div>
    );
  }
});

ReactDOM.render(
       <CommentBox url="http://chatty.mar/api/statuses" pollInterval={2000} />,
        document.getElementById('statuses')
        );