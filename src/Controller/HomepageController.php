<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;



class HomepageController
{
    /**
     * @Route("/home/form", name="app_form")
     */
    public function form()
    {
        $number = random_int(0, 100);
         if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $subdir= substr(dirname(__DIR__),0,-3);
            $dir=$subdir.'home\resume\\'.$email;
             $url=substr($_SERVER['REQUEST_URI'],0,-9)."resume/".$email;
            if($email!=null) {echo $url;
                              header( 'Location: '.$url);
                              exit();
                             }
         }
        return new Response(
            '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume</title>
    <style>
        body{
            background: rgba(0,0,0,0.8);
        }
        .resume{
            background: white;
            width: 80%;
            
            position: relative;
            margin-top: 100px;
            margin-bottom: 100px;
            padding-top: 50px;
            margin-left: 8%;
            padding-left: 50px;
            padding-right: 50px;
            margin-right: 200px;
            padding-bottom: 50px;
            border-radius: 15px;
            
        }
        h1{
            text-align: center;
            font-size: 56px;
        }
        p{
            font-size: 20px;
        }
        input[type=text]{
            width: 70%;
            float: left;
            border-radius: 20px;
            padding-left: 15px;
            font-size: 30px;
            text-align: center;
            
        }
        input[type=text]:focus{
             box-shadow: 0px 5px 10px gray; 
        }
        input[type=submit]{
            width: 20%;
            padding:5px;
            border-radius: 30px;
            font-size: 30px;
            margin-left: 5%;
            background: black;
            color: white;
            cursor: pointer;
        }
        input[type=submit]:hover{
            box-shadow: 0px 5px 10px gray;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="resume">
        <h1>MY GITHUB RÉSUMÉ</h1>
        <hr> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <hr>
        <p>Wellcome! Feel free to use our tool with which you´ll be able to easily generate your own github resume and show others your programming skills and tangible works.</p>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Enter your GitHub username and click on generate">
            <input type="submit" value="Generate" >
        </form>
        <h2>Notes, Information and Future features</h2>
        <p>This is the first version. I am planning on adding things as such as your most committed forks, most committed repositories and make the "My Popular Repositories" be built from your complete list of repositories. Feel free to <a href="">fork the page</a> if you want to help :-) </p>
        <hr> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <hr>
        <p style="text-align:center">Résumé Template borught to you by @armandoflores</p>
        
    </div>
</body>
</html>'
        );
    }
}
?>