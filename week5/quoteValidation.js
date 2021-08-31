function validationForm(){
var valid = true;

    var date = document.getElementById('sdate').value; // grab the value from the document
    var dateError = document.getElementById('sdateError'); // grab the div , that we are going to use for validating, to display msg and prevent it from submitting so the user can correct input
    var date_reg = /^\d{1,2}\/\d{1,2}\/\d{4}$/ // the rule, that needs to be applied, dd/mm/yyyy
    dateError.style = ""; // reseting the error calling, to none, so it can update back to its beginning everytime the user inputs

    if (!date_reg.test(date))   {
        dateError.style = "display: inline-block;"
        valid = false;
    }

    var pdate = document.getElementById('date').value;
    var pdateError = document.getElementById('pdateError');
    pdateError.style = "";

    if (!date_reg.test(pdate) && !pdate == '')   {
        pdateError.style = "display: inline-block;"
        valid = false;
    }

   var staffnumber = document.getElementById('staffnumber').value;
   var staffNumberError = document.getElementById('staffNumberError');
   staffNumberError.style = "";
   var staffnumber_reg = /^[a-zA-Z]{3}[0-9]{4}$/;

   if (!staffnumber_reg.test(staffnumber)){
         staffNumberError.style = "display: inline-block;"
         valid = false;
     }

   // Customer Details
   var fname = document.getElementById('fname').value;
   var firstNameError = document.getElementById('firstNameError');
   firstNameError.style = "";
   var customerName_reg = /[a-zA-Z -]+/;


   var sname = document.getElementById('sname').value;
   var surNameError = document.getElementById('surNameError');
   surNameError.style = "";

   if(!customerName_reg.test(sname)){
       surNameError.style = "display: inline-block;"
       valid = false;
  }
   var suburb = document.getElementById('suburb').value;
   var suburbError = document.getElementById('suburbError');
   suburbError.style = "";


   if(!customerName_reg.test(suburb)){
       suburbError.style = "display: inline-block;"
       valid = false;
   }


   var address = document.getElementById('address').value;
   var addressError = document.getElementById('addressError');
   addressError.style = "";
   var addressError_reg = /[0-9a-zA-Z/ -]+/;

   var postcode = document.getElementById('postcode').value;
   var postcodeError = document.getElementById('postcodeError');
   postcodeError.style = "";
   var postCode_reg = /^[0-9]{4}$/;

   var email = document.getElementById('email').value;
   var emailError = document.getElementById('emailError');
   emailError.style = "";

   var email_reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/
   // this reg ex was assisted by stack overflow website,the solution of a similar question

   var pnumber = document.getElementById('pnumber').value;
   var phoneNumberError = document.getElementById('phoneNumberError');
   phoneNumberError.style = "";
   var phoneNumber_reg = /^0(2|4)[0-9]{8}$/;

   var email = document.getElementById('email').value;
   var emailError = document.getElementById('emailError');
   emailError.style = "";



   if(!addressError_reg.test(address)){
       addressError.style = "display: inline-block;"
       valid = false;
   }



   if(!postCode_reg.test(postcode) && !postcode == ''){
       postcodeError.style = "display: inline-block;"
       valid = false;
   }

    if (!email_reg.test(email) && !email == ''){
       emailError.style = "display: inline-block;"
       valid = false;
    }

    if (!phoneNumber_reg.test(pnumber) && !pnumber == ''){
        phoneNumberError.style = "display: inline-block;"
        valid = false;
    }

    // Product Details
    /*
     product ID is mandatory for the first product the customer wants to input,
     because we are unsure with how many products the customer wants to enter,
     so since thats the case ive made the first product mandatory only,
     the regular expressions are still applied with the other rows of product details
     for validation incase an customer enters a negative quantity value.
     I have made it so that if the user enters a quantity,description or unit price then they must
     have a product ID for that product as it is required
    */


    var pname = document.getElementById('pname').value;
    var pnameError = document.getElementById('pnameError');
    pnameError.style = "";
    var pname_reg = /^.{0,60}$/

    if(!pname_reg.test(pname) && !pname =='') {
        pnameError.style = "display: inline-block;"
        valid = false;
    }

    var productID = document.getElementById('productID').value;
    var pIDerror = document.getElementById('pIDerror');
    pIDerror.style = "";

    if(productID == '') {
        pIDerror.style = "display: inline-block;"
        valid = false;
    }


    var quantity = document.getElementById('quantity').value;
    var quantityError = document.getElementById('quantityError');
    quantityError.style = "";
    var quantity_reg = /^([0-1]?[1-9]|20)$/


    if(!quantity_reg.test(quantity) && !quantity =='') {
        quantityError.style = "display: inline-block;"
        valid = false;
    }

    var unitPrice = document.getElementById('unitPrice').value;
    var unitPriceError = document.getElementById('unitPriceError');
    unitPriceError.style = "";
    var unitPrice_reg =/^[1-9]+[0-9]*$/


    if(!unitPrice_reg.test(unitPrice) && !unitPrice =='') {
        unitPriceError.style = "display: inline-block;"
        valid = false;
    }

// validation check , for the products 2,3,4 and 5
// validation incase the user inputs inside quantiy, unitprice or pname without entering a prodcut ID.

        var quantityI = document.getElementById('quantity').value;
        var pnameI = document.getElementById('pname').value;
        var unitPriceI = document.getElementById('unitPrice').value;
        var productIDI = document.getElementById('productID').value;
        var pIDerrorI = document.getElementById('pIDerror');
        var unitPriceErrorI = document.getElementById('unitPriceError');
        var pnameErrorI = document.getElementById('pnameError');
        var quantityErrorI = document.getElementById('quantityError');

        for(var i = 0; i < 4; i++) {

        quantityI = document.getElementById('quantity' +  (i+1).toString()).value;
        pnameI = document.getElementById('pname' +  (i+1).toString()).value;
        unitPriceI = document.getElementById('unitPrice' +  (i+1).toString()).value;
        productIDI = document.getElementById('productID' +  (i+1).toString()).value;
        pIDerrorI = document.getElementById('pIDerror' +  (i+1).toString());
        unitPriceErrorI = document.getElementById('unitPriceError' + (i+1).toString());   //we iterate through the IDs and make it look neater by reducing redundancy, so we loop through a for loop
        quantityErrorI = document.getElementById('quantityError' +  (i+1).toString());
        pnameErrorI = document.getElementById('pnameError' +  (i+1).toString());
        pIDerrorI.style = "";
        quantityErrorI.style = ""
        unitPriceErrorI.style = ""
        pnameErrorI.style = ""

        if(productIDI == '' && (quantityI != '' || pnameI != '' || !unitPriceI == '')){
            pIDerrorI.style = "display: inline-block;"
            valid = false;
        }

        if(!quantity_reg.test(quantityI) && !quantityI =='') {   // validation incase the user enters a value in t he properties boxed without an ID
            quantityErrorI.style = "display: inline-block;"
            valid = false;
        }

        if(!unitPrice_reg.test(unitPriceI) && !unitPriceI =='') {
            unitPriceErrorI.style = "display: inline-block;"
            valid = false;
        }

        if(!pname_reg.test(pnameI) && !pnameI =='') {
            pnameErrorI.style = "display: inline-block;"
            valid = false;
        }
    }

        var depositpaid = document.getElementById('depositpaid').value;
        var depositError = document.getElementById('depositError');
        depositError.style = "";
        var deposit_reg =/^[0-9]*$/


        if(!deposit_reg.test(depositpaid) && !depositpaid =='') {
            depositError.style = "display: inline-block;"
            valid = false;
        }


    calculation(depositpaid); // calling the function , inside the function that is being returned from html


  return valid;
}

function calculation(depositpaid){
    var valid2 = true;

    var quantity = document.getElementById('quantity').value;
    var unitPrice = document.getElementById('unitPrice').value;     // calling and creating the methods inside this function so "onblur" updates accordingly in the form
    var lineTotal = quantity * unitPrice;
    document.getElementById('lineTotal').value = lineTotal;
    //retrieving each linetotal value for calculation
    var quantity1 = document.getElementById('quantity1').value;
    var unitPrice1 = document.getElementById('unitPrice1').value;
    var lineTotal1 = quantity1 * unitPrice1;
    document.getElementById('lineTotal1').value = lineTotal1;

    var quantity2 = document.getElementById('quantity2').value;
    var unitPrice2 = document.getElementById('unitPrice2').value;
    var lineTotal2 = quantity2 * unitPrice2;
    document.getElementById('lineTotal2').value = lineTotal2;

    var quantity3 = document.getElementById('quantity3').value;
    var unitPrice3 = document.getElementById('unitPrice3').value;
    var lineTotal3 = quantity3 * unitPrice3;
    document.getElementById('lineTotal3').value = lineTotal3;

    var quantity4 = document.getElementById('quantity4').value;
    var unitPrice4 = document.getElementById('unitPrice4').value;
    var lineTotal4 = quantity4 * unitPrice4;
    document.getElementById('lineTotal4').value = lineTotal4;

    var arr = [lineTotal,lineTotal1,lineTotal2,lineTotal3,lineTotal4];
    var subTotal = 0;           // summing all the values in an array
    for(var i in arr){
        subTotal += arr[i];
    }
    document.getElementById('subtotal').value = subTotal;

    var gst = 0.1 * subTotal;
    document.getElementById('gst').value = gst;

    var total = subTotal + gst;
    document.getElementById('total').value = total;

    var depositError2 = document.getElementById('depositError2');
    depositError2.style = "";
    if(depositpaid > total ) {
        depositError2.style = "display: inline-block;"  // validation of deposit paid cannot be more then the total
        valid2 = false;
    }

    var totalDue = total - depositpaid;
    if(totalDue >= 0){
        document.getElementById('totaldue').value = totalDue;
    }
    if(totalDue <= 0){
        totalNegativeError.style = "display: inline-block;"
        document.getElementById('totaldue').value = totalDue;  // i wanted to alert the user that if the total due is a negative, then it is invalid, as it doesnt make any logical sense
        valid2 = false;
    }

    return valid2;
}
