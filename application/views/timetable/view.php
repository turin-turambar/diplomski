<table class="table table-bordered">
<tr>
  <th>
    Dan
  </th>
  <th>
    Vreme
  </th>
  <th>
    Trajanje
  </th>
  <th>
    Smer
  </th>
  <th>
    Predmet
  </th>
</tr>
<?php
  foreach ($timetable_items as $timetable_item) {
    echo "<tr><td>".$timetable_item['day']."</td><td>".$timetable_item['timeformat']."</td><td>".
    $timetable_item['duration']."</td><td>".$timetable_item['class']."</td><td>".$timetable_item['name']."</td></tr>";
  }
?>
</table>
