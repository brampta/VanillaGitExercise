<?php

namespace VanillaGit;

class View{
    function show($template,$data=false){
        include('../app/templates/'.$template);
    }
}