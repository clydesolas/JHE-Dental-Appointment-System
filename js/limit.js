//alert(123)
var timer = document.getElementById('timerid');
var  clock = document.getElementById('clock');
var buttonidlogin = document.getElementById('buttonidlogin');
var tvalue = timer.value;// "                   TRUE                    "
//console.log(timer.value);
var boolval = tvalue.replace(/\s+/g, '');// truns into "TRUE"
//var timeint = 0;
var datevalid = document.getElementById('datevalid');
//console.log(datevalid.value)

var timer = "";
if (boolval == "true") {
    clock.style.display = "block";
    buttonidlogin.className = "btn login_btn button disabled";
   //alert(starttime);
   timer = setInterval(clockticking, 1000);



}else{
    clock.style.display = "none";
    buttonidlogin.className = "btn login_btn button"
}


/*time
function clockticking() {
    timeint++;
    if (timeint >= 10) {
        //alert("end");
        clock.style.display = "none";
        buttonidlogin.className = "btn login_btn button";
        timer.value = "";
        var limit = document.getElementById('counterlimitid');
        limit.value = 0;
        clearInterval(timer);
    }
    clock.innerHTML = "Please wait for "+ (10 -timeint)+" seconds before loggin in";
}
*/
function clockticking() {
    var dateval = datevalid.value.replace(/\s+/g, '');
    var d = new Date();
    var now = Math.round(d.getTime()/1000);
   // console.log(now, dateval)

    var dif = now - dateval

    if (dif >= 10) {
        //alert("end");
        clock.style.display = "none";
        buttonidlogin.className = "btn login_btn button";
        timer.value = "";
        var limit = document.getElementById('counterlimitid');
        limit.value = 0;
        clearInterval(timer);
        
    }
    clock.innerHTML = "Please wait for "+ (10 - dif)+" seconds before loggin in";
}


var loginform = document.querySelector('#loginform');
loginform.addEventListener('submit',(e)=>{
    var counter = loginform.counterlimitid.value;
    var added = parseInt(counter);
    var limit = document.getElementById('counterlimitid');
    var datevalid = document.getElementById('datevalid');
    limit.value = added+1;
    
    if (limit.value > 2) {
        //datevalid.value = Math.round(d.getTime()/1000);
        //Math.round(d.getTime()/1000)
        var d = new Date();
        var timedateval =  Math.round(d.getTime()/1000);
        datevalid.value = timedateval;
        //alert(timedateval)
    }
    //console.log("dateval ",datevalid.value)
    

})