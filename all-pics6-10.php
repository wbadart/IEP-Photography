<?php    
	if(isset($_POST['submit'])){ //check if form was submitted
		$input = $_POST['actualIn']; //get input text
		$input = preg_replace('#<br\s*/?>#i', "\n", $input);
		echo "Success!";
		$myFile = "votes.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		$stringData = trim($input);
		$stringData = "\n".$stringData;
		file_put_contents($myFile, $stringData, FILE_APPEND);
		fclose($fh);
	}  
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Pics 6-10</title>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://raw.githubusercontent.com/carhartl/jquery-cookie/master/src/jquery.cookie.js"></script>
    <script>
    $.ajax({
        url: "6-10",
        success: function(data){
            $(data).find("a:contains(.JPG)").each(function(){
                var images = $(this).attr("href");
                var name = '6-10/' + images;
                $('<div class="item"></div>').appendTo('body');
                var nextDiv = $('div').last();
                $('<p></p>').html(name).appendTo(nextDiv);
                $('<img>').attr('src', name).appendTo(nextDiv);
            });
        }
    });

    
    </script>
    <style>
        .item{
            display: none;
            width: 1000px;
        }
        img{
            width: 880px;
        }
        .showing{
            display: block;
        }
        p{
        	display:none;
        }
    
    </style>
    
    
</head>
<body>
    <button id="prev">prev</button>
    <button id="next">next</button>
	<button id="like">like</button>
    <a href="http://nd.edu/~wbadart/iep"><button>home</button></a>
	<div style="float:right; display:block;">
		<p style="display:block;">Liked Photos</p>
		<p style="display:block;" id="likeList">
		
		
		
		</p>	
	</div>
	<form action="<?php echo $PHP_SELF;?>" method="post">
		<input type="submit" class="button" name="submit" value="submit" />
		<input type="text" name="title" id="textarea"></input>
		<input type="textarea" name="actualIn" id="actualIn" style="display:none;"></input>
	</form>
	
	<br />
	
    <script>    
    $('#next').click(function(){
        var current = $('.showing');
        if(current.next('.item').length == 0){
            var next = $('.item').first();    
        }else{
            var next = $('.showing').next()
        }
        current.removeClass('showing');
        next.addClass('showing');
        document.getElementById('textarea').value = $('.showing p').html();
    });
    $('#prev').click(function(){
        var current = $('.showing');
        if(current.prev('.item').length == 0){
            var next = $('.item').last();    
        }else{
            var next = $('.showing').prev()
        }
        current.removeClass('showing');
        next.addClass('showing');
        document.getElementById('textarea').value = $('.showing p').html();
    });

    $('#like').click(function(){
    	var image = $('.showing p').html();
    	console.log(image);
		image = "<br />" + image;
		$('#likeList').append(image);
		document.getElementById('actualIn').value = $('#likeList').html();
    });
    
    </script>

    
</body>



</html>