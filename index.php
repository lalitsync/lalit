<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <title>Lalit's App</title>
    <link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
  </head>
  <body class="app-wrapper">
    <div class="content">
      <div class="notification"></div>
      <div class="message"></div>
      

<div class="Form-holder">
<div class="placeholder">
<fieldset>

<ul>
<li>
<label class="label">Enter Twittwe handler</label>
</li>

<li>
<input type="text" name="handle" id="handle"><button class="go"> <span> Go</span></button>
</li>

</ul>

</fieldset>

</div>
</div>

      <div class="pics">

<div class="result"  id="result"></div>
      </div>
    </div>
<script src="scripts/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

jQuery(document).ready(function() {

jQuery('button.go').live('click',function() {

var Handler =jQuery('#handle').val();

jQuery.getJSON('getusers.php', function(data) {
  var items = [];
 
jQuery.each(data['users'], function(key, val) {
    items.push('<li id="' + key + '">' + val['name'] + '</li>');
  });
 
jQuery('<div />', {'class':'counts',html:' '+Handler+' has '+items.length+' followers!'}).appendTo('#result');

 jQuery('<ul/>', {
    'class': 'my-new-list',
    html: items.join('')
  }).appendTo('#result');
});


});;

});
</script>
</body></html>
