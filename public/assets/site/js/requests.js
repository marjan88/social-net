
var Comment = React.createClass({
  render: function() {
    return (
       <span className="badge badge-friend">{this.props.count}</span>
    );
  }
});
var CommentList = React.createClass({
  render: function() {

      var commentNodes = this.props.data.map(function(comment) {
      return (
        <Comment 
            requests={comment.requests}
            count={comment.count}           
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
      </div>
    );
  }
});

ReactDOM.render(
       <CommentBox url="http://chatty.mar/api/friend-requests" pollInterval={2000} />,
        document.getElementById('statuses')
        );