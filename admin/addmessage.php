<?php
    include '../common/header.php';
    include 'tabs.php';
    checkAdmin();
    if (isset($_POST['postback']))
    {
	$errors = array();

	$title = $_POST['title'];
	$message = $_POST['message'];

	if (empty ($title))
	{
	    array_push($errors, "Er is geen titel ingevuld");
	}
	if (empty($message))
	{
	    array_push($errors, "Er is geen bericht ingevuld");
	}

	if (count($errors) == 0)
	{
	    DB::insert('messages', array(
		'title' => $title,
		'message' => $message
	    ));
	    
	    header("Location:messages.php");
	}
    }
?>
<div id="content">

    <div class="page-header">

	<h2>Bericht toevoegen</h2>

	<a href="messages.php" class="button red"><i class="fa fa-ban fa-lg"></i><span>Annuleren</span></a>

    </div>

    <?php
	if (!empty($errors))
	{
	    echo "<div class=\"box red\"><ul>";

	    foreach ($errors as $error)
	    {
    echo "<li>" . $error . "</li>";
	    }

	    echo "</ul></div>";
	}
    ?>

    <form method="post">

	<div class="input-container">
	    <label for="title"><i class="fa fa-tag fa-lg fa-fw"></i>Titel</label>
	    <input type="text" name="title" id="title" value="<?php if (isset($_POST['title'])) echo $_POST['title'] ?>" required="required"/>
	</div>

	<div class="input-container">
	    <label for="message"><i class="fa fa-align-left fa-lg fa-fw"></i>Bericht</label>
	    <textarea required="required" name="message"><?php if (isset($_POST['message'])) echo $_POST['message'] ?></textarea>
	</div>

	<div class="bottom right">
	    <button class="green" type="submit" name="postback"><i class="fa fa-plus-square fa-lg"></i>Toevoegen</button>
	</div>

    </form>

</div>
<?php
    include '../common/footer.php';
?>
