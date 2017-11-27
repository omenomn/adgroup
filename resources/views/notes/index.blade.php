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
			@click='create'>Dodaj</button>  

    <table class='table table-bordered'>

      <thead>
      <tr>
        <td>Id</td>
        <td>Note</td>
        <td style="width:200px">Actions</td>
      </tr>
      </thead>

      <tbody>
      <tr is="note-row" v-for="(note, index) in notes" :item='note' v-on:remove="notes.splice(index, 1)"></tr>
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
<template id='note-row'>
  <tr>
    <td>@{{ item.id }}</td>
    <td v-if='!item.editMode' @click='changeEditMode'>@{{ item.body }}</td>
    <td v-else> 
    	<div class="form-group">
    		<textarea 
    			class="form-control" 
    			rows="3" 
    			v-model='item.body'>@{{ item.body }}</textarea>
    	</div>
    	<button 
    		type="submit" 
    		class="btn btn-warning btn-lg btn-block mt-3" 
    		@click='changeEditMode'>Zapisz</button>   
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
    watch: {
    	'item.body': function(value) {
    	}
    },
    methods: {
    	changeEditMode: function() {
    		this.item.editMode = !this.item.editMode
    	},  	 	
    },
    mounted: function() {
    	console.log(this.item)
    }
  });
</script>
<script>
	var app = new Vue({
	  el: '#notes',
	  data: {
	  	notes: [
	  		{
	  			id: 1,
	  			body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor vel pretium. Aenean vitae ultricies ante. Nunc ac enim ante',
	  			editMode: false,
	  		},
	  		{
	  			id: 2,
	  			body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor vel pretium. Aenean vitae ultricies ante. Nunc ac enim ante',
	  			editMode: false,
	  		},
	  		{
	  			id: 3,
	  			body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor vel pretium. Aenean vitae ultricies ante. Nunc ac enim ante',
	  			editMode: false,
	  		},
	  		{
	  			id: 4,
	  			body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor vel pretium. Aenean vitae ultricies ante. Nunc ac enim ante',
	  			editMode: false,
	  		},
	  		{
	  			id: 5,
	  			body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor vel pretium. Aenean vitae ultricies ante. Nunc ac enim ante',
	  			editMode: false,
	  		},
	  		{
	  			id: 6,
	  			body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et consequat enim, non tristique dolor. Nulla consequat facilisis dolor vel pretium. Aenean vitae ultricies ante. Nunc ac enim ante',
	  			editMode: false,
	  		},
	  	]
	  },
	  methods: {
	  	create: function() {
	  		this.notes.unshift({
	  			id: null,
	  			body: null,
	  			editMode: true,
	  		})
	  	}
	  }
	})
</script>

</body>
</html>

