<?php
/* Author : Nur Hidayat
 * This piece of code only control minimum year of incident ( YearOfDeat - AgeOfDeat )
 * but not control it's maximum ( can customize in future ), number of investigation, 
 * As a test i make 2 of investigation are invalid (object 2 and 3)..
 * 
 * I am sure this is still far from robust, but if any chance i will do my best
 * to make it more robust
 */
//Class of cunning magicians who are good at programming
class Saga {
    
    private $AgeOfDeat,   //Age of villager when he/she is dead
    $YearOfDeat,  //Year whenever villager is deat
    $YearOfIncident; //Year when the incident is happen
    
    public function Saga( $pAgeOfDeat, $pYearOfDeat){
        $this->AgeOfDeat  = $pAgeOfDeat;
        $this->YearOfDeat = $pYearOfDeat;
        
        //Determine when the incident was happen
        $this->YearOfIncident = $this->YearOfDeat - $this->AgeOfDeat;
    }
    
    //Recursivelly count total people was killed whenever villager was born
    function CountPeopleKilled( $YearOfVillagerWasBorn ){
        if( $YearOfVillagerWasBorn == 0) return 1;
        else return $YearOfVillagerWasBorn + $this->CountPeopleKilled( $YearOfVillagerWasBorn - 1);
    }
    
    //Return total people was killed buy cunning programmer
    //at the year of incident
    function getKilledPeople(){
        return (($this->YearOfIncident >= 5 ) ? 1 : 0) + $this->CountPeopleKilled($this->YearOfIncident-1);
    }
    
    //Get the year of incident
    function getYearOfIncident(){
        return $this->YearOfIncident;
    }
    
    //Check the validity of user input
    function CheckUserInput(){
        $DeatValue = ( $this->AgeOfDeat > 0 && $this->YearOfDeat > 0 )? true : false;
        $IncidenValue =  ( $this->YearOfIncident > 0 )? true :  false;
        return ( $DeatValue && $IncidenValue )? true : false;
    }
}

$ArrayObject = array();
        
//array_push($ArrayObject, new Saga()...);
array_push($ArrayObject, new Saga(5,7), new Saga(10,-15), new Saga(9,9), new Saga(9,12),new Saga(9,13));


$ValidCount = 0; //Count total valid input data
$ValidSum = 0;   //Sum of people killed

//Iterate trhough the array of Object
foreach($ArrayObject as $obj){
    if( $obj->CheckUserInput() ){
        echo 'Villager born on Year : ' . $obj->getYearOfIncident() . ' number of people was killed is : ';
        echo $obj->getKilledPeople() . "\n";
        $ValidCount++;
        $ValidSum += $obj->getKilledPeople();
    } else {
        echo 'Invalid input...' ."\n";
    }
}
        
echo 'Average killed : ' . ($ValidSum/$ValidCount) . ' (Valid Input)  ' . "\n";
echo 'Average killed : ' . ($ValidSum/count($ArrayObject)) . ' (All Input)  ' . "\n";

?>        