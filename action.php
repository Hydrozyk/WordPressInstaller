<?php

  if (isset($_POST['submit'])){
    if (empty($_POST['wp_dir']) || empty($_POST['wp_db'])) {
  ?>
  <div class="alert alert-danger" role="alert" id="dialog" >
      <p >Form fields can't be empty!</p>
  </div>
  <?php
}else {
    //Setting user input & sanitazing
    $user_input = $_POST['wp_dir'];
    $userWPdb_input = $_POST['wp_db'];
    $userWPDir = sanitUserInput($user_input);
    $userWPdb = sanitUserInput($userWPdb_input);

    if ($conn->select_db($userWPdb) === false) {
          //Creating directory
          if (empty($errors) == true){
            chdir ("../");
            if (!file_exists($userWPDir) && !is_dir($userWPDir)){
              mkdir($userWPDir);

                if (file_exists($userWPDir) && is_dir($userWPDir)) {
                  ?>
                  <div class="alert alert-success" role="alert">
                      Directory has been created. Now Setting up WordPress.
                  </div>
                  <?php
                    if (is_dir_empty($userWPDir) == TRUE) {
                      chdir ("./" . $userWPDir);
                      include('includes/inc_install.php');

                      //Setting rest of DB
                      // Create database
                      $sql = "CREATE DATABASE IF NOT EXISTS $userWPdb";
                      if ($conn->query($sql) === TRUE) {
                         echo "Your Word Press site and DB info below:";
                         ?>
                         <div class="alert alert-success text-left" role="alert">
                             <?php

                               echo "<p>SQL DB name: " . "<strong>" . $userWPdb ."</strong>" . "</p>";
                               echo "<p>Site name: " .  "<strong>" . $userWPDir . "</strong>". "</p>";
                               echo "URL: ";
                               echo "<a href=\"$srv$user$userWPDir\" target=\"_blank\" >$srv$userWPDir</a>";

                             ?>
                         </div>
                         <?php
                         echo "<hr />";
                      } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                        <?php echo "Error creating database: " . $conn->error; ?>
                         </div>
                         <?php
                         $errors[]=" ";
                         header("Refresh:5");
                      }
                    }
              }else {
                ?>
                <div class="alert alert-danger" role="alert">
                    <p>Something went wrong |  could not create directory.</p>
                </div>
                <?php
                $errors[]=" ";

              }
          }else {
            ?>
            <div class="alert alert-danger" role="alert">
                <strong><?php echo "\"$userWPDir\"";?> directory already exists! We can't overwrite it.</strong>
            </div>
            <?php
            $errors[]=" ";

            }
          }
        }else {
          ?>
          <div class="alert alert-danger" role="alert">
              <strong><?php  echo "<p>Database \"$userWPdb\" already exist! </p>";?></strong>
          </div>
          <?php
          $errors[]=" ";

      }
  }
  $conn->close();
}
 ?>
