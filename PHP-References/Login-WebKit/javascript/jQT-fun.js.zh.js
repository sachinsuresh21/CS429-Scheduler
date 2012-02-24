//var jQT = new $.jQTouch();

$(function(){
  
  $('#pics0').click(function(){
                  $(this).replaceWith("<li class='textbox' id='pics00'>替换DNS</br><img src='cert/demo.PNG' /></li>")
                  });
  
  $('#pics01').click(function(){
                     $('#pics01').replaceWith("<li class='button' id='pics0'><input type='submit' value='显示图片' /></li>");
                     $('#pics00').replaceWith("");
                    });
  
  $('#pics1').click(function(){
                    $(this).replaceWith("<li class='textbox'>安装</br><img src='cert/demo1.PNG' /><img src='cert/demo2.PNG' /></li>")
                    });
  
  $('#plist').click(function(){
                    var data = {'data':"Premium"}
                    return $.post("98.212.193.235/~cnnn/t2.php", data);
                    });
  
  $('form[target="_blank"]').bind('input', function() {
                               if (confirm('This link opens in a new window.')) {
                               return true;
                               } else {
                               return false;
                               }
                               });
  
  // Page animations end with AJAX callback event, example 1 (load remote HTML only first time)
  $('#callback').bind('pageAnimationEnd', function(e, info){
                      // Make sure the data hasn't already been loaded (we'll set 'loaded' to true a couple lines further down)
                      if (!$(this).data('loaded')) {
                      // Append a placeholder in case the remote HTML takes its sweet time making it back
                      // Then, overwrite the "Loading" placeholder text with the remote HTML
                      $(this).append($('<div>Loading</div>').load('ajax.html .info', function() {        
                                                                  // Set the 'loaded' var to true so we know not to reload
                                                                  // the HTML next time the #callback div animation ends
                                                                  $(this).parent().data('loaded', true);  
                                                                  }));
                      }
                      });
  
  });
