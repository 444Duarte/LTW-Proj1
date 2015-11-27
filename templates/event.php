<header>
	<link rel="stylesheet" href="css/event.css">
</header>

<?php
	include 'php/connect.php';
	include 'php/access_db.php';

	$event = retrieveEventByID($_GET['event']);
	
 ?>

<div class="display-event">
	<div id="header">
		<div>
			<h1 id="name"><?php echo $event['title'];?></h1>
			<br>
			<h2 id="type"><?php echo $event['type'];?></h2>
		</div>
		<h3 id="date">24/11/2015</h3>
		<form id="option">
			<select name="Option">
				<option disabled selected> -- select an option -- </option>
				<option value="going">Going</option>
				<option value="not">Not Going</option>
				<option value="maybe">Maybe</option>
			</select>
		</form>
	</div>

	<div id="description">
		<h4>Description</h4>
		<br>
		<p>
			Bacon ipsum dolor amet bresaola rump ribeye drumstick turkey tenderloin chicken prosciutto beef ham sausage pork belly. Tri-tip spare ribs swine beef ribs pork chop, tail capicola biltong turkey cupim venison corned beef hamburger bresaola. Ham drumstick tongue cupim, leberkas jerky capicola pork ground round corned beef ball tip shoulder sirloin pork chop venison. Shoulder pork fatback alcatra chicken pig. Pastrami pork chop porchetta drumstick t-bone sirloin flank andouille venison salami bacon hamburger beef ribs tongue pork. Corned beef frankfurter fatback, bresaola chuck porchetta sausage pastrami boudin salami cupim andouille.

			Picanha biltong beef ribs beef turkey strip steak. Andouille bresaola pork chop shank. Pastrami pork belly pig, flank tongue fatback doner ground round. Prosciutto ham hock meatball, hamburger turkey flank sirloin ball tip pork doner spare ribs chicken jerky tongue alcatra. Pancetta pork loin leberkas filet mignon turkey tongue kevin chuck.

			Hamburger leberkas ball tip chuck doner tri-tip shoulder meatball bacon bresaola shankle sirloin pastrami. Kielbasa cow boudin, meatball hamburger drumstick swine short loin pig shoulder. Drumstick swine ham jerky pancetta ham hock cupim venison beef bacon turducken kielbasa. Hamburger ham hock ball tip picanha turducken pancetta.

			Short loin shoulder pancetta picanha. Landjaeger drumstick tongue, turducken cupim ball tip pig kielbasa turkey shank chuck corned beef beef. Spare ribs swine rump, meatball chicken boudin pork belly biltong jowl. Cupim shoulder ribeye, ham hock prosciutto pork chop tri-tip pastrami short loin sausage turkey andouille.

			Shank pancetta doner biltong andouille kielbasa jerky flank pork chicken porchetta fatback cupim jowl. Venison t-bone pork loin tongue boudin, shankle kielbasa ham tri-tip hamburger ball tip pastrami. Sausage beef ribs venison swine meatloaf pork belly pork chop pastrami. Landjaeger salami tongue, tenderloin doner meatloaf tri-tip venison pork meatball.
		</p>
	</div>

	<div class="users">
		<div id="users-going">
			<h1>Going</h1>
			<a href="">User1</a>
			<br>
			<a href="">User2</a>
			<br>
			<a href="">User3</a>
			<br>
			<a href="">User4</a>
		</div>
		<div id="users-not-going">
			<h1>Not going</h1>
			<a href="">User1</a>
			<br>
			<a href="">User2</a>
			<br>
			<a href="">User3</a>
			<br>
			<a href="">User4</a>
		</div>
		<div id="users-invited">
			<h1>Invited</h1>
			<a href="">User1</a>
			<br>
			<a href="">User2</a>
			<br>
			<a href="">User3</a>
			<br>
			<a href="">User4</a>
		</div>
	</div>
</div>