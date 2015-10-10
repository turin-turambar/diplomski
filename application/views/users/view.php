<?php
  //print_r($userdata);

  echo "Korisničko ime: ". $userdata['username']."<br>";
  echo "Ime: ". $userdata['first_name']."<br>";
  echo "Prezime: ".$userdata['last_name']."<br>";
  echo "E-mail: ".$userdata['email']."<br>";
  echo "Član protala od: ".$userdata['registered']."<br>";
?>
