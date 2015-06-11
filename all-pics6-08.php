<?php    
	if(isset($_POST['submit'])){
		$input = $_POST['actualIn'];
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
    <title>All Pics 6-08</title>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script>
    $.ajax({
        url: "6-08",
        success: function(data){
            $(data).find("a:contains(.JPG)").each(function(){
                var images = $(this).attr("href");
                var name = '6-08/' + images;
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
        #thetext{
            width:20%;
        }
        b{
            padding:4px;
            background-color:yellow;
        }
        #next{
            font-weight:bold;
        }
    </style> 
</head>
<body>
    <button id="prev">prev</button>
    <b><button id="next">next</button></b>
	<button id="like">like</button>
    <a href="http://nd.edu/~wbadart/iep"><button>home</button></a>
	<div style="float:right; display:block;" id="thetext">
        <p style="display:block;">How to like:<br />As you browse, click the "like" button for photos you enjoy.  When you&#39;re done looking at all the photos in the set, click submit so your likes are saved.  Thanks for your input!<br /></p>
		<p style="display:block;">Liked Photos:</p>
		<p style="display:block;" id="likeList"></p>	
	</div>
	<form action="<?php echo $PHP_SELF;?>" method="post">
		<input type="submit" class="button" name="submit" value="submit" />
		<input type="text" name="title" id="textarea"></input>
		<input type="textarea" name="actualIn" id="actualIn" style="display:none;"></input>
	</form>
	
	<br />
	
    <script>    
    $('#next').click(function(){
        if ($(this).parent().is("b")){
            $(this).unwrap();
            $(this).css('font-weight', 'inherit');
        }
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