<?php

require_once("../DAO/DAO.php");
require("../DAO/connexion.php");



class Student implements DAO
{
    private $firstName;
    private $lastName;
    private $cne;  //primary key
    private $cin;
    private $email;
    private $address;
    private $faculty;
    private $cycle;
    private $date; //birthday
    private $year; //birthday

    private $connexion; //the conexion to the database


    public function __construct($firstName, $lastName, $cne, $cin, $email,$address, $date, $faculty, $cycle,$year)
    {

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->address = $address;
        $this->cne = $cne;
        $this->date = $date;
        $this->cin = $cin;
        $this->cycle = $cycle;
        $this->faculty = $faculty;
        $this->year = $year;

    }
    public function AddStudent()
    {
        try {
                $db=new DatabaseConnection();

                $query2 =$db->con->prepare("SELECT * FROM student where cne=?");
                $query2->execute(array($this->cne));

                $query3 =$db->con->prepare("SELECT * FROM student where cin=?");
                $query3->execute(array($this->cin));

                 if ($query2->rowCount() > 0 || $query3->rowCount() > 0 )
                {
                    echo "<p>Student With CNE : " . $this->cne . "and CIN : ". $this->cin ." is already existing in this year</p>";
                }
                else
                {
                $query=$db->con->prepare("INSERT INTO student() VALUES('$this->firstName', '$this->lastName', '$this->cin', '$this->cne', '$this->email', '$this->address', '$this->date', '$this->faculty', '$this->cycle','$this->year')");
                $query->execute();
                $row =$query->rowCount();
                if($row>0)
                echo "<p>Student With CNE : " . $this->cne . " has been added</p>";
                }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


};


class Module implements DAO2
{
    private $ModuleName;
    private $Cne;
    private $Elname;
    private $semestere;
    private $Mark;





    public function __construct($ModuleName, $Cne, $Elname, $semestere,$Mark)
    {

        $this->ModuleName = $ModuleName;
        $this->Cne = $Cne;
        $this->Elname = $Elname;
        $this->semestere = $semestere;
        $this->Mark = $Mark;



    }

    public function AddMark()
    {
        try {
                $db=new DatabaseConnection();




                $query=$db->con->prepare("INSERT INTO element() VALUES('$this->ModuleName', '$this->Cne', '$this->Elname', '$this->semestere', '$this->Mark')");
                $query->execute();
                $row =$query->rowCount();
                if($row>0)
                ?><div class="fsForm fsSingleColumn fsMaxCol1 with-ads" ><?php echo "<p>Mark of the Student of the CIN : " . $this->Cne . " has been added</p>"; ?></div><?php




        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }



};


class PDF implements DAO3
{
    private $cne;
    private $Semestere;


    public function __construct($cne, $Semestere)
    {

        $this->cne = $cne;
        $this->Semestere = $Semestere;


    }

    public function PrintPDF()
    {

        try{

           $db=new DatabaseConnection();
           $query =$db->con->prepare("SELECT * FROM element WHERE StudentCne=? and semester= ?");
           $query->execute(array($this->cne,$this->Semestere));
           if ($query->rowCount() > 0)
           {


            require_once "fpdf/fpdf.php";

            $buffer = ob_get_clean();

            // Create instance of PDF class
            $pdf = new FPDF();

            // Add 1 page in your PDF
            $pdf->AddPage();

            // Set Arial Bold font with size 22px
           $pdf->SetFont("Arial", "B", 14);

           // Give margin from left
          $pdf->SetX(80);

          // 0 X 20 Y
          $pdf->Cell(0, 10, "MARKS STATEMENT");

          // Move the cursor to next line
          $pdf->Ln();

          $pdf->SetFont("Arial", "", 12);

          $pdf->SetX(58);
          $pdf->Cell(0, 10, "STUDENT CNE: ".$this->cne."  SEMESTERE: ".$this->Semestere."");
          $pdf->Ln();
        while ($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
           {
            $pdf->SetFont("Arial", "", 11);


            $pdf->SetX(60);
            $pdf->Cell(30, 10, "Module", 1);
	        $pdf->Cell(30, 10, "Element", 1);
            $pdf->Cell(30, 10, "Mark", 1);
            $pdf->Ln();
            $pdf->SetX(60);
            $pdf->Cell(30, 10, $row[0], 1);
	        $pdf->Cell(30, 10, $row[2], 1);
            $pdf->Cell(30, 10, $row[4], 1);

            $pdf->Ln();
            $pdf->Ln();

           }
               // Render the PDF in your browser

               $pdf->output();


           }
           else
           echo "student Doesn't exist";


        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }

    }

};

class statistics  implements DAO4
{
    private $faculty;
    private $Semestere;


    public function __construct($faculty, $Semestere)
    {

        $this->faculty = $faculty;
        $this->Semestere = $Semestere;


    }

    public function SuccessElements()
    {
        $countSuccess = 0;

        try
        {
        $db=new DatabaseConnection();
        $query =$db->con->prepare("SELECT * FROM element where semester=?");
        $query->execute(array($this->Semestere));
        if ($query->rowCount() > 0)
        {
            while ($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
            {
             if($row[4]>=10)
             $countSuccess +=1;

            }

      echo "Successed Elements: ".$countSuccess;

        }
        else
        echo "We don't Have Any Informations About it Successed Elements Yet yet";

        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }



    }

    public function FailedElements()
    {
        $Failed = 0;

        try
        {
        $db=new DatabaseConnection();
        $query =$db->con->prepare("SELECT * FROM element where semester	=?");
        $query->execute(array($this->Semestere));
        if ($query->rowCount() > 0)
        {
            while ($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
            {
             if($row[4]<10)
             $Failed +=1;

            }

        echo "Failed Elements: ".$Failed;

        }
        else
       echo "We don't Have Any Informations About it Failed Elements Yet yet";

        return $Failed;

        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }



    }

    public function SuccessStudent()
    {

        try
        {
        $db=new DatabaseConnection();
        $query =$db->con->prepare("SELECT cne FROM student where cycle = ? ");
        if($this->Semestere =="S3" ||$this->Semestere =="S4" )
        $query->execute(array("Second Year DUT"));
        else
        $query->execute(array("First Year DUT"));
        if ($query->rowCount() > 0)
        {
            $i =0;
            $myArray = array();
            while ($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
            {
             $myArray[$i]=$row[0];
             $i++;
            }

            $numElements = count($myArray);

            echo "Current Semester : ".$this->Semestere."";
            echo "<br>"; echo "<br>";
            echo "Number of Students".$numElements;
            $i =0;
            $HeSec =0;
            $HeFail =0;
            $counter =0;
            $breaked =false;

             for( $i=0; $i<$numElements ;$i++ )
             {
                $query2 =$db->con->prepare("SELECT mark FROM element where StudentCne=?");
                $data = $myArray[$i];
                $query2->execute(array($data));
                 if ($query2->rowCount() > 0)
                {
                    while ($row = $query2->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                    {
                     if($row[0]<=10)
                     $counter +=1;

                     if($row[0]<6) //if an module mark < 6
                     {
                        $HeFail++;
                        $breaked=true;
                        break;
                     }

                    }

                    if($breaked==false)
                    {
                       if($counter>5)
                    $HeFail++;
                    else
                    $HeSec++;
                    }

                }
                $counter=0;
                $breaked= false;

             }

             echo "<br>"; echo "<br>";
             echo "Successed Students : ".$HeSec."";
             echo "<br>"; echo "<br>";
             echo "Failed Students : ".$HeFail;


        }
        else
        {
            echo "Current Semester : ".$this->Semestere."";
            echo "<br>"; echo "<br>";
            echo "There is no Students";
        }


        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }


    }

};






class Teacher implements DAO5
{
    private $firstName;
    private $lastName;
    private $cin;
    private $email;
    private $address;
    private $faculty;
    private $date; //birthday


    private $connexion; //the conexion to the database


    public function __construct($firstName, $lastName,$cin, $email,$address, $date, $faculty)
    {

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->address = $address;
        $this->date = $date;
        $this->cin = $cin;
        $this->faculty = $faculty;


    }
    public function AddTeacher()
    {
        try {
                $db=new DatabaseConnection();

                $query2 =$db->con->prepare("SELECT * FROM Teacher where cin=?");
                $query2->execute(array($this->cin));

                $query3 =$db->con->prepare("SELECT * FROM Teacher where cin=?");
                $query3->execute(array($this->cin));

                 if ($query2->rowCount() > 0 || $query3->rowCount() > 0 )
                {
                    echo "<p>Teacher With CIN :". $this->cin ." is already existing </p>";
                }
                else
                {
                $query=$db->con->prepare("INSERT INTO Teacher() VALUES('$this->firstName', '$this->lastName', '$this->cin', '$this->email', '$this->address', '$this->date', '$this->faculty')");
                $query->execute();
                $row =$query->rowCount();
                if($row>0)
                echo "<p>Teacher With CIN : " . $this->cin . " has been added</p>";
                }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


};


?>
