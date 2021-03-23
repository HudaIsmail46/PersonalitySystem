
calculate = function ()
{
    var length = document.getElementById('cal_length').value;
    var width = document.getElementById('cal_width').value;
    var material = document.getElementById('type_material').value;
    var walk_in = document.getElementById('walk_in').checked;
    var total = parseInt(length)*parseInt(width);
    var size;
    var price

    if(total < 35){
        size = 'XS';
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton"){
            if (walk_in) {
                price = 55;
            } else {
                price = 85;
            }
        } else {
            if (walk_in) {
                price = 35;
            } else {
                price = 50;
            }
        }

    } else if(total < 48){
        size = 'S';
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton"){
            if (walk_in) {
                price = 95;
            } else {
                price = 120;
            }
        } else {
            if (walk_in) {
                price = 65;
            } else {
                price = 85;
            }
        }
    } else if(total< 63){
        size = 'M';
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton"){
            if (walk_in) {
                price = 140;
            } else {
                price = 175;
            }
        } else {
            if (walk_in) {
                price = 95;
            } else {
                price = 120;
            }
        }
    } else {
        size = 'L';
        if(material == "wool" || material =="silk" || material =="shaggy" || material =="cotton"){
            if (walk_in) {
                price = 210;
            } else {
                price = 280;
            }
        } else {
            if (walk_in) {
                price = 135;
            } else {
                price = 200;
            }
        }
    }

    document.getElementById('total_length').innerHTML = total + " ft";
    document.getElementById('actual_size').innerHTML = size;
    document.getElementById('act_price').innerHTML="RM " + price;

}
