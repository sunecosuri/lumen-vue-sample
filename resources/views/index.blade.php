<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">
  <meta name="description" content="">
  <meta property="og:type" content="website">
  <meta property="fb:app_id" content="">
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:image" content="">

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style>
    body { padding-top: 20px; padding-bottom: 60px; }
    form { padding: 20px 0 0 0; }
    .title { 
      text-align: center;
      background-color: #5E83A2;
      color: #FFFFFF;
      padding: 20px;
      margin: 0px 0 40px 0;
      border-radius: 5px;
    }
    .title p { color: #D2E2EF; font-size: 23px; }
    .comment { margin: 0 0 20px 0; word-wrap: break-word; }
  </style>

  <title>BBS</title>
</head>

<body>
  <div class="container" id="bbs">
    <div class="title">
      <h1>Sample BBS SPA</h1>
      <p>using Lumen 5.3 and Vue.js 2.1</p>
    </div>

    <div class="comment" v-for="comment in comments">
      <h2>Comment #(% comment.id %) <small>by (% comment.name %)</small></h2>
      <p>(% comment.comment %)</p>
    </div>

    <form v-on:submit="postComments">
      <div class="form-group">
        <label for="form-name">Name</label>
        <input v-model="name" type="text" class="form-control" id="from-name" aria-describedby="name-help" placeholder="Enter your name" required>
        <small id="name-help" class="form-text text-muted">We'll never share your name with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="form-comment">Comment</label>
        <textarea v-model="comment" class="form-control" id="form-comment" placeholder="Enter comment" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>


  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/vue/2.1.8/vue.min.js"></script>
  {{-- <script src="/js/vue.js"></script> --}}
  <script>
    new Vue ({
        delimiters: ['(%', '%)'],

        el: '#bbs',

        data: {
          comments: [],
          comment: '',
          name: '',
        },

        created: function() {
          console.log('created');
          this.getComments();
        },

        methods: {
          getComments: function() {
            var $vue = this;
            $.get('/api/comment')
              .done(function(comments){
                $vue.comments = comments;
                console.log('GET:', $vue.comments);
              })
              .fail(function(){
                console.log('error');
              })
          },
          postComments: function(e) {
            e.preventDefault();
            var $vue = this;
            $.post('/api/comment', {name: $vue.name, comment: $vue.comment})
              .done(function(res) {
                $vue.comments.push(res);
                $vue.name = '';
                $vue.comment = '';
                console.log('POST:', res);
              })
              .fail(function(){
                console.log('error');
              })
          }
        }
      })
  </script>

</body>

</html>

