<?php

function showErrorSessionValue($sessionName)
{
    if (isset($_SESSION[$sessionName])) {

        $html = '
            <div>
                <p class = "error">
                    ' . $_SESSION[$sessionName] . '
                </p>
            </div>
        ';

        echo $html;

        unset($_SESSION[$sessionName]);
    }
}

function showSessionActionValueWithColor($sessionName, $color)
{
    if (isset($_SESSION[$sessionName])) {

        $html = '
            <div style = "color: ' . $color . '; text-align: center;" class = "feedback-size">  
                <p>
                    ' . $_SESSION[$sessionName] . '
                </p>
            </div>
        ';

        echo $html;
        unset($_SESSION[$sessionName]);
    }
}


function showSessionValue($sessionName)
{
    if (isset($_SESSION[$sessionName])) {
        echo $_SESSION[$sessionName];
        unset($_SESSION[$sessionName]);
    }
}
