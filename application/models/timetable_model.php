<?php
  /**
   * @author Nemanja Djokic
   */
  class Timetable_model extends CI_model
  {
    public function timetable($user_id)
    {
      //$sql = "t.day, time_format(t.start_time, '%k:%i') as timecourse, t.duration, concat(c.name, ' (', c.year, ')')";
      $this->db->select("t.day, time_format(t.start_time, '%k:%i') as timeformat, t.duration, concat(c.name, ' (', c.year, ')') as class, s.name",false); //false optional parameter is used to remove backticks

      $this->db->from('timetable t');
      $this->db->join('subject s', 's.id = t.subject_id', 'INNER');
      $this->db->join('course c', 'c.id = s.course_id', 'INNER');
      $this->db->where('t.user_id', $user_id);
      $query = $this->db->get();
      return $query->result_array();
    }
  }

?>
