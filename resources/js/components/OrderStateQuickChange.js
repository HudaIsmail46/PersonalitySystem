import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import NextOrderStates from './NextOrderStates';

function OrderStateQuickChange(props) {
    const { order } = props;

    const changeRunnerJobstate = (orderId, state) => {
        axios.post(`/order/status/${orderId}`,{state})
            .then(function (response) {
                let orderList = orders.map((order)=> {
                    let orderObj = order;
                    if(order.id == response.data.id){
                        orderObj = response.data
                    }

                    return orderObj;
                })
                
                setOrders(orderList);
            })
            .catch(function (error) {
                
            });
    }

    return (
        <div>
            <NextOrderStates order={order} onClick={changeRunnerJobstate}/>
        </div>
    );
}

export default OrderStateQuickChange;
const element = document.getElementById("OrderStateQuickChange");

if (element) {
    let props = Object.assign({}, element.dataset);
    Object.keys(props).map(key=> props[key] = JSON.parse(props[key]));
    ReactDOM.render(<OrderStateQuickChange {...props}/>, element);
}
