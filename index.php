<?php require_once("ctd_db_connection.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Jquery UI -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    <script src="includes/ctd-javascript.js"></script>
    <link rel="stylesheet" href="style.css">

    <style type="text/css">
      body {
        position: relative;
        overflow-y: scroll;
      }
    </style>

  </head>
  <body data-spy="scroll" data-target="#navbar-example">


    <div id="ctd-modal" class="fade modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Task Name</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="ctd-modal-taskname">Task</label>
                <input class="form-control" type="text" name="ctd-modal-taskname" value="">
                <label for="ctd-modal-duedate">Due Date</label>
                <input class="form-control" type="text" name="ctd-modal-duedate" value="">
                <label for="ctd-modal-startime">Start Time</label>
                <input class="form-control" type="text" name="ctd-modal-startime" value="">
                <label for="ctd-modal-endtime">End Time</label>
                <input class="form-control" type="text" name="ctd-modal-endtime" value="">
                <label for="ctd-modal-completed">Mark Completed</label>
                <input class="form-control"type="checkbox" name="ctd-modal-completed" value="1">
                <label for="ctd-modal-note">Note</label>
                <input class="form-control" type="textarea" name="ctd-modal-note" value="">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="ctd-modal-submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist" id="navbar-example">
          <li class="nav-item">
             <h1 class="navbar-brand mb-0">Calendar To Do</h1>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#link">Day</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ctd-week">Week</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#linkb">Month</a>
          </li>
        </ul>
        <div class="row justify-content-center">
          <div class="btn-group month-buttons" role="group" aria-label="Basic example">
            <button id="ctd-prev-month" type="button" class="btn btn-secondary">Prev</button>
            <button id="ctd-month" type="button" class="btn btn-secondary"></button>
            <button id="ctd-next-month" type="button" class="btn btn-secondary">Next</button>
          </div>
        </div>

        <div class="row">
          <div class="col-9">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="ctd-one-seventh">
                    Sunday
                  </th>
                  <th class="ctd-one-seventh">
                    Monday
                  </th>
                  <th class="ctd-one-seventh">
                    Tuesday
                  </th>
                  <th class="ctd-one-seventh">
                    Wednesday
                  </th>
                  <th class="ctd-one-seventh">
                    Thursday
                  </th>
                  <th class="ctd-one-seventh">
                    Friday
                  </th>
                  <th class="ctd-one-seventh">
                    Saturday
                  </th>
                </thead>
              </tr>
              <tbody class="ctd-table">
                  <?php
                    // Get the day of the week for the first day of the month.
                    $_SESSION['month'] = (isset($_GET['month']) ? mysql_prep($_GET['month']) :date("n")-1);
                    $_SESSION['day'] = (isset($_GET['date']) ? mysql_prep($_GET['date']) : date("j"));
                    $_SESSION['year'] = (isset($_GET['year']) ? mysql_prep($_GET['year']) : date("Y"));
                    $date = date_create();

                    $new_date = date_date_set($date, $_SESSION['year'], $_SESSION['month'], 1);
                    $first_day_of_month = date_format($new_date, "w");

                    for ($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $_SESSION['month']+1, $_SESSION['year']) + $first_day_of_month; $i++) {
                      if($i < $first_day_of_month + 1) {
                        $day = "";
                      } else {
                        $day = $i - $first_day_of_month;
                      }
                      if ($i == 0) {
                        echo "Number One";
                      }
                      if ($i % 7 == 1) {
                        echo "<tr class='col'>";
                      }
                      echo "<td class='ctd-droppable' id=\"ctd-date-box-" . $day .  "\">";
                      echo $day;
                      echo "</br></td>";
                      if ($i % 7 == 0) {
                        echo "</tr>";
                      }
                    }
                   ?>
               </tbody>
             </table>
          </div>
          <div class="col-3">
            <ul  class="list-group">
              <li class="list-group-item">
                <input id="new-task" type="text" />
                <button id="new-task-button" type="button"> New Task </button>
              </li>
            </ul>
            <h4>With Due Date</h4>
            <ul id="ctd-has-duedate" class="list-group">
            </ul>
            <h4>No Due Date</h4>
            <ul id="ctd-no-duedate" class="list-group">
            </ul>
          </div>
        </div>


    </div>
  </body>
  <form>
    <input type="hidden" id="ctd-month-value" value="<?php echo $_SESSION['month'];?>"/>
    <input type="hidden" id="ctd-year-value" value="<?php echo $_SESSION['year'];?>"/>
  </form>
</html>
