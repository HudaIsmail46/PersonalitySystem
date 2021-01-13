import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import NextOrderStates from './NextOrderStates';
import {dateFormatter, humaniseOrderState, orderAddress} from '../helpers.js';
window.humaniseOrderState = humaniseOrderState;
window.orderAddress= orderAddress;

function OrderTable(props) {
    const { proporders, internal, canreopenorder, cancreateorder, customerservice } = props;
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
                    <th>No.</th>
                    <th>Order Id</th>
                    <th>Woocommerce Order Ref</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Prefered Date Time</th>
                    <th>Status</th>
                    <th>Notis Ambilan </th>
                    <th>Action</th>
                </tr>
                {orders.map((order,index) => {return (
                <tr key={order.id}>
                        <td>
                            {index+1 }
                        </td>
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
                                            <div>Phone No : {order.customer.phone_no}<a href={`https://api.whatsapp.com/send?phone=${order.customer.phone_no}`} target='blank'><i className="fab fa-whatsapp icon-green"></i></a>
                                            <a href={'tel:'+ order.customer.phone_no} target='blank'><i className="fas fa-phone icon-phone"></i></a></div>
                                        )
                                    }
                                })()
                            }
                        </td>
                        <td>
                            {
                                (() => {
                                    if (orderAddress(order) !== null) {
                                        return (
                                            <div>
                                                {(orderAddress(order))}
                                                <a href={`http://maps.google.com/maps?q=${encodeURI(orderAddress(order))}`} target='blank'><i className="fas fa-map-marked-alt icon-blue"></i></a>
                                            </div>

                                        )
                                    }
                                })()
                            }

                        </td>
                        <td>{dateFormatter(order.prefered_pickup_datetime)}</td>
                        <td>{ humaniseOrderState(order.state) }</td>
                        <td>{ order.notice_ambilan_ref}</td>
                        <td>{ internal ? null : cancreateorder == true ? <NextOrderStates order={order} canReopenOrder={canreopenorder} onClick={changeRunnerJobstate}/>  : customerservice == true ? <NextOrderStates order={order} canReopenOrder={canreopenorder} customerService={customerservice} onClick={changeRunnerJobstate}/> :null }
                            { internal ? <a href={`/external/order/${order.id}`}><button className='btn btn-s btn-primary mr-2'>View </button></a> :
                             <a href={`/order/${order.id}`}><button className='btn btn-s btn-primary mr-2'>View </button></a>}
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
