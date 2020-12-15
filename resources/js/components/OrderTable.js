import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import NextOrderStates from './NextOrderStates';
import {dateFormatter, humaniseOrderState} from '../helpers.js';
window.humaniseOrderState = humaniseOrderState;



function OrderTable(props) {
    const { proporders, internal, canreopenorder } = props;
    const [orders, setOrders] = useState(proporders.data);


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
        <table className="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>Order Id</th>
                    <th>Woocommerce Order Ref</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Prefered Date Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                {orders.map(order => {return (
                <tr key={order.id}>
                        <td>
                            <a href={internal ? `/external/order/${order.id}`:`/order/${order.id}`}>{ order.id }</a>
                        </td>
                        <td>{ order.woocommerce_order_id }</td>
                        <td>
                            { order.customer.name }
                            <br/>
                            {
                                (() => {
                                    if (order.customer.phone_no !== null) {
                                        return (
                                            <div>Phone No : {order.customer.phone_no}<a href={`https://api.whatsapp.com/send?phone=${order.customer.phone_no}`} target='blank'><i class="fab fa-whatsapp icon-green"></i></a></div>
                                        )
                                    }
                                })()
                            }
                        </td>
                        <td>
                            {order.address_1},<br/>
                            {order.address_2},<br/>
                            {order.postcode},<br/>
                            {order.city},<br/>
                            {order.location_state}
                        </td>
                        <td>{dateFormatter(order.prefered_pickup_datetime)}</td>
                        <td>{ humaniseOrderState(order.state) }</td>
                        <td>{ internal ? null : <NextOrderStates order={order} canReopenOrder={canreopenorder} onClick={changeRunnerJobstate}/>}
                            { internal ? <a href={`/external/order/${order.id}`}><button class='btn btn-s btn-primary mr-2'>View </button></a> :
                             <a href={`/order/${order.id}`}><button class='btn btn-s btn-primary mr-2'>View </button></a>}
                        </td>
                    </tr>
                )})}
            </tbody>
        </table>
    );
}

export default OrderTable;
const element = document.getElementById("OrderTable");
if (element) {
    let props = Object.assign({}, element.dataset);
    Object.keys(props).map(key=> props[key] = JSON.parse(props[key]));
    ReactDOM.render(<OrderTable {...props}/>, element);
}
