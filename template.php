<?php
// Template.php = A collection of classes for object oriented programming
// Classes Index
/*
 * 11 : Question Class
 * 60 : Processor Class
 *
 */
class Question{
//  Properties
    public $item_number;
    public $item_question;
    public $item_answers = array();
    public $output;

//    This property sets the letters to be looped through in the __construct function.
    public $letters = array("a", "b", "c", "d");
//    Methods

    /**
     * Question constructor.
     * @param $item_number = Should be a number (determines the item number)
     * @param $item_question = Should be a string (determines the question to be displayed in the document)
     * @param $item_answers = Should be an array (contains all the possible answers for the question (including the correct answer))
     */

    public function __construct($item_number, $item_question, /*Array*/$item_answers){

//        These variables sets the class Properties to the passed Arguments.
        $this->item_number = $item_number;
        $this->item_question = $item_question;
        $this->item_answers = $item_answers;
//        Starts the HTML output
        $output = "<div class='item_container'>";
        $output .= "<span class='item_question'>$this->item_question</span><br><br>";

//        Creates the choices (Loops through the class' item_answers property)
        for($i=0; $i< sizeof($this->item_answers); $i++){

            $curr_letter = $this->letters[$i];
            $curr_answer = $this->item_answers[$i];

//            This condition makes the first choice checked as default.
            if($i == 0){
                $output .= "<label>";
                $output .= "<input type='radio' checked='true' name='item_$this->item_number' value='$curr_letter'><span class='item_choice'>$curr_answer</span>";
                $output .= "</label><br>";
            }else {
                $output .= "<label>";
                $output .= "<input type='radio' name='item_$this->item_number' value='$curr_letter'><span class='item_choice'>$curr_answer</span>";
                $output .= "</label><br>";
            }

        }

//        Ends the HTML output.
        $output .= "</div>";
        echo $output;
    }
}

class Processor{
//    Properties
    public $answer_key = array();
    public $codename;
    public $total_points = 0;
    public $average = 0;

//    Peripherals = The items and answers of wrong and correct answers (Seems a bit confusing eh?)

//    Correct Arrays
    public $correct_numbers = array();
    public $correct_answers = array();

//    Wrong Arrays
    public $wrong_numbers = array();
    public $wrong_answers = array();

//    Methods
    public function __construct($answer_key, $codename){

        $this->answer_key = $answer_key;
//        Loop through the answer key and check if it is equal to the user's answer.
        for($i=0; $i<sizeof($this->answer_key); $i++) {

            $curr_loop_item = $_POST["item_$i"];
            if ($curr_loop_item == $this->answer_key[$i]) {
                array_push($this->correct_numbers, $i);
                array_push($this->correct_answers, $curr_loop_item);

                $this->total_points++;
            } else {
                array_push($this->wrong_answers, $curr_loop_item);
                array_push($this->wrong_numbers, $i);
            }
        }
        $this->codename = strtolower($codename);
//        Gets the function output average and sets it to the class' average property.

        $average = $this->getScoreAverage($this->total_points, sizeof($this->answer_key));
        $this->average = $average;

    }


    public function getScoreAverage($score, $total){
        return $score/$total*100;
    }

//    This function needs styling!
    public function display(){
        echo $this->total_points."/".sizeof($this->answer_key);
        echo " or ".$this->average."%<br><br>";

        echo "Correct answers :<br>";
        for($i=0;$i<sizeof($this->correct_answers);$i++){
            $curr_correct_number = $this->correct_numbers[$i]+1;
            echo $curr_correct_number.":".$this->correct_answers[$i], '<br>';
        }

        echo "Wrong answers :<br>";
        for($i=0;$i<sizeof($this->wrong_answers);$i++){
            $curr_wrong_number = $this->wrong_numbers[$i]+1;
            echo $curr_wrong_number.":".$this->wrong_answers[$i], '<br>';
        }
    }
}

class Database{
//    Database Information and credentials
    public $dbname;
    public $username;
    public $password;

    public $query;

    public function __construct($dbname, $username, $password){
//        Set Class properties to passed arguments
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function database_query($query){
        try{
            $handler = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->username, $this->password);
            return $query = $handler->query($query);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function database_get($query){
        $handler = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->username, $this->password);
        $query = $handler->query($query);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

