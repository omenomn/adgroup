<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Notebook</title>

  <!-- Bootstrap core CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  		<div class="container">
      <a class="navbar-brand" href="{{route('notes.index') }}">Notebook</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
      </div>
    </nav>

<div class="container">

  <div id='notes' class="starter-template">

		<button 
			class="btn btn-primary float-left mb-3" 
			@click='create'>Create</button>  

    <table class='table table-bordered'>

      <thead>
      <tr>
        <td>Id</td>
        <td>Note</td>
        <td style="width:200px">Actions</td>
      </tr>
      </thead>

      <tbody>
      <tr is="note-row" v-for="(note, index) in notes" :item='note' v-on:remove="remove(index)"></tr>
      </tbody>

    </table>

  </div>

</div><!-- /.container -->

<footer class="footer">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>

<style>
  body {
    padding-top : 50px;
    padding-bottom: 60px;
  }

  .starter-template {
    padding    : 40px 15px;
    text-align : center;
  }

	.footer {
	  position: fixed;
	  bottom: 0;
	  width: 100%;
	  height: 60px;
	  line-height: 60px;
	  background-color: #f5f5f5;
	}
</style>
<script src="https://unpkg.com/vue"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.js"></script>
<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" 
  integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" 
  crossorigin="anonymous"></script>
<script 
  src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" 
  integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" 
  crossorigin="anonymous"></script>
<template id='note-row'>
  <tr>
    <td>@{{ item.id }}</td>
    <td v-if='!item.editMode' @click='changeEditMode' width='70%'>@{{ item.body }}</td>
    <td v-else> 
    	<div class="form-group">
    		<textarea 
    			class="form-control" 
    			rows="3" 
    			v-model='item.body'>@{{ item.body }}</textarea>
    		<div v-if='errorMessage !== null' class="alert alert-danger mt-3" role="alert">
				  @{{ errorMessage }}
				</div>
    	</div>
    	<button 
    		type="submit" 
    		class="btn btn-warning btn-lg btn-block mt-3" 
    		@click='save'>Save</button>   
    </td>
    <td>
      <button class="btn btn-danger" @click="$emit('remove')">Delete</button>
    </td>
  </tr>
</template>
<script>  
  Vue.component('note-row', {
    template: '#note-row',
    props: ['item'],  
    data: function() {
    	return {
    		errorMessage: null,
    	}
    },
    watch: {
    	'item.body': function(value) {
    		if (value !== null)
    			this.errorMessage = null
    	}
    },
    methods: {
    	changeEditMode: function() {
    		this.item.editMode = !this.item.editMode
    	},
    	save: function() {    		
	  		var self = this

	  		$.post( self.item.update_url, {
	  			_token: '{{ csrf_token() }}',
	  			_method: 'PATCH',
	  			body: self.item.body,
	  		}).done(function(data) {
		  		self.changeEditMode()
				})
			  .fail(function(jqXHR, textStatus, errorThrown) {
			  	var response = JSON.parse(jqXHR.responseText)
			  	self.errorMessage = response.error_message
			  })
    	},
    },
    mounted: function() {
    }
  });
</script>
<script>
	var app = new Vue({
	  el: '#notes',
	  data: {
	  	notes: {!! $notes->toJson() !!},
	  },
	  methods: {
	  	create: function() {
	  		var self = this

	  		$.post( "{{ route('notes.store') }}", {
	  			_token: '{{ csrf_token() }}'
	  		}).done(function(data) {
		  		self.notes.unshift({
		  			id: data.id,
		  			body: data.body,
		  			update_url: data.update_url,
		  			destroy_url: data.destroy_url,
		  			editMode: true,
		  		})
				})
			  .fail(function() {
			    alert( data.error_message );
			  })
	  	}, 
	  	remove: function(index) {

	  		var self = this

	  		$.post( self.notes[index].destroy_url, {
	  			_token: '{{ csrf_token() }}',
	  			_method: 'DELETE',
	  		}).done(function(data) {
	  			self.notes.splice(index, 1)
				})
			  .fail(function() {
			    alert( data.error_message );
			  })
	  	}
	  }
	})
</script>

</body>
</html>

