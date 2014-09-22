<?php
    require '../config/connect.php';   
    include '../header.php';
    checkAdmin();
    if (isset($_GET['id']))
    {
	$id = $_GET['id'];
    }
    else 
    {
	header("Location: users.php");
    }
?>			
<div id="content">
    <h2>Bericht bewerken</h2>
    <?php
	$query = sprintf("SELECT * FROM messages WHERE id = %d", mysql_real_escape_string($id)); 
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	
	if (mysql_num_rows($result) == 0)
	{
	    echo "<div class=\"box red\">Bericht niet gevonden!</div>";
	}
	else
	{
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
		    $query = sprintf("UPDATE messages SET title = '%s', message= '%s' WHERE id = $id", mysql_real_escape_string($title), mysql_real_escape_string($message));

		    mysql_query($query);
		    header("Location:messages.php");
		}
	    }
    ?>
    <form method="post">
        <div class="input-container">
            <label for="title"><i class="fa fa-user fa-lg fa-fw"></i>Titel</label>
            <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>"  required="required"/>
        </div>

        <div class="input-container">
            <label for="message"><i class="fa fa-briefcase fa-lg fa-fw"></i>Bericht</label>
            <textarea required="required" name="message" ><?php echo $row['message'] ?></textarea>
        </div>

        <div class="input-container">
                <button class="float-right" name="postback">Toevoegen</button>
        </div>
    </form>
</div>
<?php
	}
    include '../footer.php';
?>