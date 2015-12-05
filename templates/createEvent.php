<!DOCTYPE html>
<html>
<header>
    <meta charset='UTF-8'>
	<link rel="stylesheet" href="../css/createEvent.css">
</header>

<body>	
<form id="form1" name="form1"  method="post">
  
<header id="header" class="info">
	<h2>Create Event</h2>
</header>

<ul>
		
	
	
<li id="fo1li2">
	<label  id="title2">
		Title
			</label>
	<div>
		<input id="Field2" name="Field2" type="text" value="">
			</div>
	</li>



<li id="fo1li3" >
	<label id="title3" for="Field3">
		Date
			</label>
	<span>
		<input id="Field3-1" name="Field3-1" type="text"  value="" size="2" maxlength="2" tabindex="2">
		<label for="Field3-1">MM</label>
	</span>
	<span class="symbol">/</span>
	<span>
		<input id="Field3-2" name="Field3-2" type="text" class="field text" value="" size="2" maxlength="2" tabindex="3" >
		<label for="Field3-2">DD</label>
	</span>
	<span class="symbol">/</span>
	<span>
	 	<input id="Field3" name="Field3" type="text" class="field text" value="" size="4" maxlength="4" tabindex="4">
		<label for="Field3">YYYY</label>
	</span>
	</li>

<li id="fo1li4">
	<label class="desc" id="title4" for="Field4">
		Description
			</label>
	<div>
		<input id="Field4" name="Field4" type="text"  value="" maxlength="255" tabindex="5">
			</div>
	</li>



<li id="fo1li5">
	<legend id="title5">
		Private
			</legend>
	<div>
		<span class="subfield">
	<input id="Field5" name="Field5" type="checkbox"  value="Yes" tabindex="6" >
	<label class="choice" for="Field5">
		<span >Yes</span>
					
	</label>
	</span>
		<span class="subfield">
	<input id="Field6" name="Field6" type="checkbox"  value="No" tabindex="7" >
	<label class="choice" for="Field6">
		<span class="choice__text">No</span>
	</label>
	</span>
		</div>
	</li>



<li id="fo1li105">
	<label id="title105" for="Field105">
		Type
			</label>
	<div>
		<select id="Field105" name="Field105"   tabindex="8">
						<option value="Corrida" selected="selected">
				Corrida
			</option>
						<option value="Jantar">
				Jantar
			</option>
						<option value="Copos">
				Copos
			</option>
						<option value="Encontro">
				Encontro
			</option>
					</select>
	</div>
	</li>


 

	
	<li class="buttons ">
		<div>
	<input id="saveForm" name="saveForm"  type="submit" value="Submit" onmousedown="doSubmitEvents();">
	</div>
	</li>
	</body>
	</html>