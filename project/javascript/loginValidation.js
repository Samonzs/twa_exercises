function scoreEntry(){

    var valid = true;

    var score1 = document.getElementById('score1input').value; // grab the value from the document
    var score1error = document.getElementById('score1error'); // grab the div , that we are going to use for validating, to display msg and prevent it from submitting so the user can correct input
    var score_reg = /^[0-9]$/

    var score2 = document.getElementById('score2input').value; // grab the value from the document
    var score2error = document.getElementById('score2error'); // grab the div , that we are going to use for validating, to display msg and prevent it from submitting so the user can correct input


    score1error.style = ""; // reseting the error calling, to none, so it can update back to its beginning everytime the user inputs

    if (!score_reg.test(score1)  && !score1 == '')   {
        score1error.style = "display: inline-block;"
        valid = false;
    }

    score2error.style = ""; // reseting the error calling, to none, so it can update back to its beginning everytime the user inputs

    if (!score_reg.test(score2)  && !score2 == '')   {
        score2error.style = "display: inline-block;"
        valid = false;
    }




    return valid;


}
