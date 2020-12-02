import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import NextOrderStates from './NextOrderStates';

function OrderStateQuickChange(props) {
    const { order } = props;

    const changeRunnerJobstate = (orderId, state) => {
        axios.post(`/order/status/${orderId}`,{state})
            .then(function (_response) {
                location.reload();
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
