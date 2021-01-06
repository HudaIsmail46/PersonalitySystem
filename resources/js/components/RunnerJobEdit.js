import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {dateFormatter, humaniseOrderState, orderAddress} from '../helpers.js';
import dateFormat from 'dateformat';
import DataTable from "react-data-table-component";

function RunnerJobEdit(props) {
    const { proporders, runnerschedule, runnerjobs } = props;
    const [modalShow, setModalShow] = useState(false);
    const [order, setOrder] = useState({});
    const [orders, setOrders] = useState(proporders);
    const [searchState, setSearchState] =useState("");
    const [searchAddress, setSearchAddress] =useState("");
    const [searchCustomerName, setSearchCustomerName] =useState("");
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
        let status;
        if(state == "App\\State\\Order\\Completed" ){
            status = "Completed"
        }
        else if(state == "App\\State\\Order\\PendingPickupSchedule" || state == "App\\State\\Order\\PendingReturnSchedule"){
            status = "Canceled"
        }
        return status;
    }

    const canceledRunnerJob = (runnerJobState) => {
        return runnerJobState == "canceled";
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

    const displayAddress = (order) => {
        if (orderAddress(order) !== null) {
            return (
                <React.Fragment>
                   {orderAddress(order)}
                    <a href={`http://maps.google.com/maps?q=${encodeURI(orderAddress(order))}`} target='blank'><i className="fas fa-map-marked-alt icon-blue"></i></a>
                </React.Fragment>
            )
        }
    }

    const sortByScheduledFor = (scheduledOrder) => {
        return scheduledOrder.sort(function(a,b){
            return new Date(a.scheduled_at) - new Date(b.scheduled_at);
          });
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

    const runnerJobsTable = () => (
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
                        <th>Notis Ambilan</th>
                        <th></th>
                    </tr>
                    {sortByScheduledFor(runnerJobs).map(scheduledOrder => (
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
                                    {displayAddress(scheduledOrder.order)}

                                </del> :
                                <p>
                                    {displayAddress(scheduledOrder.order)}
                                </p>}
                            </td>
                            <td>
                                {canceledRunnerJob(scheduledOrder.state) ?
                                <del>
                                    Name : {scheduledOrder.order.customer.name} <br/>
                                    {(scheduledOrder.order.customer.phone_no !== null) && (
                                        <div>Phone No : {scheduledOrder.order.customer.phone_no}<a href={`https://api.whatsapp.com/send?phone=${scheduledOrder.order.customer.phone_no}`} target='blank'><i className="fab fa-whatsapp icon-green"></i></a>
                                        <a href={'tel:'+ scheduledOrder.order.customer.phone_no} target='blank'><i className="fas fa-phone icon-phone"></i></a></div>
                                    )}
                                    {(scheduledOrder.order.walk_in_customer == '1') && (
                                                <div><span className="badge badge-success">walk in customer</span></div>
                                    )}
                                </del> :
                                <p>
                                    Name : {scheduledOrder.order.customer.name} <br/>
                                    {(scheduledOrder.order.customer.phone_no !== null) && (
                                        <span>Phone No : {scheduledOrder.order.customer.phone_no}<a href={`https://api.whatsapp.com/send?phone=${scheduledOrder.order.customer.phone_no}`} target='blank'><i className="fab fa-whatsapp icon-green"></i></a>
                                        <a href={'tel:'+ scheduledOrder.order.customer.phone_no} target='blank'><i className="fas fa-phone icon-phone"></i></a></span>
                                    )}
                                    {(scheduledOrder.order.walk_in_customer == '1') && (
                                        <div><span className="badge badge-success">walk in customer</span></div>
                                    )}
                                </p>}
                            </td>
                            <td>{canceledRunnerJob(scheduledOrder.state) ?
                                <del>
                                    Id : {scheduledOrder.order.id}<br></br>
                                    {humaniseOrderState(scheduledOrder.order.state)}
                                </del> :
                                <p>
                                    Id : <a href={`/order/${scheduledOrder.order.id}`}>{scheduledOrder.order.id}</a><br/>
                                    {humaniseOrderState(scheduledOrder.order.state)}<br/>

                                </p>}
                            </td>
                            <td>
                                {scheduledOrder.order.notice_ambilan_ref}
                            </td>
                            <td>{ orderStatuses(scheduledOrder.order.state) ?? (
                                <span className="btn btn-primary" onClick={()=> editRunnerJob(scheduledOrder)}>Edit Schedule</span>)}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
    

    const customStyles = {
        headCells: {
          style: {
            fontSize: '17px',
            fontWeight: '600',
            '&:not(:last-of-type)': {
                          borderRightStyle: 'ridge',
                          borderRightWidth: '1px',
          },
          },
        },
        cells: {
          style: {
            fontSize: '16px',
            '&:not(:last-of-type)': {
                          borderRightStyle: 'ridge',
                          borderRightWidth: '1px',
                          borderRightColor: 'ridge',
                        },
          },
        },
        headRow: {
          style: {
            borderTopStyle: 'ridge',
            borderTopWidth: '1px',
            borderTopColor: 'ridge',
          },
        },
      };

    const columns = [
        {
          name: "Order Id",
          selector: "id",
          sortable: true,
          cell: row => <div className="col-md-4"><div>{row.id}</div></div>,
        },
        {
          name: "Status",
          selector: "state",
          sortable: true,
          cell: row => <div><div>{humaniseOrderState(row.state)}</div></div>,
        },
        {
          name: "Prefered pickup",
          selector: "prefered_pickup_datetime",
          sortable: true,
          cell: row => <div className="mr-5"><div>{dateFormatter(row.prefered_pickup_datetime)}</div></div>,


        },
        {
            name: "Location",
            selector:"address_1",
            sortable: true,
            cell: row => <div><div>{displayAddress(row)}</div></div>,
        },
        {
            name: "Customer",
            selector:"  customer.name",
            sortable: true,
            cell: row => <div>
                                <div>{row.customer.name}</div>
                                {(row.customer.phone_no !== null) && (
                                    <div>{row.customer.phone_no}<a href={`https://api.whatsapp.com/send?phone=${row.customer.phone_no}`} target='blank'><i className="fab fa-whatsapp icon-green" ></i></a>
                                    <a href={'tel:'+ row.customer.phone_no} target='blank'><i className="fas fa-phone icon-phone"></i></a></div>
                                )}
                                
                                {(row.walk_in_customer == '1') && (
                                    <span className="badge badge-success">walk in customer</span>
                                )}
                        </div>,
        },
        {
            name: "Notis Ambilan",
            selector: "notice_ambilan_ref",
            sortable: true,

        },
        {
            name: "",
            cell: row => <div><span className="btn btn-primary" onClick={()=> {scheduleOrder(row)}}>Add to Runner Schedule</span></div>,

        },
      ];

    const search=(rows)=>{

        let searchResult = rows;
        if (searchState !='' ) {
            searchResult = searchResult.filter((row) =>row.state.indexOf(searchState)>-1);

        }
        if(searchAddress != ''){
            searchResult = searchResult.filter((row) =>row.city.toString().toLowerCase().indexOf(searchAddress) > -1);
        }
        if(searchCustomerName != ''){
            searchResult = searchResult.filter((row) =>row.customer.name.toString().toLowerCase().indexOf(searchCustomerName)>-1);
        }

        if (searchResult.length == 0) {

            searchResult = searchResult;
        }

        return searchResult;
    }

    const  table =() => {
       return (
            <div>
                <div className="table-responsive">
                    <table className="mt-1">
                        <thead>
                            <tr>
                                <td>
                                    <label htmlFor="Search"> Search Status  </label>
                                        <select className="custom-select " value={searchState} onChange={(e) => setSearchState(e.target.value)}>
                                            <option value="">SELECT STATUS</option>
                                            <option value="App\State\Order\PendingPickupSchedule">Pending Pickup Schedule</option>
                                            <option value="App\State\Order\PendingReturnSchedule">Pending Return Schedule</option>
                                        </select>
                                </td>
                                <td>
                                    <label htmlFor="Search" className="ml-3"> Search City </label>
                                    <input type="text" className="form-control ml-3" placeholder=" Search City" value ={searchAddress} onChange={(e) => setSearchAddress(e.target.value)}/>
                                </td>
                                <td>
                                    <label htmlFor="Search" className="ml-5"> Search Name </label>
                                    <input type="text" className=" form-control ml-5" placeholder=" Search Name" value ={searchCustomerName} onChange={(e) => setSearchCustomerName(e.target.value)}/>

                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div>
                    <DataTable className="table table-bordered mt-3 table-responsive"
                        data={search(orders)}
                        columns ={columns}
                        defaultSortField="id"
                        pagination
                        noHeader
                        highlightOnHover
                        striped
                        customStyles={customStyles}
                        dense
                    />
                </div>
            </div>
        );
    }

    return (
        <div className="field">
            {modalShow && runnerJobForm()}
            <h3>Runner Jobs</h3>
            {runnerJobsTable()}
            <h3>Order to be Scheduled</h3>
            {table()}
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
