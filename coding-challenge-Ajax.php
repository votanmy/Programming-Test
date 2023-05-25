<?php
// Handle AJAX request (start)
if( isset($_POST['ajax']) && isset($_POST['origArr']) && isset($_POST['d']) ){
  echo $_POST['d'];
  exit;
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

      // jQuery(document).ready(function($){
      (function($){
        var n, d;
        $('#nd').focus();
        
        $('#nd').on('keyup', function(){
          var ndArr = $(this).val().split(" ");
          if( ndArr.length > 2 ){
            $(this).prop('disabled',true);
            n = parseInt(ndArr[0]);
            d = parseInt(ndArr[1]);
            $('#ipArr').focus();
          }
        });

        $('#ipArr').on('keyup', function(){
          var origArr = $(this).val().split(" ");
          if( origArr.length > n ){
            $(this).prop('disabled',true);
            origArr.splice(n);

            $.ajax({
              type: 'post',
              data: {ajax: 1, origArr: origArr, d: d},
              success: function(response){
                $('#result').text('d= ' + response);
              }
            });


            /* origArr = rotLeft(origArr, d).join(' ');
            $('#result').text(origArr); */
          }
        });

        /* function rotLeft(arr, d){
          $.each(arr, function(idx,val) {
            if(idx === d){
              return false;
            }
            arr.push(arr.shift());
          });
          return arr;
        } */        

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