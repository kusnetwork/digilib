<?php
abstract class Database {
	abstract function connect();
	abstract function execute($query);
	abstract function get_row();
	abstract function get_num_rows();
	abstract function close_connection();
}
?>