require(dropzone.js);

var image = document.getElementById('image');
if(image){
    var config = image.getAttribute('config');

    new Dropzone(image, JSON.parse(config));
}

var order = document.getElementById('order');
if(order){
    var config = order.getAttribute('config');

new Dropzone(order, JSON.parse(config));
}
