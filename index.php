<!DOCTYPE html>
<html>

	<head>
		
		<meta charset="UTF-8" />
		
		<title>Pogoda</title>
        
        <meta name="description" content="Strona internetowa na której sprawdzisz pogodę dla swojego miasta.">
        <meta name="keywords" content="pogoda. prognoza, prognoza pogody, miasto, pogoda dla miasta">
        <meta name="author" content="Damian Niemyjski">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
        
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&amp;subset=latin-ext" rel="stylesheet" />
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/vue"></script>
		
		<style>
			body {
				background-image: url("img/weather.png");
			}
			
			.floatL{
				float: left;
				display: block;
			}
		</style>
		
	</head>
	
	<body>
		
		<div class="page-header">
			<div class="row">
				<div class="col-md-2 col-md-offset-5">
					<figure>
						<img class="img-responsive" src="img/logo.png" alt="Pogoda">
					</figure>
				</div>
			</div>
		</div>
		
			
		<main class="container-fluid">
            <div class="row">
				<div class="col-md-2 col-md-offset-5">
					<!--
					<div id="app">
					  <p>{{ message }}</p>
					  <p>{{miasto}}</p>
					</div>
					
					<input type="text" id="myText" value="">
					<input type="text" id="myText2" value="">
					<button onclick="myFunction()">wyswietl</button>
					-->
				</div>
			</div>
			
						<img class="img-responsive floatL" src="img/cloud.png" alt="Pogoda" style="max-width: 50%;">	
			
			<!--
			<section class="block__userFinder userFinder">
            <h3 class="userFinder__name">
               Prognoza pogody
            </h3>
            <div class="form form--userFinder">
                <div class="form__rowGroup form__rowGroup--bottom">
                    <div class="form__row form__row--mr15">
                        <label class="form__label">
                            Podaj miasto
                        </label>
                        <div class="form__input">
                            <input type="search" class="form__text" v-model="miasto">
                        </div>
                    </div>
                    <div class="form__row form__row--mr15">
                    </div>
                    <div class="form__row form__row--button">
                        <el-button type="info">Sprawdź</el-button>
                    </div>
                </div>
            </div>
            <ul class="userFinder__list">
                <template v-for="user in userList">
                    <li class="userFinder__item">{{ miasto }}</li>
                </template>
            </ul>
        </section>        
        -->
        
        <section class="block__userFinder userFinder">
            <h3 class="userFinder__name">
               Prognoza pogody
            </h3>
            <div class="form form--userFinder">
                <div class="form__rowGroup form__rowGroup--bottom">
                    <div class="form__row form__row--mr15">
                        <label class="form__label">
                            Podaj miasto
                        </label>
                        <div class="form__input">
                            <input type="text" id="myText" value="">
                        </div>
                        <label class="form__label">
                            Opady
                        </label>
                        <div class="form__input">
							<input type="text" id="myText2" value="">
						</div>
                    </div>
                    <div class="form__row form__row--mr15">
                    </div>
                    <div class="form__row form__row--button">
                        <button onclick="myFunction()">Sprawdź</button>
                    </div>
                </div>
            </div>
            <div class="userFinder__list">
                <template v-for="user in userList">
					<div id="app">
						<p>{{ message }}</p>
                    </div>
                </template>
            </div>

        <!--
        <script>
			
				var miasto = window.location.pathname;
				
				function sprawdz(){
					
				}
				
				// Assign handlers immediately after making the request,
				// and remember the jqXHR object for this request
				var jqxhr = $.ajax( "http://localhost:8080/" miasto )
				  .done(function(dane) {
					var app = new Vue({
					  el: '#app',
					  data: {
						message: 'Temperatura ' + dane
					  }
					})
				  })
				  .fail(function() {
					alert( "Nie pobralo danych" );
				  })
				  .always(function() {
				  });
				
			</script>
			-->
			
			
			<script>
			 
			function myFunction() {
			   
			   window.location.href= "/"+ document.getElementById("myText").value + "/" +document.getElementById("myText2").value ;
			}
			</script>
					
			
			<script>
 
			var currentLocation = window.location.pathname;
			 
			var jqxhr = $.ajax( "http://localhost:8080"+ currentLocation )
			  .done(function(dane) {
			 
					console.log( "data:", currentLocation );
			 
				var app = new Vue({
				  el: '#app',
				  data: {
					message: dane
				  }
				})
			
			</script>

                    
        </main>
		
		
		<footer class="footer navbar-inverse navbar-fixed-bottom">
            <div class="container">
                <p id="data" class="text-muted" style="text-align:center">Created By Damian Niemyjski &copy; {{ new Date().getFullYear() }}</p>
        </div>
            
        </footer>
        
        <script>
			new Vue({
			  el: '#data',
			});
        </script>
		
		
	</body>

</html>
