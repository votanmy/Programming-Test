<?php
// Handle AJAX request
if( isset($_POST['ajax']) && isset($_POST['origArr']) && isset($_POST['d']) ){
  // Apply core function to the client's array
  $rotArr = rotLeft( $_POST['origArr'], $_POST['d']);
  // Send result to client side
  echo $rotArr;
  exit;
}

// The core function
function rotLeft( $arr, $d){
  // Do this for d times
  for($i=0; $i < $d; $i++){
    // Remove the first element then insert it to the end of the array
    array_push($arr, array_shift($arr));
  }
  // Convert array to string
  return implode(' ', $arr);
}
?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <title>Coding-challenge jQuery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>

  <body>
    <div class="markup">
      <input id="nd" type="text">
      <input id="ipArr" type="text">
      <div id="result"></div>
    </div>

    <script>

      (function($){

        // Declaration and focus to the input of n and d
        var n, d;
        $('#nd').focus();

        // Handle the input of n and d
        $('#nd').on('change', function(){
          // Convert input string to array
          var ndArr = $(this).val().split(' ');
            // Allow only 2 numbers
          if(ndArr.length === 2){
            // Get n and d values
            n = parseInt(ndArr[0]);
            d = parseInt(ndArr[1]);
            // Focus to the input of array elements
            $('#ipArr').focus();
          }else{
            alert('Please input 2 numbers with one space between');
          }
        });

        // Handle the input of array elements
        $('#ipArr').on('change', function(){
          // Convert input string to array
          var origArr = $(this).val().split(' ');
          // Allow only n elements
          if(origArr.length === n){
            // Ajax request
            $.ajax({
              type: 'post',
              data: {ajax: 1, origArr: origArr, d: d},
              success: function(response){
                // Get result from server then print out
                $('#result').text(response);
              }
            });         
          }else{
            alert('Please input ' + n + ' elements with spaces between');
          }

        });

      })(jQuery);

 
    </script>
    <style>
      body{
        font-family: sans-serif;
      }
      .markup{
        width: 50%;
        margin: 0 auto;
        margin-top: 15%;
      }
      input, input:focus, input:focus-visible{
        border: none;      
        appearance:none;
        -webkit-appearance:none;
        display: block;       
        margin-bottom: 5%;
        width: 100%;
        min-height: 2em;
        font-size: 1em;
        font-family: sans-serif;  
        background-color: #f5f5f5;    
      }      
    </style>
  </body>

</html>
