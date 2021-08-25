<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pixabay API- Image/Video</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>
<body class="bg-dark">
	<div class="container text-center p-3 shadow mt-2 mb-4 bg-white">
		<h1>Pixabay API-Image/Video</h1>
	</div>
	<div class="container text-center">
		<input type="text" class="pl-5 pr-5" name="search" placeholder="Enter the Keywords...">
		<div class="form-group text-center text-warning">
			<input type="radio" name="type" id="image"> Image
			<input type="radio" name="type" id="video"> Video
		</div>	
		<input type="submit" class="btn btn-primary" name="submit">
	</div>
	<div class="container mt-3 p-5 text-center">
		<div id="demo"></div>
	</div>
	<div  class="text-center" id="message"></div>
	<script>
	$("input[type='submit']").click(function(){
		
		var QUERY = $("input[type='text']").val();

		if(QUERY.length > 0 && QUERY!=""){
			$("#message").css("display","none");
			var TYPE = "";
			if ($("#image").is(":checked")){
				var TYPE = "IMAGE";
			}else if ($("#video").is(":checked")){
				var TYPE = "VIDEO";		
			}else{
				$("#message").html("<h3  class='text-warning' >Please select Categories!</h3>"); 
			}

			if(TYPE.length > 0){

				$.ajax({
					url: "api.php",
					type: "POST",
					data:{request:TYPE,query:QUERY},
					beforeSend: function() {
     				   $("#demo").html("<h2 class='text-warning'>Loading...</h2>");
    				},
					success:function(response){
						$("#demo").html(response);
					}
				});
			}
		}else{
			$("#message").html("<h2  class='text-warning' >Please enter search keyword!</h2>"); 			
		}
	});
	</script>
</body>
</html>
