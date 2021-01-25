
calculate = function (cal_length,cal_width, total_length,actual_size,type_material,act_price)
{
    var length = document.getElementById(cal_length).value;
    var width = document.getElementById(cal_width).value;
    var material =document.getElementById(type_material).value;
    var total =parseInt(length)*parseInt(width);


    if(total < 35)
    {
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton")
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "XS";
            document.getElementById(act_price).innerHTML="RM " +85;
        }
        else
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "XS";
            document.getElementById(act_price).innerHTML="RM " +50;
        }

    }
    else if(total < 48)
    {
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton")
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "S";
            document.getElementById(act_price).innerHTML="RM " +120;
        }
        else
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "S";
            document.getElementById(act_price).innerHTML="RM " +85;
        }
    }
    else if(total< 63)
    {
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton")
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "M";
            document.getElementById(act_price).innerHTML="RM" +175;
        }
        else
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "M";
            document.getElementById(act_price).innerHTML="RM " +120;
        }
    }
    else{
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton")
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "L";
            document.getElementById(act_price).innerHTML="RM " +280;
        }
        else
        {
            document.getElementById(total_length).innerHTML =total + " ft";
            document.getElementById(actual_size).innerHTML = "L";
            document.getElementById(act_price).innerHTML="RM " +200;
        }
    }

}
