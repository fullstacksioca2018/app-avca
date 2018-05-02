$(document).ready(function(){

    //Adultos
    var adult=0;
   
    

    $('.quantity-right-plus-adult').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var adult = parseInt($('#adult').val());
        
        // If is not undefined
            
            $('#adult').val(adult + 1);

          
            // Increment
    });

    $('.quantity-left-minus-adult').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var adult = parseInt($('#adult').val());
        
        // If is not undefined
      
            // Increment
            if(adult>1){
            $('#adult').val(adult - 1);
            }
    });

    var child=0;

    $('.quantity-right-plus-child').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var child = parseInt($('#child').val());
        
        // If is not undefined
            
            $('#child').val(child + 1);

            $('#addchild');
            // Increment
    });

    $('.quantity-left-minus-child').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var child = parseInt($('#child').val());
        
        // If is not undefined
      
            // Increment
            if(child>0){
            $('#child').val(child - 1);
            }
    });

    var infant=0;

    $('.quantity-right-plus-infant').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var infant = parseInt($('#infant').val());
        
        // If is not undefined
            
            $('#infant').val(infant + 1);

          
            // Increment
    });

    $('.quantity-left-minus-infant').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var infant = parseInt($('#infant').val());
        
        // If is not undefined
      
            // Increment
            if(infant>0){
                $('#infant').val(infant - 1);

            }
    });
    
});