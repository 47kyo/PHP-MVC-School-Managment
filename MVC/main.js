
function ModulesChange()
{

    var s1 = document.getElementById('s1');
    var s3 = document.getElementById('s3');
   


   var Cycle = document.getElementById('cycle');

   var selectedIteam = Cycle.options[Cycle.selectedIndex].value;
   if(selectedIteam=="First Year DUT")
   {
       s1.style.display = "block";
       s3.style.display = "none";
  

   }
   else
   if(selectedIteam=="Second Year DUT")
   {
 
    s3.style.display = "block";
    s1.style.display = "none";
   }

}


function ModulesChange2()
{

    var php = document.getElementById('phpdiv');
    var stages = document.getElementById('stagesdiv');
    var pfe = document.getElementById('pfediv');
    var com1 = document.getElementById('com1div');
    var com2 = document.getElementById('com2div');


   var Module = document.getElementById('s4select');

   var selectedIteam = Module.options[Module.selectedIndex].value;
   if(selectedIteam=="PHP")
   {
      
       php.style.display = "block";
       stages.style.display = "none";
       pfe.style.display = "none";
       com1.style.display = "none";
       com2.style.display = "none";
   }
   else
   if(selectedIteam=="Stages")
   {
    php.style.display = "none";
    stages.style.display = "block";
    pfe.style.display = "none";
    com1.style.display = "none";
    com2.style.display = "none";

   }
   else
   if(selectedIteam=="PFE")
   {
    stages.style.display = "none";
    php.style.display = "none";
    pfe.style.display = "block";
    com1.style.display = "none";
    com2.style.display = "none";

   }
   else
   if(selectedIteam=="Communication")
   {
    stages.style.display = "none";
    php.style.display = "none";
    pfe.style.display = "none";
    com1.style.display = "block";
    com2.style.display = "none";

   }
   else
   if(selectedIteam=="Communication2")
   {
    stages.style.display = "none";
    php.style.display = "none";
    pfe.style.display = "none";
    com1.style.display = "none";
 com2.style.display = "block";
   }


}

function ModulesChange3()
{

    var s1 = document.getElementById('s1div');
    var s2 = document.getElementById('s2div');
    var s3 = document.getElementById('s3div');
    var s4 = document.getElementById('s4div');
   


   var str = document.getElementById('semestere');

   var selectedIteam = str.options[str.selectedIndex].value;
   if(selectedIteam=="S1")
   {
       s1.style.display = "block";
       s2.style.display = "none";
       s3.style.display = "none";
       s4.style.display = "none";
  

   }
   else
   if(selectedIteam=="S2")
   {
 
       s1.style.display = "none";
       s2.style.display = "block";
       s3.style.display = "none";
       s4.style.display = "none";
   }
   else
   if(selectedIteam=="S3")
   {
 
    s1.style.display = "none";
       s2.style.display = "none";
       s3.style.display = "block";
       s4.style.display = "none";
   }
   else
   if(selectedIteam=="S4")
   {
 
    s1.style.display = "none";
       s2.style.display = "none";
       s3.style.display = "none";
       s4.style.display = "block";
   }

}