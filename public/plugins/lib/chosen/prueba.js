	
$(function function_name(argument) {

	var i = 0;



		$('#exe').click(function() {

			if(i < 3){
				i = i + 1;

				$('#prueba:last').append('<div class="form-row p-3" id="destroy"><div class="col-4"><input type="text" class="form-control" placeholder="First name" ></div> <div class="col-4"> <input type="text" class="form-control" placeholder="First name" ></div> <div class="col-4"> <input type="text" class="form-control" placeholder="First name"> </div>',
				                   );
			}
		});


		$("#exe6").click(function() {

			if (i != 0) { 
				i = i - 1; 
	    		$("#destroy").remove();
	        }

	        else if(i == 0){
	    			i = 0;
	    		}
			
	    });

})
	