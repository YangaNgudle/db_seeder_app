<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends CI_Controller {

	public function index()
	{
		require_once APPPATH.'/vendor/autoload.php';

        $faker = Faker\Factory::create();

        echo $faker->name;
		echo "<pre>";
		var_dump($this->input->post());

		// get credentials::

		$host = $this->input->post('db_host');
		$db_name = $this->input->post('db_name');
		$db_table = $this->input->post('db_table');
		$db_username = $this->input->post('db_username');
		$db_password = $this->input->post('db_password');
        $db_columns = $this->input->post('db_column');
        $db_data_types = $this->input->post('db_data_type');
        $db_row_numbers = $this->input->post('db_row_number');
        
        $allColumns = '';

        foreach($db_columns as $db_column) {
           $allColumns .= $db_column.", ";
        }
        
        // Remove last ,
        $allColumns = rtrim($allColumns,', ');
         
        $buildSQLValues = '';
        
        for ($i= 0; $i <= $db_row_numbers[0] - 1 ; $i++) {
           $buildSQLValues .= '(';

            for($x = 0; $x <= count($db_data_types) - 1; $x++) {
           	  $type = $this->getData($db_data_types[$x], $faker);
           	  $buildSQLValues .= $type.", ";
            }
           
           $buildSQLValues = rtrim($buildSQLValues,', ');
           $buildSQLValues .= "), ";
        }
        
        $buildSQLValues = rtrim($buildSQLValues,', ');
        
		$buildSQL = "INSERT INTO $db_table (".
           $allColumns
		.") VALUES
        ".$buildSQLValues."";

        echo "<br/> $buildSQL";

        $this->seedDatabase($host, $db_username, $db_name, $db_username, $db_password, $buildSQL);

	}

	private function getData($type = 'name', $faker) {
		switch ($type) {
			case 'name':
			   return "'".$faker->name."'";
			case 'address':
			   return "'".$faker->address."'";
			case 'integer':
			   return $faker->randomDigit;
			case 'float':
			   return $faker->randomNumber;
			default:
			   return "'".$faker->name."'";
		}
	}

	private function seedDatabase($host, $username, $db, $username, $password, $sql) {
		$con = mysqli_connect($host,$username,$password,$db);
		// Check connection
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		// Perform queries 
		mysqli_query($con, $sql);
	
		mysqli_close($con);
	}
}