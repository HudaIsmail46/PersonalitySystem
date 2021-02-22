import dateFormat  from 'dateformat';
require('dateformat');

export const dateFormatter = (dateTime) => {
    return (
        dateFormat(dateTime, " yyyy-mm-dd HH:MM").substring(0, 19)
    );
}

export const humaniseOrderState = (state) => {
    return (
            state.replace( "App\\State\\Order\\", "")
                .replace(/([a-z])([A-Z])/g, '$1 $2')
    );
}

export const orderAddress =(order) => {

    if (order.address_1 !== null || order.address_2 !== null || order.address_3 !== null || order.postcode !== null || order.city !== null || order.location_state !== null) {
        return (
                order = order.address_1.concat(order.address_2 ,',', order.address_3, ',', order.postcode , ',' , order.city , ',' , order.location_state),
                order.replaceAll("null","")
                     .replaceAll(',,' ,', ')
        )
    }
}

$(function () {
    $('[data-toggle="popover"]').popover()
})

