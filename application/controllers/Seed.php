<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'/vendor/autoload.php';

class Seed extends CI_Controller {

	public function index()
	{
        $faker = Faker\Factory::create();
		// get credentials::

		$host = trim($this->input->post('db_host'));
		$db_name = trim($this->input->post('db_name'));
		$db_table = trim($this->input->post('db_table'));
		$db_username = trim($this->input->post('db_username'));
		$db_password = trim($this->input->post('db_password'));
        $db_columns = $this->input->post('db_column');
        $db_data_types = $this->input->post('db_data_type');
        $db_row_numbers = $this->input->post('db_row_number');

        // remove empty values
        $db_columns = array_filter($db_columns, function($value) { return $value !== ''; });
        $db_data_types = array_filter($db_data_types, function($value) { return $value !== ''; });
        $db_row_numbers = array_filter($db_row_numbers, function($value) { return $value !== ''; });
        
        $allColumns = '';

        foreach($db_columns as $db_column) {
           $allColumns .= $db_column.", ";
        }
        
        // Remove last ,
        $allColumns = rtrim($allColumns,', ');
         
        $buildSQLValues = '';

        // Get largest array value of the row numbers
        $db_max_row_number = max($db_row_numbers);
        
        // Buil SQL Values
        for ($i= 0; $i <= $db_max_row_number - 1 ; $i++) {
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
    
    /**
    *
    *
    *
    *
    */
	private function getData($type = 'name', $faker) {
		switch ($type) {
			case 'name':
			   return $this->addQuotes(stripslashes($faker->name), true);
			case 'integer':
			   return $faker->randomDigit;
			case 'float':
			   return $faker->randomNumber;
			case 'email':
			   return $this->addQuotes(stripslashes($faker->email), true);
			case 'username':
			   return $this->addQuotes(stripslashes($faker->userName), true);
			case 'domainName':
			   return $this->addQuotes(stripslashes($faker->domainName), true);
			case 'creditCardType':
			   return $this->addQuotes(stripslashes($faker->creditCardType), true);
			case 'creditCardNumber':
			   return $this->addQuotes(stripslashes($faker->creditCardNumber), true);
			case 'creditCardExpirationDate':
			   return $fake->creditCardExpirationDate;
            case 'creditCardExpirationDateString':
			   return $this->addQuotes(stripslashes($faker->creditCardExpirationDateString), true);
			case 'swiftBicNumber':
			   return $this->addQuotes(stripslashes($faker->swiftBicNumber), true);
			case 'emoji':
			   return $this->addQuotes(stripslashes($faker->email), true);
			case 'currencyCode':
			   return $this->addQuotes(stripslashes($faker->currencyCode), true);
			case 'colorName':
			   return $this->addQuotes(stripslashes($faker->colorName), true);
			case 'hexColor':
			   return $this->addQuotes(stripslashes($faker->hexColor), true);
			case 'rgbColor':
			   return $this->addQuotes(stripslashes($faker->rgbColor), true);
			case 'date':
			   return $this->addQuotes(stripslashes($faker->date), true);
			case 'time':
			   return $this->addQuotes(stripslashes($faker->time), true);
			case 'month':
			   return $this->addQuotes(stripslashes($faker->month), true);
			case 'year':
			   return $this->addQuotes(stripslashes($faker->year), true);
			case 'company':
			   return $this->addQuotes(stripslashes($faker->company), true);
			case 'jobTitle':
			   return $this->addQuotes(stripslashes($faker->jobTitle), true);
			case 'title':
			   return $this->addQuotes(stripslashes($faker->title), true);
			case 'titleMale':
			   return $this->addQuotes(stripslashes($faker->titleMale), true);
			case 'titleFemale':
			   return $this->addQuotes(stripslashes($faker->titleFemale), true);
			case 'suffix':
			   return $this->addQuotes(stripslashes($faker->suffix), true);
			case 'firstNameMale':
			   return $this->addQuotes(stripslashes($faker->firstNameMale), true);
			case 'firstNameFemale':
			   return $this->addQuotes(stripslashes($faker->firstNameFemale), true);
			case 'lastName':
			   return $this->addQuotes(stripslashes($faker->lastName), true);
			case 'cityPrefix':
			   return $this->addQuotes(stripslashes($faker->cityPrefix), true);
			case 'secondaryAddress':
			   return $this->addQuotes(stripslashes($faker->secondaryAddress), true);
			case 'state':
			   return $this->addQuotes(stripslashes($faker->state), true);
			case 'stateAbbr':
			   return $this->addQuotes(stripslashes($faker->stateAbbr), true);
			case 'citySuffix':
			   return $this->addQuotes(stripslashes($faker->citySuffix), true);
			case 'streetSuffix':
			   return $this->addQuotes(stripslashes($faker->streetSuffix), true);
			case 'buildingNumber':
			   return $this->addQuotes(stripslashes($faker->buildingNumber), true);
			case 'city':
			   return $this->addQuotes(stripslashes($faker->city), true);
			case 'streetName':
			   return $this->addQuotes(stripslashes($faker->streetName), true);
			case 'streetAddress':
			   return $this->addQuotes(stripslashes($faker->streetAddress), true);
			case 'postcode':
			   return $this->addQuotes(stripslashes($faker->postcode), true);
			case 'address':
			   return $this->addQuotes(stripslashes($faker->address), true);
			case 'country':
			   return $this->addQuotes(stripslashes($faker->country), true);
			case 'latitude':
			   return $this->addQuotes(stripslashes($faker->latitude), true);
			case 'longitude':
			   return $this->addQuotes(stripslashes($faker->longitude), true);
			case 'languageCode':
			   return $this->addQuotes(stripslashes($faker->languageCode), true);
			default:
			   return NULL;
		}
	}

	private function seedDatabase($host, $username, $db, $username, $password, $sql) {
		$con = mysqli_connect($host,$username,$password,$db);
		// Check connection
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  // Exit and load up a view template
		}

		// Perform queries 
		mysqli_query($con, $sql);
	
		mysqli_close($con);
	}

	private function addQuotes($item, $singleQuotes = true) {
		if ($singleQuotes) {
			return "'".$this->convertHMTLChars($item)."'";
		}

		return '"'.$item.'"';
	}

	private function convertHMTLChars($item) {
	   return htmlspecialchars($item, ENT_QUOTES);
	} 
}