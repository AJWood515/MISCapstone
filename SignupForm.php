<?php
include "PHP_Database_Connections.php";
session_start();


if(isset($_POST["submit"]))
{
  $updateRecID = $_SESSION['updateRecID'];
  $event_name = $_POST['event_name'];
  $event_description = $_POST['event_description'];
  $event_presenter = $_POST['event_presenter'];
  $event_date = $_POST['event_date'];
  $event_time = $_POST['event_time'];

  $stmt = $conn->prepare("UPDATE wdv341_event
  SET event_name = '$event_name',
      event_description = '$event_description',
      event_presenter = '$event_presenter',
      event_date = '$event_date',
      event_time = '$event_time'
  WHERE event_id = '$updateRecID' ");

  $stmt->bindParam(':event_name', $event_name);
  $stmt->bindParam(':event_description', $event_description);
  $stmt->bindParam(':event_presenter', $event_presenter);
  $stmt->bindParam(':event_date', $event_date);
  $stmt->bindParam(':event_time', $event_time);
  $stmt->bindParam(':event_id', $updateRecID);

  $stmt->execute();

  $updated = $stmt->rowcount();
  if ($updated > 0)
  {
    $_SESSION['message'] = "Row Updated.";
    header('Location: selectEventsDeuce.php');
  }
}
else{

  $updateRecID = $_GET['eventID'];
  $_SESSION['updateRecID'] = $updateRecID;

  try{
    $stmt = $conn -> prepare("SELECT * FROM wdv341_event WHERE event_id = $updateRecID");
    $stmt -> bindParam('event_id', $event_id);
    $stmt -> execute();

    while($result = $stmt-> fetch(PDO::FETCH_ASSOC))
    {
      $event_name = $result['event_name'];
      $event_description = $result['event_description'];
      $event_presenter = $result['event_presenter'];
      $event_date = $result['event_date'];
      $event_time = $result['event_time'];
    }


?>

<!Doctype HTML>
<html>
<form id="updateEventForm" name="updateEventForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?recId=$updateRecID"; ?>">
        	<fieldset>
              <legend>Update Event</legend>
              <p>
                <label for="event_title">Event Name: </label>
                <input type="text" name="event_name" id="event_name" value="<?php echo $event_name;  ?>" />
                <span class="errMsg"> <?php echo $nameErrMsg; ?></span>
              </p>
              <p>
                <label for="event_description">Event Description:</label>
                  <textarea name="event_description" id="event_description" maxlength="700"><?php echo $event_description; ?></textarea>
                <span class="errMsg"><?php echo $descriptionErrMsg; ?></span>
              </p>
              <p>
                <label for="event_presenter">Event Presenter: </label>
                <input type="text" name="event_presenter" id="event_presenter" value="<?php echo $event_presenter;  ?>" />
                <span class="errMsg"><?php echo $presenterErrMsg; ?></span>
              </p>
              <p> 
                <label for="event_date">Event Date: </label>
                <input type="Date" name="event_date" id="event_date" value="<?php echo $event_date;  ?>"/>
                <span class="errMsg"><?php echo $dateErrMsg; ?></span>
              </p>
              <p>
                <label for="event_email">Event Time: </label>
                <input type="time" name="event_time" id="event_time" value="<?php echo $event_time;  ?>"/>
                <span class="errMsg"><?php echo $timeErrMsg; ?></span>
              </p>



          </fieldset>
         	<p>
            	<input type="submit" name="submit" id="submit" value="Update Event" />
            	<input type="reset" name="button2" id="button2" value="Clear Form" onClick="clearForm()" />
        	</p>
      </form>
</html>

<?php
  }
  catch(PDOException $e)
      {
      echo "Error: " . $e->getMessage();
      }

}
?>
