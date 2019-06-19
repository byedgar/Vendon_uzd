function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step"); //Get all steps class on page
    for (i = 0; i < x.length; i++) { //for * steps do 
        x[i].className = x[i].className.replace(" active", ""); // remove class active
    }
  
    x[n].className += " active"; // add class active to existing step
         for (i = 0; i < n; i++) { // Get all steps to active
             x[i].className += " complete"; // add class completed
        }
 
}
