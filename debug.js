//alert(123);

var hid1 = document.getElementById('hidevalue');
//alert( hid1.value);
var registrationform = document.querySelector('#registrationform');
registrationform.addEventListener('submit',(e)=>{
    var gender = registrationform.floatingSelectGridGender.value;
    //alert(gender);
    var cstat = registrationform.floatingSelectGridCivilStat.value;
    var course = registrationform.floatingSelectGridcourse.value;
    //alert(gender);
    hid1.value = gender+","+cstat+","+course//+","+cstat+","+course;
    //alert( hid1.value);
});

