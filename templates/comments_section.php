<header>
	<link rel="stylesheet" href="../css/comments_section.css">
</header>

<div id="comments_section">
	<form id="user_make_comment" action="" method="post" >
			<input type="text" name="event" value="<?php echo $idEvent; ?>" hidden="true" >
			<input type="text" name="user" value="<?php echo $idUser; ?>" hidden="true">
			<?php if(userCanComment($idUser)) {?>
				<textarea id="user_comment" rows="4" cols="25" maxlength="200" placeHolder="Place your comment here!"></textarea>
				<input type="submit" value="comment">
			<?php }else{?>
				<textarea id="user_comment" rows="4" cols="25" maxlength="200" disabled="true"
				placeHolder="You need to be attending the event to be able to comment!"></textarea>
				<input type="submit" value="comment" disabled="true">
			<?php }?>
	</form>

	<div id="event_comments">

	</div>
</div>