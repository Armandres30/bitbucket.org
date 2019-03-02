<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResumeController
{
    /**
     * @Route("/resume/{user}", name="app_home_resume")
     */
    public function resume($user)
    {
        $number=$user;

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
        h2{
            text-align: center;
        }
        .left{
            float: left;
            margin-right: 10%;
            width: 10%;
            height: 100%;
        }
        .languages{
            float: left;
        }
        .L{
        height: 30px;
        }
    </style>
    <script type="text/javascript" src="jquery.js"></script>
    <script>
    const client_id="Iv1.a0960b51b2ddd1f2";
    const client_secret="38559be0fa56e8d6df94a25f91257b4940215b3e";
    
    const fetchUsers = async(user) =>{
        const api_call = await fetch(`https://api.github.com/users/${user}?client_id=${client_id}&client_secret=${client_secret}`);
        
        const data = await api_call.json();
        return{data}
    };
    
    const fetchRepos = async(user) =>{
        const api_call = await fetch(`https://api.github.com/users/${user}/repos?client_id=${client_id}&client_secret=${client_secret}`);
        
        const data = await api_call.json();
        return{data}
    };
    
   

    </script>
</head>
<body>
    <div class="resume">
        <h1 class="title">'.$user.'</h1>
        <h2>PASSIONATE GITHUB USER</h2>
        <hr> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <hr>
        <p class="left">GitHub Profile</p>
        <p>On GitHub as an early adopter since <span class="year"></span>, <span class="login"></span> is a developer with <span class="repos"></span> public repositories and <span class="followers"></span> followers.</p>
        <br>
        <hr> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <hr>
        <p class="left">Website</p>
        <p><span class="website">No website</span></p>
        <br>
        <hr> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <hr>
        <p style="text-align:center">List of Repositories</p>
        <ol class="List">
        <li class="first"><p> Name: <span class="name0"></span>. Link: <span class="link0"></span>. Description: <span class="desc0"></span>.</p></li>
        </ol>
        <br>
        <hr> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <hr>
        <p class="left title">Languages:</p>
        <div class="L">
            <p class="languages">
            </p>
        </div>
        <br><br><br><br><br>
        <hr> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <hr>
        
        <p style="text-align:center">Résumé Template brought to you by @armandoflores</p>
        
    </div>
    <script>
     const showData = () => {
        alert("hola");
        fetchUsers("'.$user.'").then((res) => {
            console.log(res);
            var username= res.data.login;
            document.querySelector(".login").innerHTML = username;
            var year= res.data.created_at.substr(0,4);
            document.querySelector(".year").innerHTML = year;
            document.querySelector(".repos").innerHTML = res.data.public_repos;
            document.querySelector(".followers").innerHTML = res.data.followers;
            if(res.data.blog!=null)document.querySelector(".website").innerHTML = res.data.blog;
        })
        fetchRepos("'.$user.'").then((res) => {
            console.log(res);
             if(res.data.length>0) {
                document.querySelector(".name0").innerHTML = res.data[0].name;
                document.querySelector(".link0").innerHTML = res.data[0].html_url;
                document.querySelector(".desc0").innerHTML = res.data[0].description;
                
            }
            var node=document.querySelector(".first");
            languages=[];
            if(res.data.length>1) {
                for(var i=1; i <res.data.length; i++){ 
                    var clone =node.cloneNode(true);
                    var list=document.querySelector(".List");
                    list.appendChild(clone);
                    list.lastChild.childNodes[0].innerHTML="Name: "+res.data[i].name+". Link: "+res.data[i].html_url+". Description: "+res.data[i].description+".";
                     if(res.data[i].language!=null) {
                        flag=true;
                        
                        //check if language already taken
                        for(var j=0; j<languages.length; j++){
                            var lg=res.data[i].language;
                            if(languages[j]!=null) if(languages[j][0]==lg){
                                //if already exists language
                                languages[j][1]+=1;
                                flag=false;
                                break;
                            }
                        }
                        //
                        
                        if(flag){ //if language does not exist in array
                            var lan = res.data[i].language;
                            languages[i]=[lan,1];
                            console.log(languages[i]);
                        }
                     }
                }
            }
            languages.sort(function(a, b) {
                return b[1]-a[1];
            });
            
            var paragraph=document.querySelector(".languages");
             if(res.data.length>0) {
                paragraph.innerHTML = languages[0][0]+": "+parseInt(languages[0][1]*100/res.data.length)+"%,&nbsp";
                
            }
            console.log(languages);
            var filtered = languages.filter(function (el) {
                return el != null;
            });
            languages=filtered;
            console.log(languages);
            if(res.data.length>1){
                for(var j=1; j<languages.length;j++){
                    var clone =paragraph.cloneNode(true);
                    var L=document.querySelector(".L");
                    L.appendChild(clone);
                    if(j!=languages.length - 1){
                    
                        if(languages[j]!=null)L.lastChild.innerHTML= languages[j][0]+": "+parseInt(languages[j][1]*100/res.data.length)+"%,&nbsp";
                    }else if(languages[j]!=null)L.lastChild.innerHTML= languages[j][0]+": "+parseInt(languages[j][1]*100/res.data.length)+"%.&nbsp<br>";
             }
             
            
            }
            
        })
    };
    

        showData();
    </script
    
</body>
</html>'
        );
    }
}
?>