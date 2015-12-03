<?php 
	include_once 'database/access_db.php';

	$eventComments = retrieveCommentsByEventID($idEvent);
?>


<div id="comments_section">
	<form id="user_make_comment" action="" method="post" >
			<input type="text" name="event" value="<?php echo $idEvent; ?>" hidden="true" >
			<input type="text" name="user" value="<?php echo $idUser; ?>" hidden="true">
			<?php if(userCanComment($idUser)) {?>
				<textarea id="user_comment" rows="4" cols="25" maxlength="200" placeHolder="Place your comment here!"></textarea>
				<br>
				<input class="sendCommentButton" type="submit" value="comment">
			<?php }else{?>
				<textarea id="user_comment" rows="4" cols="25" maxlength="200" disabled="true"
				placeHolder="You need to be attending the event to be able to comment!"></textarea>
				<br>
				<input class="sendCommentButton" type="submit" value="comment" disabled="true">
			<?php }?>
	</form>

	<?php if(count($eventComments) > 0){ ?>
		<div id="event_comments">
			<h4>Comments</h4>

			<?php foreach($eventComments as $event){ ?>
				<div class="user_comment">
					<h5><?php echo getUserByID($event['idUser'])['idUser']; ?></h5>
					<p><?php echo $event['comment']; ?></p>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>	