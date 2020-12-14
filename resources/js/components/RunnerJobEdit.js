import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {dateFormatter, humaniseOrderState} from '../helpers.js';
import dateFormat from 'dateformat';
window.humaniseOrderState = humaniseOrderState;

function RunnerJobEdit(props) {
    const { proporders, runnerschedule, runnerjobs } = props;
    const [modalShow, setModalShow] = useState(false);
    const [order, setOrder] = useState({});
    const [orders, setOrders] = useState(proporders);
    const [runnerJobs, setRunnerJobs] = useState(runnerjobs);
    const [runnerJob, setRunnerJob] = useState({});

    const scheduleOrder = (order) => {
        setOrder(order);
        setModalShow(true);
    }

    const editRunnerJob = (runnerJob) => {
        setRunnerJob(runnerJob);
        setModalShow(true);
    }

    const closeModal = () =>{
        setOrder({});
        setModalShow(false);
    }

    const handleChange = (input) => {
        let scheduled_at = dateFormat(runnerschedule.scheduled_at, 'yyyy-mm-dd')
        scheduled_at = scheduled_at + ' ' + input.target.value + ':00'
        setRunnerJob({
            ...runnerJob,
            runner_schedule_id: runnerschedule.id,
            order_id: order.id,
            scheduled_at: scheduled_at
        })
    }

    const orderStatuses = (state) => {
        if(state == "App\\State\\Order\\Completed" ){
            status = "Completed"
        }
        else if(state == "App\\State\\Order\\PendingPickupSchedule" || state == "App\\State\\Order\\PendingReturnSchedule"){
            status = "Canceled"
        }
        return (
            status
        );
    }

    const canceledRunnerJob = (runnerJobState) => {
        if (runnerJobState == "canceled")
          return  true;
    }

    const submit = () => {
        if(runnerJob.id){
            axios.put(`/runner_job/${runnerJob.id}`,{
                scheduled_at: runnerJob.scheduled_at
            })
              .then(function (response) {
                setRunnerJobs(response.data.runnerJobs);
                setOrders(response.data.orders);
              })
              .catch(function (error) {
                console.log(error);
              });
        }else{
            axios.post(`/runner_job/`,runnerJob)
              .then(function (response) {
                setRunnerJobs(response.data.runnerJobs);
                setOrders(response.data.orders);
              })
              .catch(function (error) {
                console.log(error);
              });
        }
        setRunnerJob({});
        closeModal();
    }

    const onDelete = () => {
        axios.delete(`/runner_job/${runnerJob.id}`)
            .then(function(response){
                setRunnerJobs(response.data.runnerJobs);
                setOrders(response.data.orders);
            })
            .catch(function (error) {
                console.log(error);
              });
            setRunnerJob({});
            closeModal();
    }

    const runnerJobForm = () => {
        let timeValue = dateFormat(runnerJob.scheduled_at, "HH:MM");
        return (
            <div className="box">
                <div className="modal fade show d-block" tabIndex="-1">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title">Schedule Order</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close" onClick={closeModal}>
                                <   span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body">
                                <div className="field" >
                                    <label className="label" >Schedule for </label>
                                    <div className="form-group">
                                        <input className="input"
                                            type="time"
                                            name="scheduled_at"
                                            id="scheduled_at"
                                            value = {timeValue}
                                            onChange={handleChange}
                                            />
                                    </div>
                                </div>
                            </div>
                            <div className="modal-footer">
                                {runnerJob.id && (
                                    <button type='button' className='btn btn-danger' onClick={onDelete}>Delete</button>
                                )}
                                <button type="button" className="btn btn-secondary" data-dismiss="modal" onClick={closeModal}>Close</button>
                                <button type="button" className="btn btn-primary" onClick={submit}>Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    const runnerJobsTable = () => {
        return (
            <div className="table-responsive">
            <table className="table table-bordered">
                <tbody>
                    <tr>
                        <th>Runner Job Id</th>
                        <th>Scheduled At</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Customer</th>
                        <th>Order</th>
                        <th></th>
                    </tr>
                    {runnerJobs.map(scheduledOrder => {return (
                        <tr key={scheduledOrder.id} >
                            <td>{canceledRunnerJob(scheduledOrder.state) ? <del>{scheduledOrder.id}</del> :
                                 scheduledOrder.id}
                            </td>
                            <td>{canceledRunnerJob(scheduledOrder.state) ? <del>{scheduledOrder.scheduled_at}</del> :
                                 scheduledOrder.scheduled_at}
                            </td>
                            <td>{canceledRunnerJob(scheduledOrder.state) ? <del>{scheduledOrder.job_type}</del> :
                                 scheduledOrder.job_type}
                            </td>
                            <td>
                                {canceledRunnerJob(scheduledOrder.state) ?
                                <del>
                                    {scheduledOrder.order.address_1},<br></br>
                                    {scheduledOrder.order.address_2},<br></br>
                                    {scheduledOrder.order.postcode},<br></br>
                                    {scheduledOrder.order.city},<br></br>
                                    {scheduledOrder.order.city},<br></br>
                                    {scheduledOrder.order.location_state}
                                </del> :
                                <p>
                                    {scheduledOrder.order.address_1},<br></br>
                                    {scheduledOrder.order.address_2},<br></br>
                                    {scheduledOrder.order.postcode},<br></br>
                                    {scheduledOrder.order.city},<br></br>
                                    {scheduledOrder.order.location_state}
                                </p>}
                            </td>
                            <td>
                                {canceledRunnerJob(scheduledOrder.state) ?
                                <del>
                                    Name : {scheduledOrder.order.customer.name} <br/>
                                    Phone No : {scheduledOrder.order.customer.phone_no}
                                                <a href={`https://api.whatsapp.com/send?phone=${scheduledOrder.order.customer.phone_no}`}><i class="fab fa-whatsapp" style={{color: 'rgb(79, 206, 93)',marginLeft:'2px'}}></i></a>
                                </del> :
                                <p>
                                    Name : {scheduledOrder.order.customer.name} <br/>
                                    Phone No : {scheduledOrder.order.customer.phone_no}
                                                <a href={`https://api.whatsapp.com/send?phone=${scheduledOrder.order.customer.phone_no}`}><i class="fab fa-whatsapp"  style={{color: 'rgb(79, 206, 93)',marginLeft:'2px'}}></i></a>
                                </p>}
                            </td>
                            <td>{canceledRunnerJob(scheduledOrder.state) ?
                                <del>
                                    Id : {scheduledOrder.order.id}<br></br>
                                    {humaniseOrderState(scheduledOrder.order.state)}
                                </del> :
                                <p>
                                    Id : <a href={`/order/${scheduledOrder.order.id}`}>{scheduledOrder.order.id}</a><br></br>
                                    {humaniseOrderState(scheduledOrder.order.state)}
                                </p>}
                            </td>
                            <td>{ orderStatuses(scheduledOrder.order.state) ? status :
                                  <div className="btn btn-primary" onClick={()=> editRunnerJob(scheduledOrder)}>Edit Schedule</div>}
                            </td>
                        </tr>
                    )})}
                </tbody>
            </table>
            </div>
        )
    }

    const ordersTable = () => {
        return (
            <div className="table-responsive">
            <table className="table table-bordered">
                <tbody>
                    <tr>
                        <th>Order Id</th>
                        <th>Status</th>
                        <th>Prefered Pickup</th>
                        <th>Location</th>
                        <th>Customer</th>
                        <th></th>
                    </tr>
                    {orders.map(order => {return (
                        <tr key={order.id} >
                            <td>{order.id}</td>
                            <td>{humaniseOrderState(order.state)}</td>
                            <td>{dateFormatter(order.prefered_pickup_datetime )}</td>
                            <td>
                                {order.address_1},<br></br>
                                {order.address_2},<br></br>
                                {order.postcode},<br></br>
                                {order.city},<br></br>
                                {order.location_state}
                            </td>
                            <td>
                                Name : {order.customer.name}
                                <br/>
                                Phone No : {order.customer.phone_no}
                                            <a href={`https://api.whatsapp.com/send?phone=${order.customer.phone_no}`}><i class="fab fa-whatsapp"  style={{color: 'rgb(79, 206, 93)',marginLeft:'2px'}}></i></a>
                            </td>
                            <td><div className="btn btn-primary" onClick={()=> scheduleOrder(order)}>Add to Runner Schedule</div></td>
                        </tr>
                    )})}
                </tbody>
            </table>
            </div>
        )
    }

    return (
        <div className="field">
            {modalShow && runnerJobForm()}
            <h3>Runner Jobs</h3>
            {runnerJobsTable()}

            <h3>Orders to be scheduled</h3>
            {ordersTable()}
        </div>
    );
}

export default RunnerJobEdit;
const element = document.getElementById("RunnerJobEdit");
if (element) {
    let props = Object.assign({}, element.dataset);
    Object.keys(props).map(key=> props[key] = JSON.parse(props[key]));
    ReactDOM.render(<RunnerJobEdit {...props}/>, element);
}
