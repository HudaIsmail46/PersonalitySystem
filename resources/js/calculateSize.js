
calculate = function (cal_length,cal_width, total_length,actual_size)
{
    var length = document.getElementById(cal_length).value;
    var width = document.getElementById(cal_width).value;
    var total =parseInt(length)*parseInt(width);


    if(total < 35)
    {   document.getElementById(total_length).innerHTML =total + " ft";
        document.getElementById(actual_size).innerHTML = "XS";
    }
    else if(total < 48)
    {
        document.getElementById(total_length).innerHTML =total + " ft";
        document.getElementById(actual_size).innerHTML = "S";
    }
    else if(total< 63)
    {
        document.getElementById(total_length).innerHTML =total + " ft";
        document.getElementById(actual_size).innerHTML = "M";
    }
    else{
        document.getElementById(total_length).innerHTML =total + " ft";
        document.getElementById(actual_size).innerHTML = "l";
    }

}
