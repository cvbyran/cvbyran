<?php

   use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

   if($_SERVER['REQUEST_METHOD'] == "POST"){
        $template = $_POST["template"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $birthyear = $_POST["birthyear"];
        $address = $_POST["address"];
        $postal = $_POST["postal"]; 
        $city = $_POST["city"];

        //EDUCATION VARS 
        $school = $_POST["school"];
        $type = $_POST["type"];
        $sdate = $_POST["sdate"];
        $edate = $_POST["edate"];

        /*
        $schoolArr = array();
        $typeArr = array();
        $startArr = array();
        $endArr = array();
        */

        //EXPERIENCE VARS
        $role = $_POST["role"];
        $company = $_POST["company"];
        $jobsdate = $_POST["jobsdate"];
        $jobedate = $_POST["jobedate"];

        //SKILLS VARS
        $lang = $_POST["lang"];
        $langlvl = $_POST["langlvl"];

        $checklist = $_POST["check_list"];
        $keyskills = $_POST["keyskill"];
        $persdesc = $_POST["persdesc"];  
        $linkedin = $_POST["linkedin"];

        $skillStr = "<p style='font-size: 1em; line-height: 2em;'>";
        foreach ($checklist as $check) {
            $skillStr .= $check." "." ";
        }

        $keySkillStr = "<p style='font-size: 1em; line-height: 2em;'>";
        foreach ($keyskills as $skill) {
            if ($skill !== "") {
                $keySkillStr .= $skill."<br/>";
            }
           
        }

        $schoolStr = "";
        $ss = 0;
        foreach ($school as $key) {
            $schoolStr .=  "<p style='font-size: 1em; line-height: 2em;'><strong>".$key."<br/>".$type[$ss]."</strong><br/>".
                            "<strong>Började: </strong>".$sdate[$ss]." <strong>Slutade: </strong>".$edate[$ss]."</p>";
            $ss++;
        } 

        echo $schoolStr;


/*

        foreach ($school as $key)   {
            array_push($schoolArr, $key);
        }
        foreach ($type as $key) {
            array_push($typeArr, $key);
        }
        foreach ($sdate as $key)   {
            array_push($startArr, $key);
        }
        foreach ($edate as $key)   {
            array_push($endArr, $key);
        } */

        $i = 0;
        $contactStr = "";
        foreach ($schoolArr as $name) {
            $contactStr .=  "<p style='font-size: 1em; line-height: 2em;'><strong>".$name."<br/>".$typeArr[$i]."</strong><br/>".
                            "<strong>Började: </strong>".$startArr[$i]." <strong>Slutade: </strong>".$endArr[$i]."</p>";
            $i++;
        }

        $j = 0;
        $experienceString = "";
        foreach ($role as $key) {
            $experienceString .=  "<p style='font-size: 1em; line-height: 2em;'><strong>"."Roll: </strong>".$key." <strong><br/>Företag: </strong>".$company[$j]."<br/>".
                "<strong>Började: </strong>".$jobsdate[$j]."<strong> Slutade: </strong>". $jobedate[$j]."</p><br/>";
            $j++;
        }

        $l = 0;
        $langString = "<p style='line-height: 2em;'>";
        foreach ($lang as $lg) {
            $langString .= "<strong>Språk: </strong>".$lg." <strong> Nivå: </strong>".$langlvl[$l]."<br/>";
            $l++;
        }

        $messageBody = "CV-Profil \n".
                        "Namn: ".$firstname." ".$lastname."\n".
                        "Personnummer: ".$birthyear."\n".
                        "Telefon: ".$phone."\n".
                        "Email: ".$email."\n".
                        "Adress: ".$address." Postnummer: ".$postal." Ort: ".$city."\n".
                        "UTBILDNING \n".
                        $contactStr.
                        "ERFARENHET".
                        $experienceString.
                        "KUNSKAPER & EGENSKAPER".
                        $langString.
                        "PERSONLIGA EGENSKAPER \n".
                        $skillStr.
                        "NYCKELKUNSKAPER \n".
                        $keySkillStr.
                        "PERSONBESKRIVNING".
                        $persdesc.
                        "\n LinkedIn-profil".
                        $linkedin;

        $newmsg = "<div style='text-align: center; font-size: 14px'>".
                "<h2>CV-Profil</h2><br/>".
                "<p style='line-height: 2em;'><strong>CV-Mall: </strong>".$template."</p>".
                "<p style='line-height: 2em;'><strong>Namn: </strong>".$firstname." ".$lastname."<br/>".
                "<strong>Personnummer: </strong>".$birthyear."<br/>".
                "<strong>Telefon: </strong>".$phone."<br/>".
                "<strong>Email: </strong>".$email."<br/>".
                "<strong>Adress: </strong>".$address."<strong> Postnummer: </strong>".$postal."<strong> Ort: </strong>".$city."<br/>".
                "<h3>Utbildning</h3>".
                "<p style='line-height: 2em;'>".$schoolStr."</p>".
                "<h3>Tidigare Erfarenhet</h3>".
                $experienceString.
                "<h3>Kunskaper & Egenskaper</h3>".
                "<p style='font-size: 1.1em;'><strong>"."Språk"."</strong></p>".
                $langString."</p>".
                "<p style='font-size: 1.1em;'><strong>"."Egenskaper"."</strong></p>".
                $skillStr."</p>".
                "<p style='font-size: 1.1em;'><strong>"."Nyckelkunskaper"."</strong></p>".
                $keySkillStr."</p>".
                "<p style='font-size: 1.1em;'><strong>"."Personbeskrivning"."</strong></p>".
               " <p style='font-size: 1em; line-height: 2em;'>".$persdesc."</p>".
               "<a href='".$linkedin."'>".$linkedin."</a>".
                "</div>";



        $mail = new PHPMailer(); // create a new object
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "cvbyran@gmail.com";
        $mail->Password = "HYPERISLAND1337";
        $mail->SetFrom("cvbyran@gmail.com", "CV-BYRÅN");
        $mail->Subject = "You have a CV-order!";
        $mail->Body = $newmsg;
        $mail->AddAddress("cvbyran@gmail.com");

         if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
         } else {
            echo "Message has been sent";
         }

   }
    // $lastname = $_POST("lastname");
    // $firstname = $_POST("firstname");
    // $phone = $_POST("phone");
    // $email = $_POST("email");
    // $birthyear = $_POST("birthyear");
    // $address = $_POST("address");
    // $postal = $_POST("postal");

   

?>