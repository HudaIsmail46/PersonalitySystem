import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import dateFormat from 'dateformat';


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

    const changeRunnerJobstate = (scheduledOrder) => {
        axios.post(`/runner_job/status/${scheduledOrder.id}`,{})
              .then(function (response) {
                setRunnerJobs(response.data.runnerJobs);
              })
              .catch(function (error) {
                console.log(error);
              });
        setRunnerJob({});
    }

    const closeModal = () =>{
        setOrder({});
        setModalShow(false);
    }

    const handleChange = (input) => {
        setRunnerJob({
            ...runnerJob,
            runner_schedule_id: runnerschedule.id,
            order_id: order.id,
            scheduled_at: input.target.value
        })
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
                                            type="datetime-local"
                                            name="scheduled_at"
                                            id="scheduled_at"
                                            value = {dateFormat(runnerJob.scheduled_at, "isoDateTime").substring(0,19)}
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
                        <th>Id</th>
                        <th>Scheduled At</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Customer</th>
                        <th></th>
                    </tr>
                    {runnerJobs.map(scheduledOrder => {return (
                        <tr key={scheduledOrder.id} >
                            <td>{scheduledOrder.id}</td>
                            <td>{scheduledOrder.scheduled_at}</td>
                            <td>{scheduledOrder.job_type}</td>
                            <td>
                                {scheduledOrder.order.address_1},<br></br>
                                {scheduledOrder.order.address_2},<br></br>
                                {scheduledOrder.order.postcode},<br></br>
                                {scheduledOrder.order.city},<br></br>
                                {scheduledOrder.order.location_state}
                            </td>
                            <td>
                                Name : {scheduledOrder.order.customer.name}
                                <br/>
                                Phone No : {scheduledOrder.order.customer.phone_no}
                            </td>
                            <td><div className="btn btn-primary" onClick={()=> editRunnerJob(scheduledOrder)}>Edit Schedule</div></td>
                            <td>
                                {(() => {
                                if (scheduledOrder.order.state == "App\\State\\Order\\PickupScheduled" || scheduledOrder.order.state == "App\\State\\Order\\ReturnScheduled") {
                                return (
                                    <div className="btn btn-success btn-block" onClick={()=> changeRunnerJobstate(scheduledOrder)}>Collected</div>
                                )
                                } else if( scheduledOrder.order.state == "App\\State\\Order\\Collected") {
                                return (
                                    <div className="btn btn-success btn-block" onClick={()=> changeRunnerJobstate(scheduledOrder)}>Received Warehouse</div>
                                )
                                }else if( scheduledOrder.order.state == "App\\State\\Order\\ReceivedWarehouse"){
                                return (
                                <div>
                                    <p>
                                        <button className="btn btn-success btn-block" onClick={()=> changeRunnerJobstate(scheduledOrder)}>Vendor Collected</button>
                                        <button className="btn btn-success btn-block" onClick={()=> changeRunnerJobstate(scheduledOrder)}>InHouse Cleaning</button>
                                    </p>
                                </div>
                                )
                                }else{
                                    return(
                                        null
                                    )
                                }
                                })()
                                }
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
                        <th>Id</th>
                        <th>Status</th>
                        <th>Prefered Pickup</th>
                        <th>Location</th>
                        <th>Customer</th>
                        <th></th>
                    </tr>
                    {orders.map(order => {return (
                        <tr key={order.id} >
                            <td>{order.id}</td>
                            <td>{order.state}</td>
                            <td>{order.prefered_pickup_datetime}</td>
                            <td>{order.address_1},<br></br>
                                {order.address_2},<br></br>
                                {order.postcode},<br></br>
                                {order.city},<br></br>
                                {order.location_state}
                            </td>
                            <td>
                                Name : {order.customer.name}
                                <br/>
                                Phone No : {order.customer.phone_no}
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
            Runner Jobs
           {runnerJobsTable()}

            Orders to be scheduled
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
