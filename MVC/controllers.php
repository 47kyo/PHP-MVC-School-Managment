<?php


require_once("Model.php");




if(isset($_POST['submit']))
{
    require_once("index.html");

     $firstname = $_POST['fn']; //we don't have to check if the user has fill the case because we already made this required in html
     $lastName= $_POST['ln'];
     $cne= $_POST['cne'];
     $cin= $_POST['cin'];
     $email= $_POST['email'];
     $address= $_POST['addresse'];
     $faculty= $_POST['faculty'];
     $cycle= $_POST['cycle'];
     $date= $_POST['date'];
     $year= $_POST['year'];



    $S = new Student($firstname, $lastName,$cne,$cin,$email,$address,$date,$faculty,$cycle,$year);
    ?>
     <div class="fsForm fsSingleColumn fsMaxCol1 with-ads" ><?php $S->AddStudent();?> </div>;


<?php

}
else
if(isset($_POST['submit2']))
{
 require_once("index.html");

    if($_POST['models4']=="PHP")
    {
       if($_POST['php']=="PHP OOP")
       {
         $S = new Module("PHP",$_POST['cne'],"PHP OPP","S4",$_POST['mark']);
         $S->AddMark();
       }
       else
       if($_POST['php']=="Presentations")
       {
        $S = new Module("PHP",$_POST['cne'],"Presentations","S4",$_POST['mark']);
        $S->AddMark();
       }
       else
       if($_POST['php']=="Mini Project")
       {
        $S = new Module("PHP",$_POST['cne'],"Mini Project","S4",$_POST['mark']);
        $S->AddMark();
       }

    }
    else
    if($_POST['models4']=="PFE")
    {
        $S = new Module("PFE",$_POST['cne'],"PFE","S4",$_POST['mark']);
         $S->AddMark();
    }
    else
    if($_POST['models4']=="Stages")
    {

        if($_POST['selctedStage']=="SFE")
        {
            $S = new Module("Stages",$_POST['cne'],"SFE","S4",$_POST['mark']);
            $S->AddMark();
        }
        else
        if($_POST['selctedStage']=="SI")
        {
            $S = new Module("Stages",$_POST['cne'],"SI","S4",$_POST['mark']);
            $S->AddMark();
        }

    }
    else
    if($_POST['models4']=="Communication2")
    {

        if($_POST['com2']=="1")
        {
            $S = new Module("Communication2",$_POST['cne'],"Project management","S4",$_POST['mark']);
            $S->AddMark();
        }
        else
        if($_POST['com2']=="2")
        {
            $S = new Module("Communication2",$_POST['cne'],"Frensh","S4",$_POST['mark']);
            $S->AddMark();
        }
        else
        if($_POST['com2']=="3")
        {
            $S = new Module("Communication2",$_POST['cne'],"English","S4",$_POST['mark']);
            $S->AddMark();
        }

    }



}
else
if(isset($_POST['submit3']))
{

      require_once("index.html");

    $cne= $_POST['cne'];
    $Semestere= $_POST['Semestere'];

    $PDF = new PDF($cne,$Semestere);

    $PDF->PrintPDF();


}
else
if(isset($_POST['submit4']))
{
    require_once("index.html");

    if($_POST['Semestere']=="0")
    echo "Please Select the Semester";
    else
{
$Filiere= $_POST['faculty'];
    $Semestere= $_POST['Semestere'];
    $S = new statistics($Filiere,$Semestere);

?>
    <div class="fsForm fsSingleColumn fsMaxCol1 with-ads" ><?php $S->SuccessStudent(); ?><br><br><?php $S->SuccessElements(); ?><br><br><?php $S->FailedElements();  ?></div>;





    <?php
}

}
else
if(isset($_POST['submit_teacher']))
{
    require_once("index.html");


         $firstname = $_POST['fn']; //we don't have to check if the user has fill the case because we already made this required in html
         $lastName= $_POST['ln'];
         $cin= $_POST['cin'];
         $email= $_POST['email'];
         $address= $_POST['addresse'];
         $faculty= $_POST['faculty'];
         $date= $_POST['date'];




        $S = new Teacher($firstname, $lastName,$cin,$email,$address,$date,$faculty);
        ?>
         <div class="fsForm fsSingleColumn fsMaxCol1 with-ads" ><?php $S->AddTeacher();?></div>;

    <?php
}




?>
